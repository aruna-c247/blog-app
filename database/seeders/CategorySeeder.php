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
                'slug' => 'food-blog'
            ],
            [
                'id' => 2,
                'category_name' => 'Travel blogs',
                'slug' => 'travel-blog'
            ],
            [
                'id' => 3,
                'category_name' => 'Health and fitness blogs',
                'slug' => 'fitness-blog'
            ],
            [
                'id' => 4,
                'category_name' => 'Lifestyle blogs',
                'slug' => 'lifestyle-blog'
            ],
            [
                'id' => 5,
                'category_name' => 'Fashion and beauty blogs',
                'slug' => 'fashion-blog'
            ],
            [
                'id' => 6,
                'category_name' => 'Photography blogs',
                'slug' => 'photography-blog'
            ],
            [
                'id' => 7,
                'category_name' => 'Personal blogs',
                'slug' => 'personal-blog'
            ],
            [
                'id' => 8,
                'category_name' => 'DIY craft blogs',
                'slug' => 'craft-blog'
            ],
        ];
        
        foreach ($data as $key => $value) {
            Category::create($value);
        }
    }
}
