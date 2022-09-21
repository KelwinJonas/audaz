<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOperatorRequest;
use App\Models\Operator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class OperatorController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOperatorRequest $request)
    {
        $validated = $request->validated();
        $operator = Operator::where('code', 'ilike', $validated['code'])->first();

        if ($operator) {
            $type = 'error';
            $message = "Operadora já existe";
        } else {
            $operator = new Operator($validated);
            $operator->save();
            $type = 'success';
            $message = "Operadora salva com sucesso!";
        }

        return Redirect::back()->with($type, $message);
    }
}
