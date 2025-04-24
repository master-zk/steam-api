<?php

namespace app\api\visitor\controller;


use app\api\common\controller\BaseController;
use OpenApi\Attributes\Contact;
use OpenApi\Attributes as OA;


#[OA\Info(version: '1.0', description: '公共接口', title: '携华客服API文档', contact: new Contact('XH Develop Team'))]
#[OA\Server(url: '/', description: '开发环境')]
class VisitorBaseController extends BaseController
{
}