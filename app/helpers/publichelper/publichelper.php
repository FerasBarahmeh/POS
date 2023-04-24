<?php

namespace APP\Helpers\PublicHelper;



use ReflectionClass;
use ReflectionException;

trait PublicHelper
{
    public function redirect($path): void
    {
        session_write_close();
        header("Location: " . $path);
        exit;
    }

    /**
     * @throws ReflectionException
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
     * @throws ReflectionException
     * @author Feras Barahmeh
     * @version 1.2 From getClassValuesProperties() method
     * To get name and value for each property class
     *
     * @param object $obj object from class, you want fetch name properties
     * @param array|string|null $exceptionPropertiesName if you want exception specific property
     *
     * @return ?array associative array the key is a name property the value is a value of property
     */
    public function getSpecificPropagates(object $obj, array|string|null $exceptionPropertiesName=null): ?array
    {
        if ($exceptionPropertiesName == null) return (new ReflectionClass($obj::class))->getDefaultProperties();

        if (! is_array($exceptionPropertiesName)) $exceptionPropertiesName = [$exceptionPropertiesName];

        $props = (new ReflectionClass($obj::class))->getDefaultProperties();

        foreach ($props as $key => $val) {
            if (in_array($key, $exceptionPropertiesName)) {
                unset($props[$key]);
                return $props;
            }
        }
        return null;
    }
    /**
     * @throws ReflectionException
     * @deprecated use the new version getSpecificPropagates()
     */
    public function getClassValuesProperties($obj): array
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