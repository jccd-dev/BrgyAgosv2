<?php

namespace App\Models\Dashboard;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'senior',
        'deseased'
    ];

    public function family_members(): HasOne {
        return $this->hasOne(FamilyMembers::class, 'resident_id', 'id');
    }


}
