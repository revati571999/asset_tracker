<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class asset_image extends Model
{
    use HasFactory;
    public function categories(){
        return $this->belongsTo(categories::class);
    }
}
