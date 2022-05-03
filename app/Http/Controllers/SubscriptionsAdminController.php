<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriptions;
use Illuminate\Support\Facades\DB;

class SubscriptionsAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscriptions = Subscriptions::select('subscriptions.id','subscriptions.created_at','paid','till', 'subscriptions.user_id','subscriptions.abonnement_id', 'subscriptions.club_id',
            'abonnement_types.abonnement','abonnement_types.price','abonnement_types.lenght', 'abonnement_types.coach','abonnement_types.coach_specialization',  
            'clubs.club',
            'users.name')
        ->join('users', 'subscriptions.user_id', '=', 'users.id')
        ->join('abonnement_types','subscriptions.abonnement_id', '=', 'abonnement_types.id')
        ->join('clubs','subscriptions.club_id', '=', 'clubs.id')
        ->orderBy('till', 'desc')
        ->orderBy('created_at', 'desc')
        ->get();

        return view('subscriptions_admin.index',compact('subscriptions'))
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subscriptions = Subscriptions::find($id)
        ->select('subscriptions.id', 'subscriptions.user_id','subscriptions.abonnement_id','subscriptions.club_id', 'subscriptions.paid', 'subscriptions.till', 
        'users.name',
        'clubs.club',
        'abonnement_types.price', 'abonnement_types.coach', 'abonnement_types.coach_specialization', 'abonnement_types.abonnement')
        ->join('users', 'subscriptions.user_id', '=', 'users.id')
        ->join('abonnement_types','subscriptions.abonnement_id', '=', 'abonnement_types.id')
        ->join('clubs','subscriptions.club_id', '=', 'clubs.id')
        ->orderBy('till', 'desc')
        ->orderBy('subscriptions.created_at', 'desc')
        ->where('subscriptions.id', '=', $id)
        ->get();
        return view ('subscriptions_admin.edit', compact('subscriptions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'abonnement_id'=> 'required',
            'club_id'=> 'required',
            'paid' => 'required',
            'till' => 'required'
        ]);

        $subscriptions = new Subscriptions;
        $subscriptions = Subscriptions::find($id);
        $subscriptions->id = $id;
        $subscriptions->user_id = $request->user_id;
        $subscriptions->abonnement_id = $request->abonnement_id;
        $subscriptions->club_id = $request->club_id;
        $subscriptions->paid = $request->paid;
        $subscriptions->till = $request->till;
        $subscriptions->update();
        

         return redirect()->route('subscriptions_admin.index')
                        ->with('success','Sėkmingai redaguotas vartotojo abonimentas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subscriptions = DB::table('subscriptions')->where('id', '=', $id)->delete();
        return redirect()->route('subscriptions_admin.index')
                        ->with('success','Abonimentas sėkmingai ištrintas');
    }
}
