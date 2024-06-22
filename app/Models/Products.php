<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'name',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_name', 'id');
    }
}


