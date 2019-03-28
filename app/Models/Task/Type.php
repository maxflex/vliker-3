<?php

namespace App\Models\Task;

use MyCLabs\Enum\Enum;

class Type extends Enum
{
    const LIKE = 'like';
    const SUBSCRIBE = 'subscribe';
    const COMMENT = 'comment';
}
