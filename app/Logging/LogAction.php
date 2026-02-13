<?php

namespace App\Logging;

enum LogAction: string
{
    case LOGIN = 'login';
    case LOGOUT = 'logout';
    case CREATE = 'create';
    case UPDATE = 'update';
    case DELETE = 'delete';
    case ACCESS = 'access';
    case ERROR = 'error';
}
