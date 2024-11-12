<?php

namespace App\Query;

use App\Connection\AmoCRMConnection;
use App\Connection\ConnectionInterface;

class DealQuery
{
    private ConnectionInterface $connection;

    public function __construct()
    {
        $this->connection = new AmoCRMConnection();
    }

    public function getDeals(): array
    {
        $deals = $this->connection->request('leads', 'get', [
            'with' => 'contacts',
            'order' => [
                'created_at' => 'desc',
            ],
        ]);

        return $deals['_embedded']['leads'];
    }

    public function linkContact(int $dealId, int $contactId): array
    {
        $url = sprintf('leads/%s/link', $dealId);
        $result = $this->connection->request($url, 'post', [
            [
                'to_entity_id' => $contactId,
                'to_entity_type' => 'contacts',
            ]
        ]);

        return $result['_embedded']['links'];
    }
}
