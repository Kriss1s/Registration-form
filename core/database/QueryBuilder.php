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

    public function addNewUser($table, $data)
    {
        $statement = $this->pdo->prepare("INSERT INTO {$table} (first_name, last_name, phone_number, email, country, user_img, conf_topic, conf_description, conf_date) VALUES (?,?,?,?,?,?,?,?,?)");
        $statement->execute([...array_values($data)]);
        return;
    }
    public function checkSingle($table, $column, $singleValue)
    {
        $statement = $this->pdo->prepare("select {$column} from {$table} where {$column}='{$singleValue}'");
        $statement->execute();
        return (bool)$statement->fetchColumn();
    }
}
