<?php
namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            'Undangan', 'Pengumuman', 'Nota Dinas', 'Pemberitahuan'
        ] as $name) {
            Category::firstOrCreate(['name' => $name]);
        }
    }
}
