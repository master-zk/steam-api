<?php

declare(strict_types=1);

namespace app\foundation\service;

use ReflectionEnum;
use ReflectionException;

class AnnotationService
{
    /**
     * @throws ReflectionException
     */
    public function getReflectionEnums($objectOrClass): array
    {
        $list = [];

        $reflectionEnum = new ReflectionEnum($objectOrClass);
        foreach ($reflectionEnum->getCases() as $case) {
            $docComment = $case->getDocComment();
            preg_match('/\/\*\*\r*\n*.+\*(.+)\r*\n/', $docComment, $matches);
            $list[] = [
                'name' => ! empty($matches[1]) ? trim($matches[1]) : '',
                'val' => $case->getValue(),
            ];
        }

        return $list;
    }

    /**
     * @throws ReflectionException
     */
    public function getElementByName($objectOrClass, string $name): array
    {
        $enums = $this->getReflectionEnums($objectOrClass);

        $result = [];
        foreach ($enums as $enum) {
            if ($enum['val']->name === $name) {
                $result = [
                    'name' => $enum['name'],
                    'code' => $enum['val']->name,
                    'value' => $enum['val']->value,
                ];
            }
        }

        return $result;
    }

    /**
     * @throws ReflectionException
     */
    public function getElementByVal($objectOrClass, $val): array
    {
        $enums = $this->getReflectionEnums($objectOrClass);

        $result = [];
        foreach ($enums as $enum) {
            if ($enum['val']->value === $val) {
                $result = [
                    'name' => $enum['name'],
                    'code' => $enum['val']->name,
                    'value' => $enum['val']->value,
                ];
            }
        }

        return $result;
    }

    public function getNameByVal($objectOrClass, $val): array
    {
        $enums = $this->getReflectionEnums($objectOrClass);

        $result = null;
        foreach ($enums as $enum) {
            if ($enum['val']->value === $val) {
                $result = $enum['val']->name;
            }
        }

        return $result;
    }
}
