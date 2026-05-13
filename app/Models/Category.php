<?php

namespace App\Models;

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
