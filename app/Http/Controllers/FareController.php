<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFareRequest;
use App\Models\Fare;
use App\Models\Operator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fares = Fare::orderBy('value')->get();
        $operators = Operator::orderBy('code')->get();

        return view('welcome', compact('fares', 'operators'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreFareRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFareRequest $request)
    {
        $validated = $request->validated();
        $operator = Operator::where('code', 'ilike', $validated['operator'])->first();
        if ($operator) {
            $fareExists = $operator->fares()
            ->whereMonth('created_at', '<=', Carbon::now()->month)
            ->whereMonth('created_at', '>', Carbon::now()->subMonths(6)->month)
            ->where('status', Fare::STATUS_ENUM['active'])
            ->where('value', $validated['value'])->first();
            if ($fareExists) {
                $type = 'error';
                $message = "Já existe uma tarifa ativa com este valor";
            } else {
                $validated['operator_id'] = $operator->id;
                $fare = new Fare($validated);
                $fare->save();
                $type = 'success';
                $message = "Tarifa salva com sucesso!";
            }
        } else {
            $type = 'error';
            $message = "Operadora não encontrada";
        }

        return Redirect::back()->with($type, $message);
    }

    /**
     * Change the fare status
     */
    public function changeStatus($id)
    {
        $fare = Fare::find($id);

        if ($fare->active()) {
            $fare->status = Fare::STATUS_ENUM['inactive'];
        } else {
            $fareExists = Fare::where([['operator_id', $fare->operator->id],
            ['status', Fare::STATUS_ENUM['active']],
            ['value', $fare->value]])->first();
            if (! $fareExists) {
                $fare->status = Fare::STATUS_ENUM['active'];
            }
        }

        $fare->update();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fare  $fare
     * @return \Illuminate\Http\Response
     */
    public function show(Fare $fare)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fare  $fare
     * @return \Illuminate\Http\Response
     */
    public function edit(Fare $fare)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fare  $fare
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fare $fare)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fare  $fare
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fare $fare)
    {
        //
    }
}
