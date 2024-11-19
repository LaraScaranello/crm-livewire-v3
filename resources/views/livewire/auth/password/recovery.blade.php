<x-card title="Login" shadow class="mx-auto w-[450px]">

    @if($message)
        <x-alert icon="o-exclamation-triangle" class="alert-success mb-4 text-sm">
            <span>You will receive an email with the password recovery link</span>
        </x-alert>
    @endif

    <x-form wire:submit="startPasswordRecovery">
        <x-input label="Email" wire:model="email"/>

        <x-slot:actions>
            <div class="w-full flex items-center justify-between">
                <a href="{{ route('login') }}" wire:navigate class="link link-primary">
                    Never mind, get back to login page
                </a>
                <div>
                    <x-button label="Submit" class="btn-primary" type="submit" spinner="submit"/>
                </div>
            </div>
        </x-slot:actions>
    </x-form>
</x-card>