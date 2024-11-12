<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinkContactRequest;
use App\Query\ContactQuery;
use App\Query\DealQuery;
use App\Query\NoteQuery;
use App\Services\DealsService;
use Illuminate\Http\Request;

class DealsController extends Controller
{
    private DealQuery $dealQuery;
    private DealsService $dealsService;

    public function __construct()
    {
        $this->dealQuery = new DealQuery();
        $this->dealsService = new DealsService();
    }

    public function list(Request $request)
    {
        $deals = $this->dealQuery->getDeals();

        $result = [];

        foreach ($deals as $deal) {
            $result [] = [
                'id' => $deal['id'],
                'name' => $deal['name'],
                'created_at' => $deal['created_at'],
                'has_contact' => !empty($deal['_embedded']['contacts'])
            ];
        }

        return response(
            [
                'data' => $result,
            ],
        );
    }

    public function linkContact(LinkContactRequest $request)
    {
        $result = $this->dealsService->linkNewContact(
            $request->get('dealId'),
            $request->get('name'),
            $request->get('phone'),
            $request->get('comment'),
        );

        if ($result) {
            return response([]);
        } else {
            return response(
                [
                    'error' => 'Unexpected error'
                ],
                400
            );
        }
    }
}
