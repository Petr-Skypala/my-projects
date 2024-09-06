<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Daytime extends Model
{
    use HasFactory;

    protected $fillable = ['day', 'from', 'to', 'day_hours'];

    public function carer(): BelongsTo
    {
        return $this->belongsTo(Carer::class);
    }


}
