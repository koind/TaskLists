<?php

namespace App\Models;

use App\Components\Magic;
use App\Models\Model;

class User extends Model
{
    use Magic;

    const TABLE = 'users';

    public $id;
    public $email;
    public $login;
    public $password;
    public $isAdmin;
    
}