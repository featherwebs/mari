<?php

namespace Featherwebs\Mari\Models;

use Zizaco\Entrust\EntrustPermission;
use Featherwebs\Mari\Traits\Flushable;

class Permission extends EntrustPermission
{
    use Flushable;
}
