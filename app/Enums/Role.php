<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class Role extends Enum implements LocalizedEnum
{
    const USER =   0;
    const ADMIN =   1;
}
