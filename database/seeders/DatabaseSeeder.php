<?php

namespace Database\Seeders;

use App\Models\StudentsModel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        StudentsModel::factory(10)->create();
    }
}
