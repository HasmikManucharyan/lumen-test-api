<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\LoanRepository;
use App\Services\LoanValidationService;
use Illuminate\Http\Response;

class LoanController extends Controller
{
    protected $loanRepository;
    protected $validationService;

    public function __construct(LoanRepository $loanRepository, LoanValidationService $validationService)
    {
        $this->loanRepository = $loanRepository;
        $this->validationService = $validationService;
    }
    public function index(Request $request = null)
    {
        $loans = $this->loanRepository->all($request);
        return response()->json($loans, Response::HTTP_OK);
    }
    public function store(Request $request)
    {
        $validatedData = $this->validationService->validateLoanRequest($request);
        $loan = $this->loanRepository->create($validatedData);

        return response()->json($loan, 201);
    }
    public function update(Request $request, $id)
    {
        $loan = $this->loanRepository->find($id);

        if (!$loan) {
            return response()->json(['error' => 'Loan not found'], 404);
        }
        $validatedData = $this->validationService->validateLoanRequest($request);

        $updatedLoan = $this->loanRepository->update($loan, $validatedData);

        return response()->json($updatedLoan, 200);
    }
    public function show($id)
    {
        $loan = $this->loanRepository->find($id);

        if (!$loan) {
            return response()->json(['error' => 'Loan not found'], 404);
        }

        return response()->json($loan, 200);
    }
    public function destroy($id)
    {
        $loan = $this->loanRepository->find($id);

        if (!$loan) {
            return response()->json(['error' => 'Loan not found'], Response::HTTP_NOT_FOUND);
        }

        $this->loanRepository->delete($loan);

        return response()->json(['message' => 'Loan deleted successfully'], Response::HTTP_OK);
    }

}
