<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'phone',
        'id_hospital',
    ];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class, 'id_hospital', 'id');
    }
}
