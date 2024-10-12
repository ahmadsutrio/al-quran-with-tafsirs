<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tafsirs extends Model
{
    use HasFactory;
    protected $table = "tafsirs";
    protected $guard = ['id'];

    public function verseTafsirs(){
        return $this->hasMany(VerseTafsirs::class, 'id_tafsir', 'id');
    }
}
