<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Teknologi',
            'Hiburan',
            'Olahraga',
            'Ekonomi',
            'Pendidikan',
            'Kesehatan',
            'Politik',
            'Gaya Hidup',
            'Internasional',
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['name' => $category]);
        }
    }
}
