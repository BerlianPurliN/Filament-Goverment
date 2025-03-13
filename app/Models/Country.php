<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory;
    protected $fillable = ['name' , 'code' , 'phonecode'];
    public function city()
    {
        return $this->hasMany(City::class);
    }
    public function state()
    {
        return $this->hasMany( State::class);
    }
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
