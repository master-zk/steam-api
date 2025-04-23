<?php

namespace app\api\visitor\enum;

/**
 * 资源类型：image=图片 video=视频 audio=音频
 */
enum MediaTypeEnum :string
{
    case IMAGE = 'image';

    case VIDEO = 'video';

    case AUDIO = 'audio';
}
