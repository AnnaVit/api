<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proposal;
use App\Http\Validate\MakeProposalValidate;

class PutResponseToRequest extends Controller
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

    /**
     * @param Request $request
     * @param $id
     * @return void
     */
    public function putResponseToRequest(Request $request, $id)
    {
        $data = $this->proposalValidate->proposalCommentValidate($request);

        if ($this->proposal->putRequest($data, $id)) {
            $proposal = $this->proposal->findById($id);
            $this->sendEmail($proposal);
        }
    }

    /**
     * @param $proposal
     * @return void
     */
    public function sendEmail($proposal)
    {
        //Типа отправили email)
        $filename = 'emails.txt';
        $email = "$proposal->email\n . $proposal->name\n . $proposal->comment\n";
        file_put_contents($filename, $email, FILE_APPEND | LOCK_EX);
    }
}
