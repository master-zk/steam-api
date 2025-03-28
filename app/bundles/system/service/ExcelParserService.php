<?php

declare(strict_types=1);

namespace app\bundles\system\service;

use app\exception\CustomException;
use Flame\Support\Facade\Log;
use PhpOffice\PhpSpreadsheet\IOFactory;

abstract class ExcelParserService
{
    /**
     * Excel 文件路径
     */
    protected string $excelFile;

    /**
     * Workbook 表头定义
     */
    protected array $mapper = [];

    /**
     * @throws CustomException
     */
    public function __construct(string $excelFile = '')
    {
        set_time_limit(0);
        ini_set('memory_limit', '1024M');

        if (file_exists($excelFile)) {
            $this->excelFile = $excelFile;
        } else {
            throw new CustomException('没有找到加载的文件：'.$excelFile);
        }
    }

    /**
     * 读取Excel文件的数组数据
     */
    public function toArray(): array
    {
        $sheetData = [];
        if (file_exists($this->excelFile)) {
            $spreadsheet = IOFactory::load($this->excelFile);
            foreach ($spreadsheet->getAllSheets() as $sheet) {
                $sheetData = array_merge($sheetData, $sheet->toArray());
            }
        }

        return $sheetData;
    }

    /**
     * 根据列映射返回格式化的数据
     */
    public function getData(array $columns, array $record): array
    {
        $data = [];
        foreach ($this->mapper as $cName => $eName) {
            $data[$eName] = $record[array_search($cName, $columns)];
        }

        return $data;
    }

    /**
     * 加载 cvs 文件数据
     *
     * @throws CustomException
     */
    public function csvPersistent(int $limit = 0): void
    {
        $tableHead = [];
        $fp = fopen($this->excelFile, 'r');
        if ($fp) {
            $i = 0;
            while (($buffer = fgets($fp)) !== false) {
                $buffer = trim(ltrim($buffer, "\xEF\xBB\xBF"));
                $row = str_getcsv($buffer);

                // 获取表头
                if (empty($tableHead)) {
                    $mapper = $this->getMapper();
                    foreach ($row as $key => $item) {
                        if (! isset($mapper[$item])) {
                            throw new CustomException('CSV列与数据表字段不匹配：'.$item);
                        }
                        $row[$key] = $mapper[$item];
                    }
                    $tableHead = $row;

                    continue;
                }

                // 组合数据
                $data = array_combine($tableHead, $row);

                // 数据过滤
                if (method_exists($this, 'filter')) {
                    $data = $this->filter($data);
                }

                // 数据处理
                if (! empty($data)) {
                    $this->process($data);

                    // 数据限制
                    if ($limit > 0 && ++$i >= $limit) {
                        break;
                    }
                }
            }
            fclose($fp);
        } else {
            Log::error(sprintf('无法打开文件: %s', $this->excelFile));

            throw new CustomException('无法打开文件');
        }
    }

    /**
     * 获取 Workbook 表头定义
     */
    public function getMapper(): array
    {
        return $this->mapper;
    }

    /**
     * 数据处理
     */
    public function process(array $sheetData): void
    {
        //
    }
}
