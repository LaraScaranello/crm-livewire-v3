<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class Logout extends Component
{
    public function render(): string
    {
        return <<<'BLADE'
            <button class="btn-circle btn-ghost btn-xs" wire:click="logout">
                <x-icon name="o-power"/>
            </button>
        BLADE;
    }

    public function logout(): void
    {
        auth()->logout();

        session()->invalidate();
        session()->regenerateToken();

        $this->redirect(route('login'));
    }
}
