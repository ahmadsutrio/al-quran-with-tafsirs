<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surah extends Model
{
    use HasFactory;
    protected $table = "chapters";
    protected $guarded  = ['id'];

    public function ayat(){
        return $this->hasMany(Ayat::class, 'id_chapter', 'id');
    }
}
