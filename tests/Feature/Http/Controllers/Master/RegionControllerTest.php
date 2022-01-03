<?php

namespace Tests\Feature\Http\Controllers\Master;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegionControllerTest extends TestCase
{
    public function testRegionWithNotAuth()
    {
//      test
      $response = $this->get('/admin/region/list');
      $response->assertStatus(302);
    }
}
