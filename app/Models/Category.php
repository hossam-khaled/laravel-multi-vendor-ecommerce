<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

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

    public function scopeActive(Builder $builder)
    {
        return $builder->where('status', 'active');
    }

    public function scopeFilter(Builder $builder, $filters)
    {
        return $builder
            ->when($filters['search'] ?? false, function ($query, $search) {
                $query->where('categories.name', 'like', '%' . $search . '%');
            })
            ->when($filters['status'] ?? false, function ($query, $status) {
                $query->where('categories.status', $status);
            });
    }

    public static function rules($id = 0)
    {
        return [
            // 'required|string|min:3|max:255|unique:categories,name,' . $id,
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('categories')->ignore($id),
                function( $atribute, $value, $fail) use ($id) {
                    // if (Category::where('name', $value)->where('id', '!=', $id)->exists()) {
                    //     $fail('The ' . $attribute . ' has already been taken.');
                    // }
                    if ( strtolower( $value ) === 'uncategorized' ) {
                        $fail('The ' . $atribute . ' cannot be "uncategorized".');
                    }
                }
            ],
            'parent_id' => 'nullable|int|exists:categories,id',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ];
    }
}
