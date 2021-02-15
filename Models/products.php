<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'type','name','productimg','price','desc','qty','type','discount','total','status'
    ];
}
