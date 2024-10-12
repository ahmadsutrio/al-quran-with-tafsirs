<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerseTafsirs extends Model
{
    use HasFactory;
    protected $table = "verse_tafsirs";
    protected $guard = ['id'];

    public function ayat(){
        return $this->belongsTo(Ayat::class, 'id_verse', 'id');
    }

    public function tafsirs(){
        return $this->belongsTo(Tafsirs::class, 'id_tafsir', 'id');
    }
}

