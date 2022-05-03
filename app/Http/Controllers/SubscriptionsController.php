<?php

namespace App\Http\Controllers;

use App\Models\Subscriptions;
use App\Http\Requests\StoreSubscriptionsRequest;
use App\Http\Requests\UpdateSubscriptionsRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clubs = DB::table('clubs')->get();
        $abonnements = DB::table('abonnement_types')->get();
        $subscriptions = DB::table('subscriptions')
        ->select('users.name', 'abonnement_types.abonnement','abonnement_types.price','subscriptions.created_at','paid','till', 'abonnement_types.coach','abonnement_types.coach_specialization',  'clubs.club')
        ->join('users', 'subscriptions.user_id', '=', 'users.id')
        ->join('abonnement_types','subscriptions.abonnement_id', '=', 'abonnement_types.id')
        ->join('clubs','subscriptions.club_id', '=', 'clubs.id')
        ->where('subscriptions.user_id', '=', Auth::user()->id)
        ->orderBy('till', 'desc')
        ->orderBy('created_at', 'desc')
        ->paginate(12);

        return view('your_abonnements.index',compact('subscriptions', 'abonnements', 'clubs'))
            ->with('i', (request()->input('page', 1) - 1) * 12);
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
     * @param  \App\Http\Requests\StoreSubscriptionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'abonnement' => 'required',
            'club' => 'required',
        ]);
        $subscriptions = new Subscriptions;
        $subscriptions->abonnement_id = $request->abonnement;
        $subscriptions->club_id = $request->club;
        $subscriptions->user_id = Auth::user()->id;
        $subscriptions->save();

        return redirect()->route('your_abonnements.index')
                        ->with('success','Sėkmingai užsakytas abonimentas, dabar atvykite pas mus ir apmokėkite abonimentą.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subscriptions  $subscriptions
     * @return \Illuminate\Http\Response
     */
    public function show(Subscriptions $subscriptions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subscriptions  $subscriptions
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscriptions $subscriptions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubscriptionsRequest  $request
     * @param  \App\Models\Subscriptions  $subscriptions
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubscriptionsRequest $request, Subscriptions $subscriptions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subscriptions  $subscriptions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscriptions $subscriptions)
    {
        //
    }
}
