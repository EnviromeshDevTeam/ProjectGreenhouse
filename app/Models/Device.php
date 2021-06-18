<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    public $timestamps = true;

    public $fillable = ['name', 'address'];

    public function data()
    {
        return $this->hasMany(MeshData::class);
    }
}
