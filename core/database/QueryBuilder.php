<?php

class QueryBuilder
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    public function selectAll($table)
    {
        $statement = $this->pdo->prepare("select*from {$table}");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_OBJ);
    }

    public function checkSingle($table, $column, $singleValue)
    {
        $statement = $this->pdo->prepare("select {$column} from {$table} where {$column}='{$singleValue}'");
        $statement->execute();
        return $statement->fetch(PDO::FETCH_OBJ);
    }
}
