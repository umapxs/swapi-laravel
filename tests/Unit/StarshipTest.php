<?php

use Tests\TestCase;
use App\Models\Starship;
use App\Models\User;

uses(TestCase::class);

it('can fetch starship data', function () {

});

it('can create a new starship', function () {

    // Check if there exists this sample user and create it if it doesn't
    $user = User::factory()->create();

    // Make the test use that sample user
    $this->actingAs($user);

    // Store default $starshipData
    $starshipData = Starship::factory()->make()->toArray();

    // Check the post response using that same data
    $response = $this->post('/starships/storeCreate', $starshipData);

    // Check if the submit response is 302 (redirect)
    $response->assertStatus(302);

    // Check if it redirects to /table/starship correctly
    $response->assertRedirect('/table/starship');

    // Check if the Starship was actually created and store on the database
    $createdStarship = Starship::where('name', $starshipData['name'])->first();
    expect($createdStarship)->not->toBeNull();
});

it('can delete a starship', function () {

    // Check if there exists this sample user and create it if it doesn't
    $user = User::firstOrCreate([
        'email' => 'john.doe@example.com'
    ], [
        'name' => 'John Doe',
        'password' => bcrypt('password'),
        'rememberToken' => 'none',
    ]);

    // Make the test use that sample user
    $this->actingAs($user);

    // Store default $starshipData
    $starshipData = [
        'name' => 'Test Starship',
        'model' => 'Test Model',
        'manufacturer' => 'Test Manufacturer',
        'max_atmosphering_speed' => 1000,
        'crew' => 20,
        'passengers' => 10,
        'starship_class' => 'Test Class',
    ];

    // Check the post response using that same data
    $response = $this->delete("/starships/{$starship->id}/delete");

    // Check if the submit response is 302 (redirect)
    $response->assertStatus(302);

    // Check if it redirects to /table/starship correctly
    $response->assertRedirect('/table/starship');

    // Check if the Starship was actually created and store on the database
    $createdStarship = Starship::where('name', 'Test Starship')->first();
    expect($createdStarship)->not->toBeNull();
});

it('can edit a starship', function () {

});