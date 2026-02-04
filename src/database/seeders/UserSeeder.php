<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 管理者
        User::factory()->admin()->create([
            'name' => '管理者',
            'email' => 'admin@example.com',
        ]);

        // 一般ユーザー 5人
        User::factory(5)->create();
    }
}