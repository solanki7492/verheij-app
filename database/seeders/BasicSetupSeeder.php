<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BasicSetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         User::query()->create([
             'name' => 'Super Admin',
             'email' => 'admin@zondervan.nl',
             'password' => Hash::make(12345678)
         ]);
    }
}
