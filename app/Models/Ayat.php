<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ayat extends Model
{
    use HasFactory;
    protected $table = "verses";
    protected $guard = ['id'];

    public function surah(){
        return $this->belongsTo(Surah::class, 'id_chapter', 'id');
    }
}
