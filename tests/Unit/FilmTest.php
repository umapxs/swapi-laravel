<?php

use Tests\TestCase;
use App\Models\Film;
use App\Models\User;


uses(TestCase::class);

beforeEach(function () {
    // Create sample User
    $this->user = User::factory()->create();
});

it('can create a new film', function () {

    // Make the test use that sample user
    $this->actingAs($this->user);

    // Create sample Film
    $filmData = Film::factory()->make()->toArray();

    // Check the post response using that same data
    $response = $this->post('/films/storeCreate', $filmData);

    // Check if the submit response is 302 (redirect)
    $response->assertStatus(302);

    // Check if it redirects to /table/film correctly
    $response->assertRedirect('/table/film');

    // Check if the Film  was actually created and store on the database
    $createdFilm = Film::where('title', $filmData['title'])->first();
    expect($createdFilm)->not->toBeNull();
});


it('can edit a film', function () {

    // Make the test use that sample user
    $this->actingAs($this->user);

    // Create a new Film and store it in the database
    $filmData = Film::factory()->create();

    // Send a GET request to the edit endpoint
    $response = $this->get("/films/edit/{$filmData->id}");

    // Check if the response is a 200 (OK)
    $response->assertStatus(200);

    // Check if the edit form is displayed correctly
    $response->assertSee('Edit Film');
    $response->assertSee($filmData->title);
    $response->assertSee($filmData->episode_id);
    $response->assertSee($filmData->director);
    $response->assertSee($filmData->producer);
    $response->assertSee($filmData->release_date);

    // Create new data for the edited Starship
    $newFilmData = Film::factory()->make()->toArray();

    // Send a PUT request to the update endpoint with the new data
    $response = $this->put("/films/{$filmData->id}", [
        'title' => $newFilmData['title'],
        'episode_id' => intval($newFilmData['episode_id']),
        'director' => $newFilmData['director'],
        'producer' => $newFilmData['producer'],
        'release_date' => $newFilmData['release_date'],
    ]);

    // Check if the response is a 302 (redirect)
    $response->assertStatus(302);

    // Check if it redirects to /table/film correctly
    $response->assertRedirect('/table/film');

    // Check if the Film was actually updated in the database
    $updatedFilm = Film::find($filmData->id);
    expect($updatedFilm->title)->toBe($updatedFilm['title']);
    expect(intval($updatedFilm->episode_id))->toBeInt(intval($updatedFilm['episode_id']));
    expect($updatedFilm->director)->toBe($updatedFilm['director']);
    expect($updatedFilm->producer)->toBe($updatedFilm['producer']);
    expect($updatedFilm->release_date)->toBe($updatedFilm['release_date']);
});


it('can delete a film', function () {

    // Make the test use that sample user
    $this->actingAs($this->user);

    // Create a new Film and store it in the database
    $filmData = Film::factory()->create();

    // Send a DELETE request to the delete endpoint
    $response = $this->delete("/films/{$filmData->id}");

    // Check if the response is a 302 (redirect)
    $response->assertStatus(302);

    // Check if it redirects to /table/film correctly
    $response->assertRedirect('/table/film');

    // Check if the Film was actually deleted from the database
    $deletedFilm = Film::find($filmData->id);
    expect($deletedFilm)->toBeNull();
});