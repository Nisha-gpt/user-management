<?php

namespace App\Models;

use App\Core\AbstractUser;
use App\Core\AuthInterface;

class RegularUser extends AbstractUser implements AuthInterface 
{
    public function userRole() 
    {
        return "Regular";
    }

    public function login($email, $password) 
    {
        if ($email === $this->email && password_verify($password, $this->password)) 
        {
            return true;
        }
        return false;
    }

    public function logout() 
    {
        return true;
    }
}
