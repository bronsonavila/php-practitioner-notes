<?php

class Connection
{
    // "static" makes a method available globally without requiring an instance.
    // Allows calling method directly like so: Connection::make();
    public static function make($config)
    {
        // Best practice is to wrap a PDO in a try/catch statement for error handling:
        try {
            // PDO requires (1) DSN (Data Source Name), (2) username, and (3) password.
            // Fourth argument may include "options":
            return new PDO(
                "{$config['connection']};dbname={$config['name']}",
                $config['username'],
                $config['password'],
                $config['options']
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}

