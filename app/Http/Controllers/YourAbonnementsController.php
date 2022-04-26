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
        $subscriptions = DB::table('subscriptions')
        ->select('users.name', 'abonnement_types.abonnement','paid','from', 'abonnement_types.coach', 'clubs.club')
        ->join('users', 'subscriptions.user_id', '=', 'users.id')
        ->join('abonnement_types','subscriptions.abonnement_id', '=', 'abonnement_types.id')
        ->join('clubs','subscriptions.club_id', '=', 'clubs.id')
        ->paginate(50);

        return view('your_abonnements.index',compact('subscriptions'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
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
