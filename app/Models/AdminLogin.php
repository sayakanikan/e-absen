<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminLogin extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $table = 'admins';
    protected $guard = 'admin';

    protected $guarded = ['id'];
    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // public static function all($columns = array('*'))
	// {
	// 	$instance = new static;
	// 	if (PermissionsLibrary::hasPermission('mod-pengusul-listall')) {
	// 		return $instance->newQuery()->paginate(@Session::get('configurations')['list-limit']);
	// 	} else {
	// 		return $instance->newQuery()
	// 			->where('role_id', Session::get('role_id'))
	// 			->paginate($_ENV['configurations']['list-limit']);
	// 	}
	// }


}
