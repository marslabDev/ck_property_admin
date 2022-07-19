<?php

namespace App\Http\Requests;

use App\Models\SupplierProposal;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSupplierProposalRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('supplier_proposal_edit');
    }

    public function rules()
    {
        return [
            'representative_name' => [
                'string',
                'required',
            ],
            'contact_no' => [
                'string',
                'required',
            ],
            'documents' => [
                'array',
                'required',
            ],
            'documents.*' => [
                'required',
            ],
            'open_project_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
