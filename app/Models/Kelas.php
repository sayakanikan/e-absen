<?php

namespace App\Models;

use App\Models\User;
use App\Models\Admin;
use App\Models\Absen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function admin(){
        return $this->belongsTo(Admin::class);
    }

    public function user(){
        return $this->hasMany(User::class);
    }

    public function absen(){
        return $this->hasMany(Absen::class);
    }
}
