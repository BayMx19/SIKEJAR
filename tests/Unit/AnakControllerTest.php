<?php

namespace Tests\Feature;

use App\Models\AnakModel;
use App\Models\UsersModel;
// use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class AnakControllerTest extends TestCase
{
/** @test */
public function it_displays_anak_index_page()
{
    $user = UsersModel::factory()->create();
    $this->actingAs($user); // Login as a user

    AnakModel::factory()->create(); // Create a dummy AnakModel

    $response = $this->get('/master-anak');

    $response->assertStatus(200);
    $response->assertViewIs('master-anak.index');
    $response->assertViewHas('anak');
}

/** @test */
public function it_displays_anak_detail_page()
{
    $user = UsersModel::factory()->create();
    $this->actingAs($user); // Login as a user

    $anak = AnakModel::factory()->create();

    $response = $this->get("/master-anak/{$anak->id}/detail");

    $response->assertStatus(200);
    $response->assertViewIs('master-anak.detail');
    $response->assertViewHas('anak');
    $response->assertViewHas('users');
}

/** @test */
public function it_displays_create_anak_page()
{
    $user = UsersModel::factory()->create();
    $this->actingAs($user); // Login as a user

    $response = $this->get('/master-anak/create');

    $response->assertStatus(200);
    $response->assertViewIs('master-anak.create');
    $response->assertViewHas('users');
}

/** @test */
public function it_stores_anak_data()
{
    $user = UsersModel::factory()->create();
    $this->actingAs($user); // Login as a user

    $data = [
        'users_id' => $user->id,
        'nama_anak' => 'John Doe',
        'NIK_anak' => '1234567890',
        'tanggal_lahir_anak' => '2020-01-01',
        'jenis_kelamin' => 'L',
        'status' => 'Hidup',
    ];

    $response = $this->post('/master-anak/store', $data);

    $response->assertRedirect('/master-anak');
    $response->assertSessionHas('success', 'Anak berhasil ditambahkan.');

    $this->assertDatabaseHas('master_anak', $data);
}

/** @test */
public function it_updates_anak_data()
{
    $user = UsersModel::factory()->create();
    $this->actingAs($user); // Login as a user

    $anak = AnakModel::factory()->create();

    $data = [
        'users_id' => $user->id,
        'nama_anak' => 'Updated Name',
        'NIK_anak' => '9876543210',
        'tanggal_lahir_anak' => '2021-01-01',
        'jenis_kelamin' => 'P',
        'status' => 'Meninggal',
    ];

    $response = $this->put("/master-anak/{$anak->id}", $data);

    $response->assertRedirect('/master-anak');
    $response->assertSessionHas('success', 'Data berhasil diperbarui!');

    $this->assertDatabaseHas('master_anak', $data);
}

/** @test */
public function it_deletes_anak_data()
{
    $user = UsersModel::factory()->create();
    $this->actingAs($user); // Login as a user

    $anak = AnakModel::factory()->create();

    $response = $this->delete("/master-anak/{$anak->id}");

    $response->assertRedirect('/master-anak');
    $response->assertSessionHas('success', 'Data berhasil dihapus!');

    $this->assertDatabaseMissing('master_anak', ['id' => $anak->id]);
}}