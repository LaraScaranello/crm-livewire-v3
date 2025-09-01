<?php

namespace App\Livewire\Admin\Users;

use App\Enum\Can;
use App\Models\{Permission, User};
use App\Support\Table\Header;
use App\Traits\Livewire\HasTable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\{Builder, Collection};
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\{Attributes\On, Component, WithPagination};

/**
 * @property-read LengthAwarePaginator|User[] $users
 * @property-read array $headers
 */
class Index extends Component
{
    use WithPagination;
    use HasTable;

    public array $search_permissions = [];

    public bool $search_trash = false;

    public Collection $permissionsToSearch;

    public function mount(): void
    {
        $this->authorize(Can::BE_AN_ADMIN->value);
        $this->filterPermissions();
    }

    #[On('user::deleted')]
    #[On('user::restored')]
    public function render(): View
    {
        return view('livewire.admin.users.index');
    }

    public function updatedPerPage(): void
    {
        $this->resetPage();
    }

    #[Computed]
    public function users(): LengthAwarePaginator
    {
        $this->validate(['search_permissions' => 'exists:permissions,id']);

        return User::query()
            ->with('permissions')
            ->search($this->search, ['name', 'email'])
            ->when(
                $this->search_permissions,
                fn (Builder $q) => $q->whereHas('permissions', function (Builder $query) {
                    $query->whereIn('id', $this->search_permissions);
                })
            )
            ->when(
                $this->search_trash,
                fn (Builder $q) => $q->onlyTrashed()
            )
            ->orderBy($this->sortColumnBy, $this->sortDirection)
            ->paginate($this->perPage);
    }

    #[Computed]
    public function tableHeaders(): array
    {
        return [
            Header::make('id', '#'),
            Header::make('name', 'Name'),
            Header::make('email', 'Email'),
            Header::make('permissions', 'Permissions'),
        ];
    }

    public function filterPermissions(?string $value = null): void
    {
        $this->permissionsToSearch = Permission::query()
            ->when($value, fn (Builder $q) => $q->where('key', 'like', "%$value%"))
            ->orderBy('key')
            ->get();
    }

    public function sortBy(string $column, string $direction): void
    {
        $this->sortColumnBy  = $column;
        $this->sortDirection = $direction;
    }

    public function destroy(int $userId): void
    {
        $this->dispatch('user::deletion', userId: $userId)->to('admin.users.delete');
    }

    public function impersonate(int $userId): void
    {
        $this->dispatch('user::impersonation', userId: $userId)->to('admin.users.impersonate');
    }

    public function restore(int $userId): void
    {
        $this->dispatch('user::restoring', userId: $userId)->to('admin.users.restore');
    }

    public function showUser(int $id): void
    {
        $this->dispatch('user::show', id: $id)->to('admin.users.show');
    }
}
