<?php

namespace Tests\Feature;

use App\Models\AnakModel;
use App\Models\ImunisasiModel;
use App\Models\UsersModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Auth\Authenticatable;

class HomeControllerTest extends TestCase
{
    // use RefreshDatabase;

    protected $user;
    protected $kader;
    protected $superAdmin;
    protected $anak;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = UsersModel::factory()->create(['role' => 'User']);
        $this->kader = UsersModel::factory()->create(['role' => 'Kader']);
        $this->superAdmin = UsersModel::factory()->create(['role' => 'SuperAdmin']);
        $this->anak = AnakModel::factory()->create(['users_id' => $this->user->id]);
    }
    /** @test */
    public function index_returns_data_for_authenticated_user_with_role_user()
    {
        $user = UsersModel::factory()->create([
            'role' => 'User',
        ]);

        $this->actingAs($user);

        $anak = AnakModel::factory()->create([
            'users_id' => $user->id,
        ]);

        ImunisasiModel::factory()->count(5)->create([
            'anak_id' => $anak->id,
        ]);

        $response = $this->get('/home');

        $response->assertStatus(200);
         $response->assertViewHas('anak', function ($anakCollection) use ($anak) {
            return $anakCollection->first()->id === $anak->id;
        });
    }

    /** @test */
    public function it_returns_empty_collection_for_non_user_role()
    {
        $admin = UsersModel::factory()->create([
            'role' => 'Admin'
        ]);

        $this->actingAs($admin);

        $response = $this->get('/home');

        $response->assertStatus(200);

        $response->assertViewHas('anak', function ($anakCollection) {
            return $anakCollection->isEmpty();
        });
    }

}
