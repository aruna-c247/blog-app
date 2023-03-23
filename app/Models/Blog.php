<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'category_id',
        'user_id',
        'description',
        'feature_image',
        'status',
        'slug'
    ];

    /**
     * Get the category record associated with the blog.
     */
    public function category()
    {
        return $this->hasOne(Category::class, 'id');
    }

}
