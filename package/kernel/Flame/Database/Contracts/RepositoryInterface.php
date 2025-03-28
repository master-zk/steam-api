<?php

declare(strict_types=1);

namespace Flame\Database\Contracts;

use Flame\Database\Model;

interface RepositoryInterface
{
    public function model(): Model;
}
