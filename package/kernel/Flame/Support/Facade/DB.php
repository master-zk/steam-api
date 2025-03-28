<?php

declare(strict_types=1);

namespace Flame\Support\Facade;

use think\db\Query;
use think\db\Raw;
use think\DbManager;
use think\facade\Db as BaseDB;

/**
 * @see DbManager
 *
 * @method static string getLastSql() 获取执行的sql语句
 * @method static Query table(string|array|Raw $table) 指定操作的数据表
 *
 * @mixin DbManager
 */
class DB extends BaseDB
{
    /**
     * 数据字段数据加密
     */
    public static function aesEncrypt(string $fieldVal, string $rowKey): Raw
    {
        $config = config('database');
        $func = $config['aes_encrypt_func'].'("'.$fieldVal.'", "'.$config['secret_key'].'", "'.$rowKey.'")';

        return BaseDB::raw($func);
    }

    /**
     * 数据字段数据解密
     */
    public static function aesDecrypt(string $fieldName, string $rowKeyField): Raw
    {
        $config = config('database');
        $field = $config['aes_decrypt_func'].'(`'.$fieldName.'`, "'.$config['secret_key'].'", `'.$rowKeyField.'`) AS '.$fieldName;

        return BaseDB::raw($field);
    }

    /**
     * 指定表达式查询
     */
    public static function aesFieldRaw(string $fieldName, string $rowKeyField): Raw
    {
        $config = config('database');

        return BaseDB::raw($config['aes_decrypt_func'].'(`'.$fieldName.'`, "'.$config['secret_key'].'", `'.$rowKeyField.'`)');
    }
}
