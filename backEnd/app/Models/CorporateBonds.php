<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CorporateBonds extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'corporate_bonds';

    protected $fillable = [
        'description',
        'payment_type',
        'variavel_rate_type',
        'variavel_rate',
        'flat_rate',
    ];
}
