<?php

namespace APP\Helpers\PublicHelper;



use ReflectionClass;
use function APP\pr;

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
}