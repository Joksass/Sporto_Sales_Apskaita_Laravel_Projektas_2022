<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body class="font-sans antialiased">
        <x-app-layout>

                <x-slot name="header">
                
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                        Abonimento redagavimas
                    </h2>
                </x-slot>

                @foreach ($subscriptions as $subscription)
                <form action="{{ route('subscriptions_admin.update',$subscription->id) }}" method="POST">
                @csrf
                @method('PUT')
                    <div class="h5 fw-bold text-center mt-4">{{ $subscription->name}} vartotojo</div>
                    <div class="container text-center">
                        <input type ="hidden" name ="abonnement_id" value ="{{$subscription->abonnement_id}}">
                        <input type ="hidden" name ="club_id" value ="{{$subscription->club_id}}">
                        <input type ="hidden" name ="user_id" value ="{{$subscription->user_id}}">
                        
                            <div>
                                <div class="fw-bold mt-2 d-inline">{{ __('Abonnement type') }}:</div>
                                {{ $subscription->abonnement}} @if($subscription->coach === "-")@else{{ $subscription->coach}} ({{$subscription->coach_specialization}})@endif
                            </div>
                            
                            <div>
                                <div class="fw-bold mt-2 d-inline">{{ __('Sport Club') }}:</div>
                                {{ $subscription->club}}
                            </div>

                            <div>
                                <div class="fw-bold mt-2 d-inline">{{ __('Price') }}:</div>
                                {{ $subscription->price}}€
                            </div>

                            <div class="mt-2">
                                <select class="form-select form-select-sm w-25 shadow-sm" aria-label="Small select" name="paid" style="margin: 0 auto;">
                                @if($subscription->paid === 0)
                                <option value="0">Neapmokėta</option>
                                <option value="1">Apmokėta</option>
                                @else
                                <option value="1">Apmokėta</option>
                                <option value="0">Neapmokėta</option>
                                @endif
                                </select>
                            </div>

                            <div>
                                <div class="form-group">
                                <div class="fw-bold mt-2">{{ __('Expiration') }}:</div>
                                <input type="date" value="{{$subscription->till}}" max="2999-12-31" name="till" class="form-control w-25 shadow-sm" style="margin: 0 auto;">
                                </div>
                            </div>


                        <a href="{{ route('subscriptions_admin.index') }}" class="btn btn-outline-danger mt-2 shadow-sm">Uždaryti</a>
                        <button type="submit" class="btn btn-outline-success mt-2 shadow-sm">Patvirtinti</button>                  
                        </div>
                </form>
                @endforeach

                
                
                                                        
        </x-app-layout> 
        
    </body>
</html>