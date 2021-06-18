<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $timestamps = false;

    public $fillable = ['name'];

    public function meshdata(){
        return $this->hasMany(MeshData::class, 'category_id','id');
    }
}
