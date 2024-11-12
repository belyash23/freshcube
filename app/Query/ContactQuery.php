<?php

namespace App\Query;

use App\Connection\AmoCRMConnection;
use App\Connection\ConnectionInterface;

class ContactQuery
{
    private ConnectionInterface $connection;

    public function __construct()
    {
        $this->connection = new AmoCRMConnection();
    }

    public function createContact(string $name, string $phone): array
    {
        $result = $this->connection->request('contacts', 'post', [
            [
                'name' => $name,
                'custom_fields_values' => [
                    [
                        'field_code' => 'PHONE',
                        'values' => [
                            [
                                'enum_code' => 'WORK',
                                'value' => $phone,
                            ]
                        ]
                    ],
                ]
            ]
        ]);

        return $result['_embedded']['contacts'];
    }
}
