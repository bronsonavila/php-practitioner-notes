<?php

class Connection
{
    // "static" makes a method available globally without requiring an instance.
    // Allows calling method directly like so: Connection::make();
    public static function make($db)
    {
        // Best practice is to wrap a PDO in a try/catch statement for error handling:
        try {
            // PDO requires (1) DSN (Data Source Name), (2) username, and (3) password.
            // Fourth argument may include "options":
            return new PDO(
                "{$db['connection']};dbname={$db['name']}",
                $db['username'],
                $db['password'],
                $db['options']
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}

