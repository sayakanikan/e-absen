<?php

namespace App\Models;

use App\Models\Kelas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticable
{
    use HasFactory;
    use Notifiable;
    protected $table = 'admins';
    protected $guarded = ['id'];
    protected $hidden = ['password'];

    public function kelas(){
        return $this->hasOne(Kelas::class);
    }
}
