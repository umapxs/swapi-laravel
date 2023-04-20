<?php

use Tests\TestCase;
use App\Models\User;
use App\Models\Starship;
use App\Models\Film;
use App\Models\People;


uses(TestCase::class);

beforeEach(function () {
    // Create sample User
    $this->user = User::factory()->create();
});


it('can add a comment/note to a starship', function () {

    // Make the test use that sample user
    $this->actingAs($this->user);

    // Create sample Starship
    $starship = Starship::factory()->create();

    // Create comment/note content
    $commentData = [
        'comment' => 'This starship is amazing!'
    ];

    $response = $this->post(route('starshipsComments.store', ['starships' => $starship->id]), [
        'comment' => $commentData['comment'],
    ]);

    $this->assertDatabaseHas('comments', [
        'comment' => $commentData['comment'],
        'user_id' => $this->user->id,
        'commentable_id' => $starship->id
    ]);
});


it('can add a comment/note to a film', function () {

    // Make the test use that sample user
    $this->actingAs($this->user);

    // Create sample Film
    $film = Film::factory()->create();

    // Create comment/note content
    $commentData = [
        'comment' => 'This film is amazing!'
    ];

    $response = $this->post(route('filmsComments.store', ['films' => $film->id]), [
        'comment' => $commentData['comment'],
    ]);

    $this->assertDatabaseHas('comments', [
        'comment' => $commentData['comment'],
        'user_id' => $this->user->id,
        'commentable_id' => $film->id
    ]);
});



it('can add a comment/note to a character', function () {

    // Make the test use that sample user
    $this->actingAs($this->user);

    // Create sample Character
    $people = People::factory()->create();

    // Create comment/note content
    $commentData = [
        'comment' => 'This starship is amazing!'
    ];

    $response = $this->post(route('peoplesComments.store', ['peoples' => $people->id]), [
        'comment' => $commentData['comment'],
    ]);

    $this->assertDatabaseHas('comments', [
        'comment' => $commentData['comment'],
        'user_id' => $this->user->id,
        'commentable_id' => $people->id
    ]);
});