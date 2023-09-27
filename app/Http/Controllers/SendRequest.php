<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proposal;
use App\Http\Validate\MakeProposalValidate;

class SendRequest extends Controller
{
    private Proposal $proposal;
    private MakeProposalValidate $proposalValidate;

    /**
     * @param Proposal $proposal
     * @param MakeProposalValidate $proposalValidate
     */
    public function __construct(Proposal $proposal, MakeProposalValidate $proposalValidate)
    {
        $this->proposal = $proposal;
        $this->proposalValidate = $proposalValidate;
    }

    public function sendRequest(Request $request)
    {
        $data = $this->proposalValidate->proposalValidate($request);
        $this->proposal->createProposal($data);
    }
}
