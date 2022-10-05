<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function store(){
        return $this->belongsTo(store::class,'store_id');
    }

    public function bank(){
        return $this->belongsTo(bank::class,'bank_id');
    }

    public function address(){
        return $this->belongsTo(Address::class,'address_id');
    }

}
