<?php

use App\Models\User;
use App\Models\Cooperative;
use Inertia\Testing\AssertableInertia;

test('user can view cooperatives index', function () {
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

test('user can create cooperative', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->get(route('cooperatives.create'));

    $response->assertInertia(fn (AssertableInertia $page) => $page
        ->component('Cooperatives/Create')
    );
});

test('user can store new cooperative', function () {
    $user = User::factory()->create();
    $cooperativeData = [
        'name' => 'Test Cooperative',
        'region' => 'Test Region',
        'address' => '123 Test St',
        'contact_person' => 'John Doe',
        'phone' => '1234567890',
    ];

    $response = $this->actingAs($user)
        ->post(route('cooperatives.store'), $cooperativeData);

    $response->assertRedirect(route('cooperatives.index'));
    $this->assertDatabaseHas('cooperatives', $cooperativeData);
});

test('user can edit cooperative', function () {
    $user = User::factory()->create();
    $cooperative = Cooperative::factory()->create();

    $response = $this->actingAs($user)
        ->get(route('cooperatives.edit', $cooperative));

    $response->assertInertia(fn (AssertableInertia $page) => $page
        ->component('Cooperatives/Edit')
        ->where('cooperative.id', $cooperative->id)
    );
});

test('user can update cooperative', function () {
    $user = User::factory()->create();
    $cooperative = Cooperative::factory()->create();
    $updatedData = [
        'name' => 'Updated Cooperative',
        'region' => 'Updated Region',
        'address' => '456 Updated St',
        'contact_person' => 'Jane Smith',
        'phone' => '0987654321',
    ];

    $response = $this->actingAs($user)
        ->patch(route('cooperatives.update', $cooperative), $updatedData);

    $response->assertRedirect(route('cooperatives.index'));
    $this->assertDatabaseHas('cooperatives', $updatedData);
});

test('user can delete cooperative', function () {
    $user = User::factory()->create();
    $cooperative = Cooperative::factory()->create();

    $response = $this->actingAs($user)
        ->delete(route('cooperatives.destroy', $cooperative));

    $response->assertRedirect(route('cooperatives.index'));
    $this->assertDatabaseMissing('cooperatives', ['id' => $cooperative->id]);
});

test('validates required fields when creating cooperative', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->post(route('cooperatives.store'), []);

    $response->assertSessionHasErrors(['name', 'region']);
});

test('validates required fields when updating cooperative', function () {
    $user = User::factory()->create();
    $cooperative = Cooperative::factory()->create();

    $response = $this->actingAs($user)
        ->patch(route('cooperatives.update', $cooperative), []);

    $response->assertSessionHasErrors(['name', 'region']);
});
