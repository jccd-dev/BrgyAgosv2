<?php

namespace App\Models\Dashboard;

use App\Models\Dashboard\Families;
use Illuminate\Database\Eloquent\Model;
use App\Models\Dashboard\ProfilingModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FamilyMembers extends Model
{
    use HasFactory;

    protected $table = 'family_members';
    protected $fillable = [
        'families_id',
        'resident_id',
        'family_role'
    ];

    public $timestamps = false;

    public function resident():BelongsTo {
        return $this->belongsTo(ProfilingModel::class, 'resident_id');
    }

    public function families(): BelongsTo{
        return $this->belongsTo(Families::class, 'families_id');
    }
}
