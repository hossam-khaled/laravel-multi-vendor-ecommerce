<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";

    protected $connection = "mysql";

    protected $fillable = [
        'name',
        'description',
        'image',
        'status',
        'slug',
        'parent_id'
    ];

    public static function rules($id = 0)
    {
        return [
            'name' => 'required|string|min:3|max:255|unique:categories,name,' . $id,
            'parent_id' => 'nullable|int|exists:categories,id',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ];
    }
}
