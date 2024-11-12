<?php

namespace App\Services;

use App\Models\ActionsHistory;
use App\Query\ContactQuery;
use App\Query\DealQuery;
use App\Query\NoteQuery;
use Exception;

class DealsService
{
    public function linkNewContact(int $dealId, string $contactName, string $contactPhone, string $comment): bool
    {
        try {
            $contactQuery = new ContactQuery();
            $contactData = $contactQuery->createContact($contactName, $contactPhone);

            $contactId = $contactData[0]['id'];

            $noteQuery = new NoteQuery();
            $noteQuery->addNote('contacts', (int) $contactId, $comment);

            $dealQuery = new DealQuery();
            $dealQuery->linkContact($dealId, $contactId);

            $this->saveLog(true);

            return true;
        } catch (Exception) {
            $this->saveLog(false);
            return false;
        }
    }

    private function saveLog(bool $isSuccessful): void
    {
        ActionsHistory::create([
            'action' => ActionsHistory::ACTION_LINK,
            'success' => $isSuccessful
       ]);
    }
}
