<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = ['day', 'from', 'to'];

    public function carer(): BelongsTo
    {
        return $this->belongsTo(Carer::class);
    }

    /**
     * Vrátí vloženou kolekci po změně názvu dne z anglické zkratky na český popis
     */
    public static function replace($items_res) : array
    {
        $items = [];
        foreach ($items_res as $item)
        {
            if ($item['day'] === 'Mon') {
                $item['day'] = 'Pondělí';
                $item['order'] = 1;
            }
            if ($item['day'] === 'Tue') {
                $item['day'] = 'Úterý';
                $item['order'] = 2;
            }
            if ($item['day'] === 'Wed') {
                $item['day'] = 'Středa';
                $item['order'] = 3;
            }
            if ($item['day'] === 'Thu') {
                $item['day'] = 'Čtvrtek';
                $item['order'] = 4;
            }
            if ($item['day'] === 'Fri') {
                $item['day'] = 'Pátek';
                $item['order'] = 5;
            }

            $items = $items + [$item];
        }
        return $items;

    }

}
