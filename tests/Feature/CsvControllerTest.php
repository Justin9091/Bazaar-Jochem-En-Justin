<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class CsvControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_csv_happy_flow()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/seller/'.$user->id.'/createcsv');

        $response->assertStatus(200);
    }

    public function test_import_csv_happy_flow()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $file = UploadedFile::fake()->create('data.csv', 2048);

        $response = $this->post('/seller/'.$user->id.'/importcsv', [
            'csv_file' => $file,
        ]);

        $response->assertStatus(302);
    }

    public function test_import_csv_no_file()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/seller/'.$user->id.'/importcsv', []);

        $response->assertStatus(302);
    }

    public function test_import_csv_invalid_file()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/seller/'.$user->id.'/importcsv', [
            'csv_file' => UploadedFile::fake()->create('data.txt', 2048),
        ]);

        $response->assertStatus(302);
    }
}
