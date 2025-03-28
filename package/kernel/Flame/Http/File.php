<?php

declare(strict_types=1);

namespace Flame\Http;

use Symfony\Component\HttpFoundation\File\File as SymfonyFile;

class File extends SymfonyFile
{
    use FileHelpers;
}
