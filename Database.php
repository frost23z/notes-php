<?php

class Database
{
    public PDO $connection;
    public PDOStatement $statement;

    public function __construct($config)
    {
        ['dsn' => $dsn, 'user' => $user, 'password' => $password] = $config;

        $this->connection = new PDO($dsn, $user, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query($query, $params = [])
    {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);

        return $this;
    }

    public function fetchOrFail(): array
    {
        $result = $this->fetch();

        if (!$result) {
            abort(Response::HTTP_NOT_FOUND);
        }

        return $result;
    }

    public function fetch()
    {
        return $this->statement->fetch();
    }

    public function fetchAll()
    {
        return $this->statement->fetchAll();
    }
}