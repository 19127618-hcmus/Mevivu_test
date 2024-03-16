<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'slug', 'is_featured', 'status', 'image', 'excerpt', 'content', 'posted_at', 'created_at', 'updated_at']; // Danh sách các cột có thể gán dữ liệu

    // Hoặc sử dụng $guarded để chỉ định các trường không được gán tự động
    // protected $guarded = [];
}
