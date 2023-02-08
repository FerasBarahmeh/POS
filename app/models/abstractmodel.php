<?php

namespace APP\Models;
use APP\Lib\Database\DatabaseHandler;
use PDO;
use function APP\pr;


class AbstractModel
{
    const DATA_TYPE_BOOL = \PDO::PARAM_BOOL;
    const DATA_TYPE_INT = \PDO::PARAM_INT;
    const DATA_TYPE_STR = \PDO::PARAM_STR;
    const DATA_TYPE_DECIMAL = 4;
    const DATA_TYPE_DATE = 5;
    protected $_info = [];

    private function bindParams(\PDOStatement &$stmt): void
    {
        foreach (static::$tableSchema as $columnName => $type)
        {
            if ($type != 4)
            {
                $stmt->bindValue(":{$columnName}", $this->$columnName, $type);
            }
            else
            {
                $sanitize = filter_var($this->$columnName, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $stmt->bindValue(":{$columnName}", $sanitize);
            }
        }
    }

    private static function buildNameParamSQL(): string
    {
        $query  = '';
        foreach (static::$tableSchema as $columnName => $type) {
            $query .= $columnName . " = :" . $columnName .  ", ";
        }

        return trim($query, ", ");
    }
    private function insert(): bool
    {
        $query = "INSERT INTO " . static::$tableName . " SET " . self::buildNameParamSQL() ;
        $stmt = DatabaseHandler::factory()->prepare($query);
        $this->bindParams($stmt);
        if ($stmt->execute()) {
            $this->{static::$primaryKey} = DatabaseHandler::lastInsertID();
            return true;
        }
        return false;
    }
    private function update()
    {
        $query = "UPDATE " . static::$tableName . " SET " . self::buildNameParamSQL() . " WHERE " . static::$primaryKey . " = " . $this->{static::$primaryKey} ;
        $stmt = DatabaseHandler::factory()->prepare($query);
        echo gettype($stmt);
        $this->bindParams($stmt);
        return $stmt->execute();
    }

    public function save()
    {
        if ($this->{static::$primaryKey} === null) {
            return $this->insert();
        } else {
            return $this->update();
        }
    }

    public function delete()
    {

        $query = "DELETE FROM " . static::$tableName . " WHERE " . static::$primaryKey . " = " . $this->{static::$primaryKey} ;
        $stmt = DatabaseHandler::factory()->prepare($query);
        return $stmt->execute();
    }



    public static function getAll(): bool|\ArrayIterator
    {
        $query = "SELECT * FROM " . static::$tableName;
        $stmt = DatabaseHandler::factory()->prepare($query);
        $stmt->execute();


        // Get All
        if (method_exists(get_called_class(), "__construct")) {
            $results = $stmt->fetchAll(
                \PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,
                get_called_class(),
                array_keys(static::$tableSchema)
            );
        }
        else {
            $results = $stmt->fetchAll(\PDO::FETCH_CLASS , get_called_class());
        }


        if ((is_array($results) && !empty($results)))  {
            return new \ArrayIterator($results);
        }

        return false;
    }

    public static function getByPK($pk)
    {
        $query = "SELECT * FROM " . static::$tableName . " WHERE " . static::$primaryKey . " = '" . $pk . "'";

        $stmt = DatabaseHandler::factory()->prepare($query);

        if ($stmt->execute() === true)
        {
            if (method_exists(get_called_class(), "__construct")) {
                $results = $stmt->fetchAll(
                    \PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,
                    get_called_class(),
                    array_keys(static::$tableSchema)
                );
            }
            else {
                $results = $stmt->fetchAll(\PDO::FETCH_CLASS , get_called_class());
            }

            return array_shift($results);
        }
        return false;
    }


    public static function getBy($columns, $options = []): false|\ArrayIterator
    {
        $whereClauseColumns = array_keys($columns);
        $whereClauseValues = array_values($columns);
        $whereClause = []; $numberConditions = count($whereClauseColumns);

        // Connection keys whit values.
        for ( $i = 0, $ii = $numberConditions; $i < $ii; $i++ ) {
            $whereClause[] = $whereClauseColumns[$i] . ' = "' . $whereClauseValues[$i] . '"';
        }

        // Bind all conditions
        $whereClause = implode(' AND ', $whereClause);

        $sql = 'SELECT * FROM ' . static::$tableName . '  WHERE ' . $whereClause;


        return (new UserGroupPrivilegeModel)->get($sql, $options);
    }

    public function get($query, $options): false|\ArrayIterator
    {
        $stmt = DatabaseHandler::factory()->prepare($query);
        $stmt->execute();
        if(method_exists(get_called_class(), '__construct')) {
            $results = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, get_called_class(), array_keys(static::$tableSchema));
        } else {
            $results = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class());
        }

        if ((is_array($results) && !empty($results))) {
            return new \ArrayIterator($results);
        }
        return false;
    }
}