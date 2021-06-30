<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MeshData extends Model
{
    use HasFactory;

    protected $fillable = ['device_id','category_id','data'];

//    protected $casts = [
//        'created_at' => 'h:i:s', //Hours minutes seconds. Change this later to include Date once dataset is bigger
//        'created_at' => 'h:i:s',
//    ];

    public function device()
    {
        return $this->hasOne(Device::class, 'id', 'device_id');
    }

    public function category()
    {
        return $this->hasOne(Category::class,'id','category_id');
    }
}
