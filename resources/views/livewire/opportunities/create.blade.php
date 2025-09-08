<x-drawer wire:model="modal" title="Create Opportunity" separator right class="w-1/3 p-6">

    <x-form wire:submit="save" id="create-opportunity-form">
        <div class="space-y-3">
            <x-input label="Title" wire:model="form.title"/>
            <x-select label="Status"
                      :options="[
                        ['id' => 'open', 'name' => 'open'],
                        ['id' => 'won', 'name' => 'won'],
                        ['id' => 'lost', 'name' => 'lost']
                      ]"
                      wire:model="form.status"
            />
            <x-input label="Amount" wire:model="form.amount" prefix="R$" locale="pt-BR"/>
        </div>

        <x-slot:actions>
            <x-button label="Cancel" @click="$wire.modal = false"/>
            <x-button label="Save" type="submit" form="create-opportunity-form" class="btn-primary"/>
        </x-slot:actions>
    </x-form>

</x-drawer>
