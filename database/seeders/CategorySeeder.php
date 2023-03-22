<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'category_name' => 'Food blogs',
            ],
            [
                'id' => 2,
                'category_name' => 'Travel blogs',
                
            ],
            [
                'id' => 3,
                'category_name' => 'Health and fitness blogs',
            ],
            [
                'id' => 4,
                'category_name' => 'Lifestyle blogs',
            ],
            [
                'id' => 5,
                'category_name' => 'Fashion and beauty blogs',
            ],
            [
                'id' => 6,
                'category_name' => 'Photography blogs',
            ],
            [
                'id' => 7,
                'category_name' => 'Personal blogs',
            ],
            [
                'id' => 8,
                'category_name' => 'DIY craft blogs',
            ],
        ];
        
        foreach ($data as $key => $value) {
            Category::create($value);
        }
    }
}
