<?php

namespace app\api\visitor\input;

use Flame\Support\ArrayHelper;

class GameInput
{
    use ArrayHelper;

    public int $platform_id = 0;

    public int $external_id = 0;

    public string $title = '';

    public string $capsule_image = '';

    public string $description = '';

    public string $short_description = '';

    public int $coming_soon = 0;

    public string|null $release_date = null;

    public int $is_free = 0;

    public int $age_rating = 0;

    public string $website_url = '';

    public int $os_windows = 2;

    public int $os_mac = 2;

    public int $os_linux = 2;
}