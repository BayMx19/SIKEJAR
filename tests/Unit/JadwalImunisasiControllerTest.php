<?php

namespace Tests\Feature;

use App\Models\AnakModel;
use App\Models\ImunisasiModel;
use App\Models\JadwalImunisasiModel;
use App\Models\UsersModel;
use Database\Factories\ImunisasiModelFactory;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;

class JadwalImunisasiControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     */
     /** @test */
     public function it_displays_jadwal_index_page()
     {
         $user = UsersModel::factory()->create();
         $this->actingAs($user);

         ImunisasiModel::factory()->create();

         $response = $this->get('/jadwal-imunisasi');

         $response->assertStatus(200);
         $response->assertViewIs('jadwal-imunisasi.index');
         $response->assertViewHas('jadwal');
     }

     /** @test */
     public function it_displays_create_jadwal_page()
     {
         $user = UsersModel::factory()->create();
         $this->actingAs($user);

         $response = $this->get('/jadwal-imunisasi/create');

         $response->assertStatus(200);
         $response->assertViewIs('jadwal-imunisasi.create');
         $response->assertViewHas('anak');
     }

     /** @test */
     public function it_displays_jadwal_detail_page()
     {
         $user = UsersModel::factory()->create();
         $this->actingAs($user);

         $jadwal = ImunisasiModel::factory()->create();

         $response = $this->get("/jadwal-imunisasi/{$jadwal->id}/detail");

         $response->assertStatus(200);
         $response->assertViewIs('jadwal-imunisasi.detail');
         $response->assertViewHasAll(['jadwal', 'listanak']);
     }

     /** @test */
     public function it_stores_jadwal_data()
     {
         $user = UsersModel::factory()->create();
         $this->actingAs($user);

         $anak = AnakModel::factory()->create(['users_id' => $user->id]);

         $data = [
             'anak_id' => $anak->id,
             'tanggal_imunisasi' => '2025-05-10',
             'jenis_imunisasi' => 'BCG',
             'keterangan' => 'Wajib hadir',
         ];

         $response = $this->post('/jadwal-imunisasi/store', $data);

         $response->assertRedirect('/jadwal-imunisasi');
         $this->assertDatabaseHas('imunisasi', [
             'anak_id' => $anak->id,
             'jenis_imunisasi' => 'BCG'
         ]);
     }

     /** @test */
     public function it_displays_edit_jadwal_page()
     {
         $user = UsersModel::factory()->create();
         $this->actingAs($user);

         $jadwal = ImunisasiModel::factory()->create();

         $response = $this->get("/jadwal-imunisasi/{$jadwal->id}/edit");

         $response->assertStatus(200);
         $response->assertViewIs('jadwal-imunisasi.edit');
         $response->assertViewHasAll(['jadwal', 'listanak']);
     }

     /** @test */
     public function it_updates_jadwal_data()
     {
         $user = UsersModel::factory()->create();
         $this->actingAs($user);

         $jadwal = ImunisasiModel::factory()->create();

         $data = [
             'tanggal_imunisasi' => '2025-06-01',
             'jenis_imunisasi' => 'Polio',
             'keterangan' => 'Dijadwal ulang',
         ];

         $response = $this->put("/jadwal-imunisasi/{$jadwal->id}", $data);

         $response->assertRedirect('/jadwal-imunisasi');
         $this->assertDatabaseHas('imunisasi', $data);
     }

     /** @test */
     public function it_deletes_jadwal_data()
     {
         $user = UsersModel::factory()->create();
         $this->actingAs($user);

         $jadwal = ImunisasiModel::factory()->create();

         $response = $this->delete("/jadwal-imunisasi/{$jadwal->id}");

         $response->assertRedirect('/jadwal-imunisasi');
         $this->assertDatabaseMissing('imunisasi', ['id' => $jadwal->id]);
     }
}