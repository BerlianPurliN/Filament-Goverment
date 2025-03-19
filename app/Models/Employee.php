<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'date_hired', 'date_of_birth', 'photo' , 'city_id','country_id', 'state_id', 'department_id', 'zip_code'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

}
