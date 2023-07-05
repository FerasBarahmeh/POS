<?php

namespace APP\Models;

use APP\Helpers\PublicHelper\PublicHelper;
use Exception;
use mysql_xdevapi\Expression;
use ReflectionException;

trait TraitTransactionsModel
{
    use PublicHelper;
    private function containWhere($string): bool
    {
        return  str_contains($string, "where") || str_contains($string, "WHERE");
    }

    /**
     * method tack to set get object Model table and return name table and columns this table as element in array
     *
     * @param array $objectsModel object from table Model
     * @throws ReflectionException
     * @version 1.0
     * @author Feras Barahmeh
     */
    public function setSchema(array $objectsModel): array
    {
        $schema = [];
        foreach ($objectsModel as $objectModel) {
            $columns = $this->getSpecificProperties($objectModel);
            $tableName = $columns["tableName"];
            $columns = $columns["tableSchema"];
            $schema[$tableName] = $columns;
        }
        return $schema;
    }

    /**
     *
     * method to apply filter
     *
     * @param string $currentQuery the query you want to add the filter
     * @param array $filters POST method from form if type filter is column submit key is 'filter_by_column'
     * and contain filter_value has a value you want search it
     * if between filter submit value is 'filter-between' and has 'from' start value and 'to' end value
     *
     * @param array $columns associate array the key is a name table and the value the column in this table
     * @return void
     * @version 2.0
     * @author Feras Barahemhe
     */
    public function addSearchTerm(string &$currentQuery, array $filters, array $columns): void
    {
        if (isset($filters["filter_by_column"])) {
            $currentQuery .= $this->containWhere($currentQuery) ? " OR " : " WHERE ";

            $value = strip_tags($filters["filter_value"]);
            $termSearch = '';
            foreach ($columns as $tableName => $column) {
                foreach ($column as $schema => $item) {
                    $termSearch .= $tableName.".{$schema} LIKE '%{$value}%' OR \n";
                }
                $currentQuery .= $termSearch;
            }
            $this->removeLastWord($currentQuery);
        }
        elseif (isset($filters["filter-between"])) {

            if (empty($filters["from"]) || empty($filters["to"])) {
                return;
            }
            $currentQuery .= $this->containWhere($currentQuery) ? " OR " : " WHERE ";
            $from = strip_tags($filters["from"]);
            $to = strip_tags($filters["to"]);

            $termSearch = '';
            
            foreach ($columns as $tableName => $column) {
                foreach ($column as $schema => $item) {
                    $termSearch .= $tableName.".{$schema} BETWEEN '{$from}' AND '{$to}' OR \n";
                }
                $currentQuery .= $termSearch;
            }

            $this->removeLastWord($currentQuery);
        }
    }

}