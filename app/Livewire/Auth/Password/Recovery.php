<?php

namespace App\Livewire\Auth\Password;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Password;
use Livewire\Attributes\{Layout, Rule};
use Livewire\Component;

class Recovery extends Component
{
    #[Rule(['required', 'email'])]
    public ?string $email = null;

    public ?string $message = null;

    #[Layout('components.layouts.guest')]
    public function render(): View
    {
        return view('livewire.auth.password.recovery');
    }

    public function startPasswordRecovery(): void
    {
        $this->validate();

        Password::sendResetLink($this->only('email'));

        $this->message = 'You will receive an email with the password recovery link';
    }
}
