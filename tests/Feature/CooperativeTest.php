<?php

use App\Models\User;
use App\Models\Cooperative;
use Inertia\Testing\AssertableInertia;

test('authorized user can view cooperatives index page', function () {
    $user = User::factory()->create();
    $cooperative = Cooperative::factory()->create();

    $response = $this->actingAs($user)
        ->get(route('cooperatives.index'));

    $response->assertInertia(fn (AssertableInertia $page) => $page
        ->component('Cooperatives/Index')
        ->has('cooperatives', 1)
        ->where('cooperatives.0.id', $cooperative->id)
    );
});

test('authorized user can create a cooperative', function () {
    $user = User::factory()->create();
    $cooperativeData = [
        'name' => 'Test Cooperative',
        'region' => 'Test Region',
        'address' => 'Test Address',
        'contact_person' => 'John Doe',
        'phone' => '1234567890',
    ];

    $response = $this->actingAs($user)
        ->post(route('cooperatives.store'), $cooperativeData);

    $response->assertRedirect(route('cooperatives.index'));
    $this->assertDatabaseHas('cooperatives', $cooperativeData);
});

test('authorized user can update a cooperative', function () {
    $user = User::factory()->create();
    $cooperative = Cooperative::factory()->create();
    $updatedData = [
        'name' => 'Updated Cooperative',
        'region' => 'Updated Region',
        'address' => 'Updated Address',
        'contact_person' => 'Jane Doe',
        'phone' => '0987654321',
    ];

    $response = $this->actingAs($user)
        ->patch(route('cooperatives.update', $cooperative), $updatedData);

    $response->assertRedirect(route('cooperatives.index'));
    $this->assertDatabaseHas('cooperatives', $updatedData);
});

test('authorized user can delete a cooperative', function () {
    $user = User::factory()->create();
    $cooperative = Cooperative::factory()->create();

    $response = $this->actingAs($user)
        ->delete(route('cooperatives.destroy', $cooperative));

    $response->assertRedirect(route('cooperatives.index'));
    $this->assertModelMissing($cooperative);
});
