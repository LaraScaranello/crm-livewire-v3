<div>
    <x-header title="Users" separator progress-indicator/>

    <div class="flex space-x-4 mb-4">
        <div class="w-1/3">
            <x-input
                icon="o-magnifying-glass"
                wire:model.live="search"
                placeholder="Search by name and email"
            />
        </div>
        <div class="w-1/3">
            <x-choices
                placeholder="Filter by permissions"
                wire:model.live="search_permissions"
                :options="$permissionsToSearch"
                option-label="key"
                search-function="filterPermissions"
                searchable
                no-result-text="Nothing here"
            />
        </div>
    </div>

    <x-table :headers="$this->headers" :rows="$this->users">
        @scope('cell_permissions', $user)
        @foreach($user->permissions as $permission)
            <x-badge :value="$permission->key" class="badge-primary"/>
        @endforeach
        @endscope

        @scope('actions', $users)
        <x-button icon="o-trash" wire:click="delete({{ $users->id }})" spinner class="btn-sm"/>
        @endscope
    </x-table>
</div>
