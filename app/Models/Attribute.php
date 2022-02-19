<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function values()
    {
        return $this->hasMany(Value::class);
    }
}
