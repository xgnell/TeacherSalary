<?php

namespace App\Constants;

class Role {
    const SuperAdmin = 0;
    const Admin = 1;
    const Accountant = 2;

    static function getName($role) {
        switch ($role) {
            case Self::SuperAdmin:
                return "Super admin";
                break;
            case Self::Admin:
                return "Admin";
                break;
            case Self::Accountant:
                return "Accountant";
                break;
        }

        dd("Invalid admin role value");
        return "";
    }
}