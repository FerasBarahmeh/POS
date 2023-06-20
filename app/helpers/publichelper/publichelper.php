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
     * @param string $str
     * @return array|false
     * @version 1.0
     * To splitting camel case string to words
     * For example
     * word = splitCamelCase The Output is [split, Camel, Case]
     * @author Feras Barahmeh
     */
    public function splitCamelCase(string $str): array|false
    {
        return preg_split(
            '/(^[^A-Z]+|[A-Z][^A-Z]+)/',
            $str,
            -1, /* no limit for replacement count */
            PREG_SPLIT_NO_EMPTY /*don't return empty elements*/
            | PREG_SPLIT_DELIM_CAPTURE /*don't strip anything from output array*/
        );
    }

    /**
     * @param array $arr the array you want remove element from
     * @param array $targetElements all values you wont removed
     * @return void
     *
     * If you want to remove a specific element in array O(n)
     *
     * @version 1.0
     * @author Feras Barahmeh
     */
    public function unsetSpecificElementArray(array &$arr, array $targetElements): void
    {
        foreach ($targetElements as $ele) {
            unset($arr[$ele]);
        }
    }

    /**
     * @param object $obj object from class, you want fetch name properties
     * @param array|string|null $exceptionPropertiesName if you want exception specific property
     * @param bool $split if you want split name properties to words for example name property is `nameProperties`
     *       will return name properties as `name Properties`
     * @param bool $flip if you need flipping value with key
     *      for example ["complete" => 0] converted to ["0" => "completed"] default no flipping
     *
     * @return ?array associative array the key is a name property the value is a value of property
     *
     * @version 1.3
     *
     * To get name and value for each property class
     *
     * @see getClassValuesProperties() method in this calss
     *
     * @throws ReflectionException
     *
     * @author Feras Barahmeh
     *
     */
    public function getSpecificProperties(object $obj, array|string|null $exceptionPropertiesName=null, bool $split=false, bool $flip=false): ?array
    {
        if ($exceptionPropertiesName == null && ! $split)

            return
                $flip ?
                    array_flip((new ReflectionClass($obj::class))->getDefaultProperties())
                    : (new ReflectionClass($obj::class))->getDefaultProperties();

        if (! is_array($exceptionPropertiesName))
            $exceptionPropertiesName = [$exceptionPropertiesName];

        $props = (new ReflectionClass($obj::class))->getDefaultProperties();

        $this->unsetSpecificElementArray($props, $exceptionPropertiesName);

        if ($split) {
            $new = [];
            foreach ($props as $key => $val) {
                $word = $this->splitCamelCase($key);
                $word = implode(' ', $word);
                $new[$word] = $val;
            }
            if ($flip) {
                return  array_flip($new);
            }
            return $new;
        }

        if ($flip) {
            return array_flip($props);
        }
        return $props;
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

    /**
     * Method to merge to array not sequential merge
     *
     * @version 1.0
     * @author Feras Barahmeh
     * @param array $array1 the first array you need merged
     * @param array $array2 the second array you need merged
     * @return array
     */
    public function mergeArraysRandomly(array $array1, array $array2): array
    {
        $mergedArray = array_merge($array1, $array2);
        $randomizedArray = [];

        while (!empty($mergedArray)) {
            $randomIndex = array_rand($mergedArray);
            $randomizedArray[] = $mergedArray[$randomIndex];
            unset($mergedArray[$randomIndex]);
        }

        return $randomizedArray;
    }

}