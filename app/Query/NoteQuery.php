<?php

namespace App\Query;

use App\Connection\AmoCRMConnection;
use App\Connection\ConnectionInterface;

class NoteQuery
{
    private ConnectionInterface $connection;

    public function __construct()
    {
        $this->connection = new AmoCRMConnection();
    }

    public function addNote(string $entityType, string $entityId, string $text): array
    {
        $url = sprintf('%s/%s/notes', $entityType, $entityId);
        $result = $this->connection->request($url, 'post', [
            [
                'entity_id' => $entityId,
                'note_type' => 'common',
                'params' => [
                    'text' => $text,
                ],
            ],
        ]);

        return $result;
    }
}
