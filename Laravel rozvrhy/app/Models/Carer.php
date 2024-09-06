<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Carer extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'last_name', 'weekly_hours',
    ];

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    public function daytimes(): HasMany
    {
        return $this->hasMany(Daytime::class);
    }    

    public function doctors(): HasMany
    {
        return $this->hasMany(Doctor::class);
    }

}
