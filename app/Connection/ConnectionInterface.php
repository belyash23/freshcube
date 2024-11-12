<?php

namespace App\Connection;

use Illuminate\Http\Client\Response;

interface ConnectionInterface
{
    public function request(string $action, string $method, array $data): array;
}
