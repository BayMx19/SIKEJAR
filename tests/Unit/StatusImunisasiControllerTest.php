<?php

namespace Tests\Unit;

use App\Models\AnakModel;
use App\Models\ImunisasiModel;
use App\Models\UsersModel;
use Database\Factories\ImunisasiModelFactory;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
class StatusImunisasiControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $user = UsersModel::factory()->create(['role' => 'admin']);
        $this->actingAs($user);
    }
    public function it_displays_status_index_page()
    {
        $anak = AnakModel::factory()->create();
        ImunisasiModel::factory()->create(['anak_id' => $anak->id]);

        $response = $this->get('/status-imunisasi');

        $response->assertStatus(200);
        $response->assertViewIs('status-imunisasi.index');
    }

    /** @test */
    public function it_filters_status_by_anak_name()
    {
        $anak = AnakModel::factory()->create(['nama_anak' => 'Budi']);
        ImunisasiModel::factory()->create(['anak_id' => $anak->id]);

        $response = $this->get('/status-imunisasi?search=Budi');

        $response->assertStatus(200);
        $response->assertSee('Budi');
    }

    /** @test */
    public function it_displays_status_detail_page()
    {
        $anak = AnakModel::factory()->create();
        $status = ImunisasiModel::factory()->create(['anak_id' => $anak->id]);

        $response = $this->get("/status-imunisasi/{$status->id}/detail");

        $response->assertStatus(200);
        $response->assertViewIs('status-imunisasi.detail');
    }

    /** @test */
    public function it_updates_status_data()
    {
        $anak = AnakModel::factory()->create();
        $status = ImunisasiModel::factory()->create([
            'anak_id' => $anak->id,
            'status' => 'Belum',
            'keterangan' => 'Awal'
        ]);

        $response = $this->put("/status-imunisasi/{$status->id}", [
            'status' => 'Sudah',
            'keterangan' => 'Selesai'
        ]);

        $response->assertRedirect('/status-imunisasi');
        $this->assertDatabaseHas('imunisasi', [
            'id' => $status->id,
            'status' => 'Sudah',
            'keterangan' => 'Selesai',
        ]);
    }

    /** @test */
    public function it_deletes_status_data()
    {
        $anak = AnakModel::factory()->create();
        $status = ImunisasiModel::factory()->create(['anak_id' => $anak->id]);

        $response = $this->delete("/status-imunisasi/{$status->id}");

        $response->assertRedirect('/status-imunisasi');
        $this->assertDatabaseMissing('imunisasi', ['id' => $status->id]);
    }
}
