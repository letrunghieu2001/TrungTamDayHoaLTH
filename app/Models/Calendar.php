<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Calendar extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected $dates = ['deleted_at'];

    protected $table = 'calendars';

    public function classes()
    {
        return $this->belongsToMany(ChemistryClass::class, 'class_calendars', 'calendar_id', 'class_id');
    }
}
