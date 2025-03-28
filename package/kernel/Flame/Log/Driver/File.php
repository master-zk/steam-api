<?php

declare(strict_types=1);

namespace Flame\Log\Driver;

use DateTime;
use DateTimeZone;
use Exception;
use Flame\Log\Contract\LogHandlerInterface;

class File implements LogHandlerInterface
{
    /**
     * 配置参数
     */
    protected array $config = [
        'time_format' => 'c',
        'single' => false,
        'file_size' => 2097152,
        'path' => '',
        'apart_level' => [],
        'max_files' => 0,
        'json' => false,
        'json_options' => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES,
        'format' => '[%s][%s] %s',
    ];

    public function __construct()
    {
        $config = config('log.channels.file');

        if (is_array($config)) {
            $this->config = array_merge($this->config, $config);
        }

        if (empty($this->config['format'])) {
            $this->config['format'] = '[%s][%s] %s';
        }

        if (empty($this->config['path'])) {
            $this->config['path'] = runtime_path('logs');
        }

        if (substr($this->config['path'], -1) != DIRECTORY_SEPARATOR) {
            $this->config['path'] .= DIRECTORY_SEPARATOR;
        }
    }

    /**
     * 日志写入接口
     *
     * @throws Exception
     */
    public function save(array $log): bool
    {
        $destination = $this->getMasterLogFile();

        $path = dirname($destination);
        ! is_dir($path) && mkdir($path, 0755, true);

        $info = [];

        // 日志信息封装
        $time = DateTime::createFromFormat('0.u00 U', microtime())->setTimezone(new DateTimeZone(date_default_timezone_get()))->format($this->config['time_format']);

        foreach ($log as $type => $val) {
            $message = [];
            foreach ($val as $msg) {
                if (! is_string($msg)) {
                    $msg = var_export($msg, true);
                }

                $message[] = $this->config['json'] ?
                    json_encode(['time' => $time, 'type' => $type, 'msg' => $msg], $this->config['json_options']) :
                    sprintf($this->config['format'], $time, $type, $msg);
            }

            if ($this->config['apart_level'] === true || in_array($type, $this->config['apart_level'])) {
                // 独立记录的日志级别
                $filename = $this->getApartLevelFile($path, $type);
                $this->write($message, $filename);

                continue;
            }

            $info[$type] = $message;
        }

        if ($info) {
            return $this->write($info, $destination);
        }

        return true;
    }

    /**
     * 日志写入
     */
    protected function write(array $message, string $destination): bool
    {
        // 检测日志文件大小，超过配置大小则备份日志文件重新生成
        $this->checkLogSize($destination);

        $info = [];

        foreach ($message as $type => $msg) {
            $info[$type] = is_array($msg) ? implode(PHP_EOL, $msg) : $msg;
        }

        $message = implode(PHP_EOL, $info).PHP_EOL;

        return error_log($message, 3, $destination);
    }

    /**
     * 获取主日志文件名
     */
    protected function getMasterLogFile(): string
    {

        if ($this->config['max_files']) {
            $files = glob($this->config['path'].'*.log');

            try {
                if ($this->config['max_files'] < count($files)) {
                    unlink($files[0]);
                }
            } catch (Exception $e) {
                //
            }
        }

        if ($this->config['single']) {
            $name = is_string($this->config['single']) ? $this->config['single'] : 'single';
            $destination = $this->config['path'].$name.'.log';
        } else {

            if ($this->config['max_files']) {
                $filename = date('Ymd').'.log';
            } else {
                $filename = date('Ym').DIRECTORY_SEPARATOR.date('d').'.log';
            }

            $destination = $this->config['path'].$filename;
        }

        return $destination;
    }

    /**
     * 获取独立日志文件名
     */
    protected function getApartLevelFile(string $path, string $type): string
    {
        if ($this->config['single']) {
            $name = is_string($this->config['single']) ? $this->config['single'] : 'single';

            $name .= '_'.$type;
        } elseif ($this->config['max_files']) {
            $name = date('Ymd').'_'.$type;
        } else {
            $name = date('d').'_'.$type;
        }

        return $path.DIRECTORY_SEPARATOR.$name.'.log';
    }

    /**
     * 检查日志文件大小并自动生成备份文件
     */
    protected function checkLogSize(string $destination): void
    {
        if (is_file($destination) && floor($this->config['file_size']) <= filesize($destination)) {
            try {
                rename($destination, dirname($destination).DIRECTORY_SEPARATOR.time().'-'.basename($destination));
            } catch (Exception $e) {
                //
            }
        }
    }
}
