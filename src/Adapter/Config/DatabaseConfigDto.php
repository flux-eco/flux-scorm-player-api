<?php

namespace FluxScormPlayerApi\Adapter\Config;

class DatabaseConfigDto
{

    private readonly string $database;
    private readonly string $host;
    private readonly string $password;
    private readonly int $port;
    private readonly string $user;


    public static function new(string $password, ?string $host = null, ?int $port = null, ?string $user = null, ?string $database = null) : static
    {
        $dto = new static();

        $dto->password = $password;
        $dto->host = $host ?? "scorm-player-db";
        $dto->port = $port ?? 27017;
        $dto->user = $user ?? "scorm-player";
        $dto->database = $database ?? "scorm-player";

        return $dto;
    }


    public function getDatabase() : string
    {
        return $this->database;
    }


    public function getHost() : string
    {
        return $this->host;
    }


    public function getPassword() : string
    {
        return $this->password;
    }


    public function getPort() : int
    {
        return $this->port;
    }


    public function getUser() : string
    {
        return $this->user;
    }
}
