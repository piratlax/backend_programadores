<?php

namespace Database\Seeders;

use App\Models\Programmer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProgrammerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        File::deleteDirectory(storage_path("app/public/programmers"));
        File::makeDirectory(storage_path("app/public/programmers"));
        Programmer::factory(20)->create();
    }
}
