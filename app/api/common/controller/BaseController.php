<?php

declare(strict_types=1);

namespace app\api\common\controller;

use Flame\Routing\Controller;
use OpenApi\Attributes as OA;
use OpenApi\Attributes\Contact;

#[OA\Info(version: '1.0', description: '公共接口', title: 'JennySteamAPI文档', contact: new Contact('Develop Jenny'))]
#[OA\Server(url: '/', description: '开发环境')]
abstract class BaseController extends Controller
{
}
