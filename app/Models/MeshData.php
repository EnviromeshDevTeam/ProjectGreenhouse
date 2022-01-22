<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

    class MeshData extends Model
    {
        use HasFactory;

        protected $fillable = ['device_id','category_id','data', 'created_at', 'updated_at'];

        public function device()
        {
            return $this->belongsTo(Device::class, 'id', 'device_id');
        }

        public function category()
        {
            return $this->belongsTo(Category::class,'id','category_id');
        }
    }
