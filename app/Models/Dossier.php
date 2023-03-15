<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dossier extends Model
{
    use HasFactory;

    public $timestamps = false;// disable timetables

    public $fillable = ['email'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
