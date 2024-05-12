<?php
namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class LoanValidationService
{
    public function validateLoanRequest(Request $request)
    {
        $rules = [
            'loan_title' => 'sometimes|required|string|unique:loans,loan_title',
            'sum' => 'sometimes|required|numeric',
            'created_date' => 'sometimes|date',
        ];

        if ($request->isMethod('PUT')) {
            $rules['loan_title'] .= '|unique:loans,loan_title,' . $request->route('id');
            $rules['sum'] .= '|unique:loans,sum,' . $request->route('id');
        }

        $validator = Validator::make($request->all(), $rules);

        return $validator->validate();
    }
}
