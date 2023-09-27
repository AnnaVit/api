<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proposal;

class GetRequests extends Controller
{
    private Proposal $proposal;

    /**
     * @param Proposal $proposal
     */
    public function __construct(Proposal $proposal)
    {
        $this->proposal = $proposal;
    }

    /**
     * @param Request $request
     * @return void
     */
    public function getRequests(Request $request)
    {
        $status = null;
        $date = null;

        if ($request->filled('status')) {
            $status = $request->get('status');
        }

        if ($request->filled('date')) {
            $date = $request->get('date');
        }

        return $this->proposal->findAll($status, $date);
    }
}
