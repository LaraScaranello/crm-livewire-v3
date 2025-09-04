<div>
    <x-header title="Customers" separator progress-indicator/>

    <div class="flex justify-between mb-4 items-end">
        <div class="w-full flex space-x-4 items-end">
            <div class="w-1/3">
                <x-input
                    icon="o-magnifying-glass"
                    wire:model.live="search"
                    placeholder="Search by name and email"
                />
            </div>
            <x-select
                wire:model.live="perPage"
                :options="[['id'=>5,'name'=>'5'],['id'=>15,'name'=>'15'],['id'=>25,'name'=>'25'],['id'=>50,'name'=>'50']]"
                placeholder="Records per page"
            />
        </div>

        <x-button @click="$dispatch('customer::create')" label="New Customer" icon="o-plus"/>
    </div>

    <x-table :headers="$this->headers" :rows="$this->items">
        @scope('header_id', $header)
        <x-table.th :$header name="id"/>
        @endscope

        @scope('header_name', $header)
        <x-table.th :$header name="name"/>
        @endscope

        @scope('header_email', $header)
        <x-table.th :$header name="email"/>
        @endscope
    </x-table>

    {{ $this->items->links() }}

    <livewire:customers.create/>
</div>
