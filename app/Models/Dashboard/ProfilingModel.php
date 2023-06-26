<?php

namespace App\Models\Dashboard;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilingModel extends Model
{
    use HasFactory;

    protected $table = 'resident';
    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'suffix',
        'dob',
        'age',
        'sex',
        'cstatus',
        'zone',
        'bplace',
        'cpnumber',
        'email',
        'pwd',
        'senior'
    ];


}
