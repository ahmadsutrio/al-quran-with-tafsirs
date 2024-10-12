<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthorPenerjemah extends Model
{
    use HasFactory;
    protected $table = "translations";
    protected $guarded = ['id'];

    public function terjemah(){
        return $this->hasMany(Terjemah::class, 'id_translation', 'id');
    }
}
