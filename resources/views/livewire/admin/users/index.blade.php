<div>
    <x-header title="Users" separator progress-indicator/>

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
