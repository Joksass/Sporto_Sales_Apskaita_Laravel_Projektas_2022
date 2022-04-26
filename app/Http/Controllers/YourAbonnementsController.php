<?php

namespace App\Http\Controllers;

use App\Models\YourAbonnements;
use App\Http\Requests\StoreYourAbonnementsRequest;
use App\Http\Requests\UpdateYourAbonnementsRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class YourAbonnementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abonnements = YourAbonnements::latest();
        return view ('your_abonnements.index');
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
     * @param  \App\Http\Requests\StoreYourAbonnementsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreYourAbonnementsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\YourAbonnements  $yourAbonnements
     * @return \Illuminate\Http\Response
     */
    public function show(YourAbonnements $yourAbonnements)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\YourAbonnements  $yourAbonnements
     * @return \Illuminate\Http\Response
     */
    public function edit(YourAbonnements $yourAbonnements)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateYourAbonnementsRequest  $request
     * @param  \App\Models\YourAbonnements  $yourAbonnements
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateYourAbonnementsRequest $request, YourAbonnements $yourAbonnements)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\YourAbonnements  $yourAbonnements
     * @return \Illuminate\Http\Response
     */
    public function destroy(YourAbonnements $yourAbonnements)
    {
        //
    }
}
