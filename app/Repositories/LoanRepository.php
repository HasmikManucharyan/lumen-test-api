<?php

namespace App\Repositories;

use App\Models\Loan;
use http\Env\Request;

class LoanRepository
{
    public function all($request = null)
    {
        $query = Loan::query();

        if ($request && $request->has('created_date')) {
            $query->whereDate('created_date', $request->input('created_date'));
        }
        if ($request && $request->has('sum')) {
            $query->orWhere('sum', $request->input('sum'));
        }

        return $query->get();
    }


    public function create(array $data)
    {
        return Loan::create($data);
    }

    public function update(Loan $loan, array $data)
    {
        $loan->update($data);
        return $loan;
    }
    public function find($id)
    {
        return Loan::find($id);
    }
    public function delete($id)
    {
        $loan = $this->find($id);

        if (!$loan) {
            return false;
        }

        $loan[0]->delete();
        return true;
    }


}
