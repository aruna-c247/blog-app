<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Blog;

class BlogSeeder extends Seeder
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
            'title' => 'Improve design with typography?',
            'category_id' => 4,
            'user_id' => 1,
            'slug' => 'improve-design',
            'description' => 'Non illo quas blanditiis repellendus laboriosam minima animi. Consectetur accusantium pariatur repudiandae!',
            'feature_image' => '1709340790_1679662163_typography.jpg',
            
            ],
            [
                'id' => 2,
                'title' => 'Interactivity connect consumer',
                'category_id' => 7,
                'user_id' => 1,
                'slug' => 'inter-activity',
                'description' => 'Non illo quas blanditiis repellendus laboriosam minima animi. Consectetur accusantium pariatur repudiandae!',
                'feature_image' => '1399896773_1679662103_Interactivity.jpg',
              
                
            ],
            [
                'id' => 3,
                'title' => 'Marketing Strategy to bring more affect',
                'category_id' => 6,
                'user_id' => 1,
                'slug' => 'market-strategy',
                'description' => 'Non illo quas blanditiis repellendus laboriosam minima animi. Consectetur accusantium pariatur repudiandae!',
                'feature_image' => '601597794_1679662117_Marketing.jpg',
                
            ],
            [
                'id' => 4,
                'title' => 'Marketing Strategy to bring more affect',
                'category_id' => 8,
                'user_id' => 1,
                'slug' => 'more-affect',
                'description' => 'Non illo quas blanditiis repellendus laboriosam minima animi. Consectetur accusantium pariatur repudiandae!',
                'feature_image' => '226466977_1679662135_Marketing Strategy.jpg',
                
            ],
            [
                'id' => 5,
                'title' => 'How to make dessert at Home?',
                'category_id' => 1,
                'user_id' => 1,
                'slug' => 'dessert-blog',
                'description' => 'Non illo quas blanditiis repellendus laboriosam minima animi. Consectetur accusantium pariatur repudiandae!',
                'feature_image' => '733520556_1679579868_dessert.jpg',
               
            ],
            [
                'id' => 6,
                'title' => 'Coffee',
                'category_id' => 1,
                'user_id' => 1,
                'slug' => 'coffee',
                'description' => 'Non illo quas blanditiis repellendus laboriosam minima animi. Consectetur accusantium pariatur repudiandae!',
                'feature_image' => '388206515_1679643337_drink-302.jpg',
               
            ],
            [
                'id' => 7,
                'title' => 'Diet',
                'category_id' => 1,
                'user_id' => 1,
                'slug' => 'diet-blog',
                'description' => 'Non illo quas blanditiis repellendus laboriosam minima animi. Consectetur accusantium pariatur repudiandae!',
                'feature_image' => '182259461_1679579853_vegetable-skewer.jpg',
                
            ],
            [
                'id' => 8,
                'title' => 'design with typography?',
                'category_id' => 4,
                'user_id' => 1,
                'slug' => 'typo-graph',
                'description' => 'Non illo quas blanditiis repellendus laboriosam minima animi. Consectetur accusantium pariatur repudiandae!',
                'feature_image' => '1709340790_1679662163_typography.jpg',
                
            ],
        ];
        foreach ($data as $key => $value) {
            Blog::create($value);
        }
    }
    
}
