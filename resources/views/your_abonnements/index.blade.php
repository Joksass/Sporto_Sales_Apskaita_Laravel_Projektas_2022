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
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Your abonnements') }}
                    </h2>
                </x-slot>

                <div class="container">
                    <div class="row">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success mt-4">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-end mt-2">
                            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#myModal" data-toggle="buttons">
                                Užsisakyti abonimentą
                            </button>
                        </div>
                    </div>
                </div>

                <!-- The Modal -->
                <div class="modal" id="myModal">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <form action="{{route('your_abonnements.store')}}" method="POST">
                        @csrf
                        <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title fw-bold fs-2">Abonimento užsakymas</h4>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="h4 fw-bold mt-2">Abonimentų rūšys:</div>
                            @foreach ($abonnements as $abonnement)
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="radio" name="abonnement" id="formRadioDefault" value="{{$abonnement->id}}">
                                <label class="form-check-label" for="formRadioDefault">
                                    <div class="h5 fw-bold">{{$abonnement->abonnement}}@if($abonnement->coach === "-")@else{{ $abonnement->coach}}({{$abonnement->coach_specialization}})@endif.</div> 
                                    <div class="fw-bold">Kaina:</div> {{$abonnement->price}}€
                                </label>
                            </div>
                            @endforeach

                            <div class="h4 fw-bold mt-4">Sporto klubas:</div>
                            @foreach ($clubs as $club)
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="radio" name="club" id="formRadioDefault" value="{{$club->id}}">
                                <label class="form-check-label" for="formRadioDefault">
                                    <div class="h5 fw-bold">{{$club->club}}</div>
                                </label>
                            </div>
                            @endforeach

                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger"  data-bs-dismiss="modal">Uždaryti</button>
                            <button type="submit" class="btn btn-outline-success">Patvirtinti ir užsisakyti</button>
                        </div>

                        </div>
                    </form>
                </div>
                </div>

                
                
                <div class="container">
                    <div class="row justify-content-between">
                        @foreach ($subscriptions as $subscription)
                        @if ($subscription->till >= date("Y-m-d", time() - 1728000) || $subscription->paid === 0)
                        <div class="col-lg-4 col-md-12 mt-2">
                            <div class="card text-center border border-dark shadow-0 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold fs-5">{{ $subscription->abonnement}}</h5>
                                    <p class="card-text">
                                        Sporto klubo adresas: {{ $subscription->club}}<br>
                                        @if ($subscription->coach === "-")
                                        @else 
                                            Treneris: {{ $subscription->coach}} ({{$subscription->coach_specialization}})<br>
                                        @endif
                                        @if($subscription->paid === 0)
                                            Reikia mokėti: {{ $subscription->price}}€
                                        @else
                                            Sumokėta: {{ $subscription->price}}€
                                        @endif
                                    </p>
                                </div>
                                @if($subscription->paid === 0)
                                <div class="card-footer bg-danger">
                                    Nesumokėta (užsakytą: {{ $subscription->created_at}})
                                </div>
                                @elseif($subscription->till >= date("Y-m-d"))
                                <div class="card-footer bg-success">
                                    Galioja iki {{$subscription->till}}
                                </div>
                                @else
                                <div class="card-footer bg-warning">
                                    Pasibaigė nuo {{$subscription->till}}
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>


                <div class="container mt-2">
                    <div class="row">
                        {!! $subscriptions->links() !!}
                    </div>
                </div>
        
        </x-app-layout> 
        
    </body>
</html>

