<?php

use App\Livewire\Dev\BranchEnv;
use App\Models\User;

use function Pest\Laravel\{actingAs, get};

it('should show a current branch in the page', function () {
    Process::fake([
        'git branch --show-current' => Process::result('main'),
    ]);

    Livewire::test(BranchEnv::class)
        ->assertSet('branch', 'main')
        ->assertSee('main');

    Process::assertRan('git branch --show-current');
});

it('should not load the livewire component on production enviroment', function () {
    $user = User::factory()->create();

    app()->detectEnvironment(fn () => 'production');

    actingAs($user);

    get(route('dashboard')) // app.blade.php
        ->assertDontSeeLivewire('dev.branch-env');

    get(route('login')) // guest.blade.php
        ->assertDontSeeLivewire('dev.branch-env');
});

it('should load the livewire component on non production enviroment', function () {
    $user = User::factory()->create();

    app()->detectEnvironment(fn () => 'local');

    actingAs($user);

    get(route('dashboard')) // app.blade.php
        ->assertSeeLivewire('dev.branch-env');

    get(route('login')) // guest.blade.php
        ->assertSeeLivewire('dev.branch-env');
});
