<?php

namespace Database\Seeders;

use App\Enum\Can;
use App\Models\{User};
use Database\Factories\UserFactory;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::factory()
            ->withPermission(Can::BE_AN_ADMIN)
            ->create([
                'name'     => 'Admin do CRM',
                'email'    => 'admin@crm.com',
                'password' => 'password',
            ]);

        $this->normalUsers();
        $this->deletedUsers($admin);
    }

    private function defaultDefinition(): array
    {
        return array_merge(new UserFactory()->definition(), ['password' => '$2y$12$B/IpVrI.d6ZJy0PFICzFe.sa1l/zLVrebStEUTRe8VGK8s69BsYtK']);
    }

    public function normalUsers(): void
    {
        User::query()->insert(
            array_map(
                fn () => $this->defaultDefinition(),
                range(1, 50)
            ),
        );
    }

    public function deletedUsers(User $admin): void
    {
        User::query()->insert(
            array_map(
                fn () => array_merge(
                    array_merge(
                        new UserFactory()->definition(),
                        ['password' => '$2y$12$B/IpVrI.d6ZJy0PFICzFe.sa1l/zLVrebStEUTRe8VGK8s69BsYtK'],
                    ),
                    [
                        'deleted_at' => now(),
                        'deleted_by' => $admin->id,
                    ]
                ),
                range(1, 50)
            ),
        );
    }
}
