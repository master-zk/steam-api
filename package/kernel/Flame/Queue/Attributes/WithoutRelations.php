<?php

declare(strict_types=1);

namespace Flame\Queue\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_PROPERTY)]
class WithoutRelations
{
    //
}
