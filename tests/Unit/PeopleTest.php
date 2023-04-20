<?php

use Tests\TestCase;
use App\Models\People;
use App\Models\User;

uses(TestCase::class);

beforeEach(function () {
    // Create sample User
    $this->user = User::factory()->create();
});

it('can create a new character', function () {

    // Make the test use that sample user
    $this->actingAs($this->user);

    // Create sample Character
    $peopleData = People::factory()->make()->toArray();

    // Check the post response using that same data
    $response = $this->post('/peoples/storeCreate', $peopleData);

    // Check if the submit response is 302 (redirect)
    $response->assertStatus(302);

    // Check if it redirects to /table/people correctly
    $response->assertRedirect('/table/people');

    // Check if the Character  was actually created and stored on the database
    $createdPeople = People::where('name', $peopleData['name'])->first();
    expect($createdPeople)->not->toBeNull();
});


it('can edit a character', function () {

    // Make the test use that sample user
    $this->actingAs($this->user);

    // Create a new Character  and store it in the database
    $peopleData = People::factory()->create();

    // Send a GET request to the edit endpoint
    $response = $this->get("/peoples/edit/{$peopleData->id}");

    // Check if the response is a 200 (OK)
    $response->assertStatus(200);

    // Check if the edit form is displayed correctly
    $response->assertSee('Edit Character');
    $response->assertSee($peopleData->name);
    $response->assertSee($peopleData->height);
    $response->assertSee($peopleData->mass);
    $response->assertSee($peopleData->hair_color);
    $response->assertSee($peopleData->skin_color);
    $response->assertSee($peopleData->eye_color);
    $response->assertSee($peopleData->birth_year);
    $response->assertSee($peopleData->gender);

    // Create new data for the edited Character
    $newPeopleData = People::factory()->make()->toArray();

    // Send a PUT request to the update endpoint with the new data
    $response = $this->put("/peoples/{$peopleData->id}", [
        'name' => $newPeopleData['name'],
        'height' => intval($newPeopleData['height']),
        'mass' => intval($newPeopleData['mass']),
        'hair_color' => $newPeopleData['hair_color'],
        'skin_color' => $newPeopleData['skin_color'],
        'eye_color' => $newPeopleData['eye_color'],
        'birth_year' => $newPeopleData['birth_year'],
        'gender' => $newPeopleData['gender'],
    ]);

    // Check if the response is a 302 (redirect)
    $response->assertStatus(302);

    // Check if it redirects to /table/people correctly
    $response->assertRedirect('/table/people');

    // Check if the Character was actually updated in the database
    $updatedPeople = People::find($peopleData->id);
    expect($updatedPeople->name)->toBe($updatedPeople['name']);
    expect(intval($updatedPeople->height))->toBeInt(intval($updatedPeople['height']));
    expect(intval($updatedPeople->mass))->toBeInt(intval($updatedPeople['mass']));
    expect($updatedPeople->hair_color)->toBe($updatedPeople['hair_color']);
    expect($updatedPeople->skin_color)->toBe($updatedPeople['skin_color']);
    expect($updatedPeople->eye_color)->toBe($updatedPeople['eye_color']);
    expect($updatedPeople->birth_year)->toBe($updatedPeople['birth_year']);
    expect($updatedPeople->gender)->toBe($updatedPeople['gender']);
});


it('can delete a character', function () {

    // Make the test use that sample user
    $this->actingAs($this->user);

    // Create a new Character and store it in the database
    $peopleData = People::factory()->create();

    // Send a DELETE request to the delete endpoint
    $response = $this->delete("/peoples/{$peopleData->id}");

    // Check if the response is a 302 (redirect)
    $response->assertStatus(302);

    // Check if it redirects to /table/people correctly
    $response->assertRedirect('/table/people');

    // Check if the People was actually deleted from the database
    $deletedPeople = People::find($peopleData->id);
    expect($deletedPeople)->toBeNull();
});