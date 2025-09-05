<div>
    <x-modal
        wire:model="modal"
        title="Archive Cofirmation"
        subtitle="You are archiving the customer {{ $customer?->name }}"
        class="backdrop-blur">

        <x-slot:actions>
            <x-button label="Hum... no" @click="$wire.modal = false"/>
            <x-button label="Yes, I am" class="btn-primary" wire:click="archive"/>
        </x-slot:actions>
    </x-modal>
</div>
