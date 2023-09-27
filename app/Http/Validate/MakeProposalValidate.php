<?php

namespace App\Http\Validate;

use Illuminate\Routing\Controller as BaseController;

class MakeProposalValidate extends BaseController
{
    /**
     * Валидация входящих заявок
     * @param $data
     * @return mixed
     */

    public function proposalValidate($data)
    {
        return $data->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);
    }

    public function proposalCommentValidate($data)
    {
        return $data->validate([
              'comment' => 'required',
        ]);
    }
}
