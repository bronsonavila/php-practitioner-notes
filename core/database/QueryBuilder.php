<?php

class QueryBuilder
{
    protected $pdo;

    // "Type hinting" defines type of values that can be passed as an argument:
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function selectAll($table)
    {
        // Prepare SQL query:
        $query = $this->pdo->prepare("select * from {$table}");

        // Execute SQL query:
        $query->execute();

        // Fetch all results and store results as objects:
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function insert($table, $parameters)
    {
        // array_keys() returns an array containing the keys of the input array,
        // and implode() concatenates each element of the new array into a
        // string in which each element is separated by ", ":
        $columns = implode(', ', array_keys($parameters));

        // Trick to preface each column name with a colon, which acts as a
        // placeholder for the value corresponding to the specified key:
        $values = ':' . implode(', :', array_keys($parameters));

        // sprintf() allows you to declare a string with placeholders to which
        // you can attach variables (in this case, strings identified as %s):
        $sqlString = sprintf(
            'insert into %s (%s) values (%s)', $table, $columns, $values
        );

        try {
            $query = $this->pdo->prepare($sqlString);

            // execute() accepts an array that is used in binding values to the
            // placeholders (parameters) specified in $values:
            $query->execute($parameters);
        } catch (Exception $e) {
            die('Something went wrong.');
        }
    }
}
