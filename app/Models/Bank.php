<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Bank extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'banks';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'property_id',
        'number',
        'name',
        'cardholder',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const NAME_SELECT = [
        '014' => 'BCA ( BANK CENTRAL ASIA )',
        '002' => 'BRI ( BANK RAKYAT INDONESIA )',
        '009' => 'BNI ( BANK NEGARA INDONESIA )',
        '008' => 'MANDIRI',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}