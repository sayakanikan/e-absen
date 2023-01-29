<?php

namespace App\Models;

use App\Models\Kelas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Model
{
    use HasFactory;
    protected $table = 'admins';
    protected $guarded = ['id'];

    public function kelas(){
        return $this->hasOne(Kelas::class);
    }
}
