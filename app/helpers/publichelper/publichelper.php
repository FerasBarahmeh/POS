<?php

namespace APP\Helpers\PublicHelper;



use ReflectionClass;

trait PublicHelper
{
    public function redirect($path): void
    {
        session_write_close();
        header("Location: " . $path);
        exit;
    }

    /**
     * @throws \ReflectionException
     */
    public function getClassProperties($obj, $getClassName=true): array
    {
        $data = (new ReflectionClass($obj::class))->getProperties();
        if (! $getClassName) {
            return $data;
        }

        $nameProperties = [];
        foreach ($data as $row) {
            $nameProperties[] = $row->name;
        }

        return $nameProperties;
    }

    /**
     * @throws \ReflectionException
     */
    public function getClassValuesProperties($obj, $getClassName=true): array
    {
        return (new ReflectionClass($obj::class))->getDefaultProperties();
    }

    public function getLastWord($str): string
    {
        $len = strlen($str);
        $str = trim($str);
        $lastWord = "";

        for ($i = $len - 1; $i >= 0; $i--) {
            if (! ctype_space($str[$i])) {
                $lastWord .= $str[$i];
            } else {
                break;
            }
        }
        return $lastWord;
    }
    public function posLastWord(string $str): int
    {
        $str = rtrim($str);

        $len = strlen($str);

        
        $i = $len - 1;
        for (; $i >= 0; $i--) {
            if (ctype_space($str[$i])) {
                break;
            }
        }
        return $i;
    }
    public function removeLastWord(&$str): void
    {
        $str = substr($str, 0, $this->posLastWord($str));
    }
}