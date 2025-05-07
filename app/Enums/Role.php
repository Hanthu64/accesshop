<?php

namespace App\Enums;

enum Role: string{
    case User = 'user';
    case Provider = 'provider';
    case Admin = 'admin';

}
