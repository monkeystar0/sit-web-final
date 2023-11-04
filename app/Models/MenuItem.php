<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;
    // protected $attributes = [
    //     'attribute_name' => 'default value',
    //     // Other default attribute values
    // ];
    protected $table = 'menu_items';

    protected $primaryKey = 'id';

    public $incrementing = true;
    protected $fillable = [
        'name', 'description' , 'price', 'image', 'menu_group'
    ];
}

