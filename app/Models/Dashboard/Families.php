<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Families extends Model
{
    use HasFactory;

    protected $table = 'families';
    protected $fillable = [
        'family_name',
        'with_Cr',
        'with_Electricity',
        'water_source'
    ];

    public $timestamps = false;

    public function family_members(): HasMany {
        return $this->hasMany(FamilyMembers::class, 'families_id', 'id');
    }
}
