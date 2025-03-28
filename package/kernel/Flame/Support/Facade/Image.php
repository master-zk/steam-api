<?php

declare(strict_types=1);

namespace Flame\Support\Facade;

use Flame\Image\Image as ImageManager;

/**
 * @mixin ImageManager
 */
class Image extends Facade
{
    protected static function getFacadeClass(): string
    {
        return ImageManager::class;
    }
}
