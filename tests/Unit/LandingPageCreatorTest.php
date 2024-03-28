<?php

namespace Tests\Feature;

use App\enum\ComponentType;
use App\Models\Component;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class LandingPageCreatorControllerTest extends TestCase
{
    use RefreshDatabase;


        public function testIndex()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Call the index method
        $response = $this->get('landing/editor');

        // Assert that the response is successful
        $response->assertStatus(200);

        // Assert that the view is returned
        $response->assertViewIs('landing-page-editor');
    }

    public function testAddComponentText()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create a request with text component data
        $response = $this->post('/landing/editor/add', [
            'type' => 'text-component',
            'text' => 'Test text',
            'size' => '26',
        ]);

        // Assert the component is added
        $this->assertDatabaseHas('components', [
            'user_id' => $user->id,
            'type' => 'text-component',
            'property' => '{"text":"Test text","size":"26"}',
        ]);

        // Assert redirect
        $response->assertRedirect(route('landing.editor'));
    }

    public function testAddComponentImage()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create a fake image file
        $image = UploadedFile::fake()->image('test_image.jpg');

        // Create a request with image component data
        $response = $this->post('/landing/editor/add', [
            'type' => 'image-component',
            'image' => $image,
            'description' => 'Test description',
        ]);

        // Assert the component is added
        $this->assertDatabaseHas('components', [
            'user_id' => $user->id,
            'type' => 'image-component',
        ]);

        // Assert redirect
        $response->assertRedirect(route('landing.editor'));
    }

    public function testRemoveComponent()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $component = new Component([
            'user_id' => $user->id,
            'type' => 'text-component',
            'property' => '{"text":"Test text","size":"26"}',
            'order' => '1',
        ]);
        // Set other properties of the component as needed
        $component->save();

        // Call the remove component route
        $response = $this->get('/landing/editor/remove/' . $component->id);

        // Assert that the response is a redirect
        $response->assertStatus(302);

        // Assert that the component is removed from the database
        $this->assertDatabaseMissing('components', ['id' => $component->id]);
    }


    public function testMoveComponentUp()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create two components with consecutive orders
        $component1 = Component::create([
            'user_id' => $user->id,
            'type' => 'text-component',
            'property' => '{"text":"Test text 1","size":"26"}',
            'order' => '2',
        ]);
        $component2 = Component::create([
            'user_id' => $user->id,
            'type' => 'text-component',
            'property' => '{"text":"Test text 2","size":"26"}',
            'order' => '1',
        ]);

        // Call the move component up route for the second component
        $response = $this->get('/landing/editor/up/' . $component2->id);

        // Assert that the response is successful
        $response->assertStatus(302);

        // Assert that the order of the component above is updated
        $this->assertDatabaseHas('components',[
            'user_id' => $user->id,
            'type' => 'text-component',
            'property' => '{"text":"Test text 1","size":"26"}',
            'order' => '2',
        ]);

        // Assert that the order of the moved component is updated
        $this->assertDatabaseHas('components',[
            'user_id' => $user->id,
            'type' => 'text-component',
            'property' => '{"text":"Test text 2","size":"26"}',
            'order' => '1',
        ]);

    }


    public function testMoveComponentDown()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create two components with consecutive orders
        $component1 = Component::create([
            'user_id' => $user->id,
            'type' => 'text-component',
            'property' => '{"text":"Test text 1","size":"26"}',
            'order' => '2',
        ]);
        $component2 = Component::create([
            'user_id' => $user->id,
            'type' => 'text-component',
            'property' => '{"text":"Test text 2","size":"26"}',
            'order' => '1',
        ]);

        // Call the move component up route for the second component
        $response = $this->get('/landing/editor/down/' . $component1->id);

        // Assert that the response is successful
        $response->assertStatus(302);

        // Assert that the order of the component above is updated
        $this->assertDatabaseHas('components',[
            'user_id' => $user->id,
            'type' => 'text-component',
            'property' => '{"text":"Test text 2","size":"26"}',
            'order' => '1',
        ]);

        // Assert that the order of the moved component is updated
        $this->assertDatabaseHas('components',[
            'user_id' => $user->id,
            'type' => 'text-component',
            'property' => '{"text":"Test text 1","size":"26"}',
            'order' => '2',
        ]);
    }

    public function testUpdateColor()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Call the update color route
        $response = $this->post('/landing/editor/colors', [
            'color' => '#FFF444'
        ]);

        // Assert that the response is successful
        $response->assertStatus(302);

        $this->assertDatabaseHas('users',[
            'color' => '#FFF444'
        ]);
    }
}
