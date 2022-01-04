<?php

namespace Tests\Feature\Http\Controllers\Master;

use App\Services\Admin\RegionService;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class RegionControllerTest extends TestCase
{
    public function testRegionWithNotAuth()
    {
      $response = $this->get('/admin/region/list');
      $response->assertStatus(302);
    }

    public function testRegionWithtAuth()
    {
      Sanctum::actingAs(
        User::create([
          'username' => 'contoh',
          'email' => 'test@mail.com',
          'password' => 'password']),
        ['view-tasks']
      );

      $response = $this->get('/admin/region/list');
      $response->assertStatus(200);
    }

}
