<?php

use Tests\TestCase;
use App\Models\Starship;
use App\Models\User;


uses(TestCase::class);

beforeEach(function () {
    // Create sample User
    $this->user = User::factory()->create();
});

it('can create a new starship', function () {

    // Make the test use that sample user
    $this->actingAs($this->user);

    // Create sample Starship
    $starshipData = Starship::factory()->make()->toArray();

    // Check the post response using that same data
    $response = $this->post('/starships/storeCreate', $starshipData);

    // Check if the submit response is 302 (redirect)
    $response->assertRedirect();

    // Check if it redirects to /table/starship correctly
    $response->assertRedirect('/table/starship');

    // Check if the Starship was actually created and store on the database
    $createdStarship = Starship::where('name', $starshipData['name'])->first();
    expect($createdStarship)->not->toBeNull();
});


it('can edit a starship', function () {

    // Make the test use that sample user
    $this->actingAs($this->user);

    // Create a new Starship and store it in the database
    $starshipData = Starship::factory()->create();

    // Send a GET request to the edit endpoint
    $response = $this->get("/starships/edit/{$starshipData->id}");

    // Check if the response is a 200 (OK)
    $response->assertStatus(200);

    // Check if the edit form is displayed correctly
    $response->assertSee('Edit Starship');
    $response->assertSee($starshipData->name);
    $response->assertSee($starshipData->model);
    $response->assertSee($starshipData->manufacturer);
    $response->assertSee($starshipData->max_atmosphering_speed);
    $response->assertSee($starshipData->crew);
    $response->assertSee($starshipData->passengers);
    $response->assertSee($starshipData->starship_class);

    // Create new data for the edited Starship
    $newStarshipData = Starship::factory()->make()->toArray();

    // Send a PUT request to the update endpoint with the new data
    $response = $this->put("/starships/{$starshipData->id}", [
        'name' => $newStarshipData['name'],
        'model' => $newStarshipData['model'],
        'manufacturer' => $newStarshipData['manufacturer'],
        'max_atmosphering_speed' => intval($newStarshipData['max_atmosphering_speed']),
        'crew' => intval($newStarshipData['crew']),
        'passengers' => intval($newStarshipData['passengers']),
        'starship_class' => $newStarshipData['starship_class'],
    ]);

    // Check if the response is a 302 (redirect)
    $response->assertRedirect();

    // Check if it redirects to /table/starship correctly
    $response->assertRedirect('/table/starship');

    // Check if the Starship was actually updated in the database
    $updatedStarship = Starship::find($starshipData->id);
    expect($updatedStarship->name)->toBe($newStarshipData['name']);
    expect($updatedStarship->model)->toBe($newStarshipData['model']);
    expect($updatedStarship->manufacturer)->toBe($newStarshipData['manufacturer']);
    expect(intval($updatedStarship->max_atmosphering_speed))->toBeInt(intval($newStarshipData['max_atmosphering_speed']));
    expect(intval($updatedStarship->crew))->toBeInt(intval($newStarshipData['crew']));
    expect(intval($updatedStarship->passengers))->toBeInt(intval($newStarshipData['passengers']));
    expect($updatedStarship->starship_class)->toBe($newStarshipData['starship_class']);
});


it('can delete a starship', function () {

    // Make the test use that sample user
    $this->actingAs($this->user);

    // Create a new Starship and store it in the database
    $starshipData = Starship::factory()->create();

    // Send a DELETE request to the delete endpoint
    $response = $this->delete("/starships/{$starshipData->id}");

    // Check if the response is a 302 (redirect)
    $response->assertRedirect();

    // Check if it redirects to /table/starship correctly
    $response->assertRedirect('/table/starship');

    // Check if the Starship was actually deleted from the database
    $deletedStarship = Starship::find($starshipData->id);
    expect($deletedStarship)->toBeNull();
});