<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContractControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_happy_flow()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/' . $user->id . '/contract');

        $response->assertStatus(200);
    }

    public function test_download_contract()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/' . $user->id . '/contract/download-contract');

        $response->assertStatus(200);
    }

    public function test_upload_contract()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $contract = storage_path('app\public\contracts\contract.pdf');

        error_log($contract);

        $response = $this->post('/' . $user->id . '/contract/upload-contract', [
            'file' => $contract
        ]);

        $response->assertStatus(302);
    }

    public function test_upload_contract_no_file()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/' . $user->id . '/contract/upload-contract');

        $response->assertStatus(302);
    }

    public function test_upload_contract_invalid_file()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post('/' . $user->id . '/contract/upload-contract', [
            'file' => 'contract.txt'
        ]);

        $response->assertStatus(302);
    }
}
