<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'image', 'parent_id', 'is_active', 'is_delete'
    ];

    // Quan hệ để lấy tên danh mục cha
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Quan hệ lấy danh mục con (để check đệ quy)
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
