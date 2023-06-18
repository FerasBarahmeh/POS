<?php

namespace APP\Models;

use Exception;

trait TraitTransactionsModel
{
    private function containWhere($string): bool
    {
        return  str_contains($string, "where") || str_contains($string, "WHERE");
    }
    private function pushBetweenQuery(&$sql, $betweenFilter): void
    {
        if (! $this->containWhere($sql)) {
            $sql .= " WHERE ";
        } else {
            $sql .= " AND ";
        }

        $sql .= $betweenFilter["column"] . " BETWEEN '" . $betweenFilter["from"] . "' AND '" . $betweenFilter["to"] . "'";

    }

    /**
     *
     * method to add filters to Query like between or add condition
     *
     * @param string $currentQuery the query you want to add the filter
     * @param array $filters associative array contain name filter and vales like
     *                  filters = [
     *                              "between" => [fromValue, toValue]
     *                          ]
     * @return void The query with condition
     * @throws Exception
     * @version 1.0
     */
    public function addFilterToQuery(string &$currentQuery, array $filters): void
    {
        if ($filters == null ) return;
        $filters = array_change_key_case($filters, CASE_LOWER);

        if (array_key_exists("between", $filters)) {
            if ($filters["between"]["column"] == null)  throw new  \Exception("Must Be set colum you want filter by");
            $this->pushBetweenQuery($currentQuery, $filters["between"]);
        }
    }

}