# Jenny SteamApi

> 运行环境要求PHP8.2，启用 Redis 等扩展。

## 接口

https://call-center.dev.xhchuxing.com/

## 安装 MySql

```shell
docker run -d --name mysql -p 3306:3306 -v %CD%/docker/mysql/data:/var/lib/mysql -e MYSQL_ROOT_PASSWORD=root mysql:8.0.36 --character-set-server=utf8mb4 --collation-server=utf8mb4_unicode_ci
docker run -d --name mysql -p 3306:3306                                          -e MYSQL_ROOT_PASSWORD=root mysql:8.0.36 --character-set-server=utf8mb4 --collation-server=utf8mb4_unicode_ci
```

## 安装 Redis

```shell
docker run -d --name redis -p 6379:6379 redis:7.2 redis-server --save 60 1 --loglevel warning
```

## 环境准备

### Docker 环境

```shell
docker build -t apache-php8.2-steam docker
docker run --rm -d --name jenny-steam-api -v %cd%:/var/www/html -v %cd%/docker/conf:/etc/apache2/sites-enabled -p 8007:80 apache-php8.2-steam
```
#### Docker开发环境如下:
```shell
docker build -t apache-php8.2-steam docker
# 需要重复启停，不使用--rm，本地端口8007
docker run -d --name jenny-steam-api -v D:\code\php\steam-api-php:/var/www/html -v D:\code\php\steam-api-php\docker\conf:/etc/apache2/sites-enabled -p 8007:80 apache-php8.2-steam
```

注意在`cmd`模式下运行以上代码。

### WSL2 环境

推荐参考 PHPUnit [部署文档](https://docs.phpunit.de/en/10.0/installation.html)，基于 Debian 快速搭建开发环境。

```shell
sudo apt install curl -y
curl -sSL https://packages.sury.org/php/README.txt | sudo bash -x
sudo apt update
sudo apt install php8.2-{cli,curl,bcmath,dom,gd,intl,mbstring,mysql,opcache,redis,sqlite3,swoole,zip}
php artisan serve
```

### WAMP 环境

推荐使用 [Laragon](https://laragon.org/download/) 集成开发环境。

## 快速开始

### 克隆代码

```shell
composer config -g repos.packagist composer https://packagist.pages.dev
composer install
```

### ENV配置

```
cp .env.example .env
```

### 数据迁移

```
php artisan migrate
```

### 数据填充

```
php artisan seed:run
```

### 启动运行

现在只需要做最后一步来验证是否正常运行。

进入命令行下面，执行下面指令

```shell
php artisan serve
php artisan serve start # 开启workman，用于执行定时任务
```

在浏览器中输入地址：

http://127.0.0.1:8007/

## 开发

### 目录结构

```
├── app                    核心应用目录
│   ├── api                API访问模块
│   │   ├── employee       员工模块服务
│   │   │   ├── controller 业务控制器
│   │   │   └── other
│   │   └── common         公共模块接口
|   ├── bundles            包
|   |   ├── manager        包名 
|   |   |   ├── controller 业务控制器
|   |   |   |   ├── employee
|   |   |   |   └── other
|   │   │   ├── request    业务请求类
│   │   │   ├── response   业务响应类
│   │   │   ├── migrations 数据迁移文件
│   │   │   ├── seeders    数据填充文件
│   │   │   └── service    业务服务类
│   ├── console            控制台程序类
│   ├── constant           应用常量
│   ├── contract           契约接口类
│   ├── entity             数据表实体类
│   ├── enums              枚举类
│   ├── exception          异常类
│   ├── jobs               异步任务类
│   ├── manager            外部接口服务类
│   ├── model              数据表模型类
│   ├── repository         DAO数据访问
│   ├── service            公共业务服务
│   └── support            支持工具包
├── artisan                控制台脚本入口
├── bootstrap              启动目录
│   └── app.php            应用准备程序
├── composer.json          composer依赖
├── composer.lock           
├── config                 全局配置
│   ├── app.php            应用配置
│   ├── cache.php          缓存配置
│   ├── cookie.php         cookie配置
│   ├── database.php       数据库配置
│   ├── dingtalk.php       钉钉配置
│   ├── filesystem.php     文件系统配置
│   ├── jwt.php            JWT配置
│   ├── log.php            日志配置
│   ├── mail.php           邮件配置
│   ├── phinx.php          数据迁移配置
│   ├── queue.php          队列配置
│   ├── route.php          路由配置
│   ├── sms.php            短信配置
│   ├── sip.php            Sip配置
│   └── wechat.php         微信配置
├── database               数据库文件
│   ├── migrations         数据迁移文件
│   └── seeders            数据填充文件
├── docker                 docker 配置
│   ├── conf               容器配置
│   └── Dockerfile         Dockerfile
├── docs                   文档目录
├── package                核心框架
├── phpunit.xml            phpunit 配置
├── public                 公网访问入口
│   ├── apidoc             swagger ui
│   ├── data               公开文件目录
│   ├── favicon.ico        
│   ├── index.php          程序入口
│   ├── robots.txt         
│   └── storage            本地文件存储目录
├── README.md              项目介绍
├── resource               资源文件目录
│   └── emails             邮件模板
├── runtime                运行时目录
│   ├── cache              运行时缓存
│   └── logs               运行时日志
├── scripts                脚本目录
├── tests                  测试目录
│   ├── feature            功能测试
│   ├── TestCase.php       测试基类
│   └── unit               单元测试
└── vendor                 composer包
```

### 请求周期

开发实行分层调用：

```
API 网关 -> index.php -> 启动核心框架
	-> request 请求验证层（表单验证）
	-> controller 按照MCA路由分发处理请求（M：模块，C：控制器，A：处理方法）
	-> service 调用业务逻辑服务层
	-> manager 通用逻辑层（如外部短信服务等）
	-> model 调用数据表关系模型层
	-> DB 底层查询数据库
```

返回的数据按照逆向数据流响应给客户端的API.

### 配置伪静态

打开生成的 nginx 配置文件，设置伪静态规则：

```
location / {
    if (!-f $request_filename) {
   	    rewrite  ^(.*)$  /index.php?r=/$1  last;
    }
}
```

### 生成代码和API文档

```shell
./scripts/gen.sh
./scripts/gen.sh api # 生成swagger文档
./scripts/gen.sh code # 执行 php artisan migrate、seed:run 并根据mysql生成代码
./scripts/gen.sh pint # 格式化代码
```

### 调试模式

应用默认是部署模式，在开发阶段，可以修改环境变量APP_DEBUG开启调试模式，上线部署后切换到部署模式。

本地开发的时候可以在应用根目录下面定义.env文件。

## v1.0.0 部署准备
###  `./runtime/` 需要读写权限

### 配置文件


- 配置文件以`.env.example`为模板，按运行环境`实际数据`进行填充

### 定时任务


- 服务需要执行 `php artisan worker:serve start` 以开启workman执行定时任务
