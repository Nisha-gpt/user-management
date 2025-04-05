<?php

namespace App\Models;

use App\Core\AbstractUser;
use App\Core\AuthInterface;
use App\Core\LoggerTrait;

class Admin extends AbstractUser implements AuthInterface 
{
    use LoggerTrait;

    public function userRole() 
    {
        return "Admin";
    }

    public function login($email, $password) 
    {
        if ($email === $this->email && password_verify($password, $this->password)) {
            $this->logActivity("Admin $this->name logged in.");
            return true;
        }
        return false;
    }

    public function logout() 
    {
        $this->logActivity("Admin $this->name logged out.");
        return true;
    }
}
