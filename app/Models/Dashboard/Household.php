<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;
use App\Models\Dashboard\HouseholdFamilies;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Household extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'household';
    protected $fillable = [
        'family_head',
        'h_structure',
        'water_source',
        'electricity',
        'comfort_room',
        'waste_management',
    ];

    public function household_fam(): HasMany{
        return $this->hasMany(HouseholdFamilies::class, 'household_id', 'id');
    }

}
