<?php

namespace App\Models\Dashboard;

use App\Models\Dashboard\Families;
use App\Models\Dashboard\Household;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HouseholdFamilies extends Model{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'household_families';
    protected $fillable = ['household_id', 'families_id'];

    public function household():BelongsTo{
        return $this->belongsTo(Household::class, 'household_id');
    }

    public function families():BelongsTo{
        return $this->belongsTo(Families::class, 'families_id');
    }
}
