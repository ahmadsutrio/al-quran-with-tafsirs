<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terjemah extends Model
{
    use HasFactory;
    protected $table = "verse_translations";
    protected $guarded = ['id'];

    public function ayat(){
        return $this->belongsTo(Ayat::class, 'id_verse', 'id');
    }

    public function authorPenerjemah(){
        return $this->belongsTo(AuthorPenerjemah::class, 'id_translation', 'id');
    }
}
