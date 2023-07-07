<?php

namespace App\Enums;

use Codestage\Authorization\Contracts\IPermissionEnum;

enum Permission: string implements IPermissionEnum
{
    // User
    case CreateUser = 'users.create';
    case ReadUser = 'users.read';
    case UpdateUser = 'users.update';
    case DeleteUser = 'users.delete';

    case ViewAdminDashboard = 'admin_dashboard.view';
    case ViewUserDashboard = 'user_dashboard.view';
}
