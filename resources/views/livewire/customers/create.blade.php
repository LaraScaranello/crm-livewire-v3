<x-drawer wire:model="modal" title="Create Customer" separator right class="w-1/3 p-6">

    <x-form wire:submit="save" id="create-customer-form">
        <div class="space-y-3">
            <x-input label="Name" wire:model="name"/>
            <x-input label="Email" wire:model="email"/>
            <x-input label="Phone" wire:model="phone"/>
        </div>

        <x-slot:actions>
            <x-button label="Cancel" @click="$wire.modal = false"/>
            <x-button label="Save" type="submit" form="create-customer-form" class="btn-primary"/>
        </x-slot:actions>
    </x-form>

</x-drawer>
