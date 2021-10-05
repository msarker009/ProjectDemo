<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'email',
        'image',
    ];


    public function phone()
    {
        return $this->hasOne('App\Models\Phone','emp_id');
    }
}
