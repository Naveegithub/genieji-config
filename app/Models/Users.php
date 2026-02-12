<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Model;

// class Users extends Model
// {
//     protected $fillable = [
//         'name',
//         'email',
//         'mobile',
       
//     ];
// public function roles()
// {
//     return $this->belongsToMany(
//         Role::class,
//         'role_user',
//         'user_id',
//         'role_id'
//     );
// }

// }

 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Users extends Model
{
    protected $table = 'users';
 
    protected $fillable = [
        'name',
        'email',
        'mobile',
        
    ];
}
