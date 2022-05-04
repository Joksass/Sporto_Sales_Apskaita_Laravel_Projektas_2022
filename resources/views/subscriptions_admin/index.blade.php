<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <style>
            form.form-inline {
            display: inline-block
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <x-app-layout>
                <x-slot name="header">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Admin management panel') }}
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


                <div class="container mt-4">
                    <div class="row justify-content-between">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ __('User order') }}</th>
                                    <th scope="col">{{ __('Abonnement type') }}</th>
                                    <th scope="col">{{ __('Sport Club') }}</th>
                                    <th scope="col">{{ __('Payment') }}</th>
                                    <th scope="col">{{ __('Expiration') }}</th>
                                    <th scope="col">{{ __('Order date') }}</th>
                                    <th scope="col">{{ __('Actions') }}</th>                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subscriptions as $subscription)
                                <tr>
                                    <th scope="row">{{ ++$i }}</th>
                                    <td>{{ $subscription->name}}</td>
                                    <td>{{ $subscription->abonnement}} @if($subscription->coach === "-")@else{{ $subscription->coach}} ({{$subscription->coach_specialization}})@endif</td>
                                    <td>{{ $subscription->club}}</td>
                                    <td>@if($subscription->paid === 0)<div class="text-danger">Neapmokėta</div>@else<div class="text-success">Apmokėta</div>@endif</td>
                                    <td>
                                        @if($subscription->till >= date("Y-m-d") && $subscription->paid == 1)<div class = "bg-success text-center">{{ $subscription->till}}</div>
                                        @elseif($subscription->till < date("Y-m-d") && $subscription->paid === 0)<div class = "bg-danger text-center">Negalioja</div>
                                        @else<div class = "bg-warning text-center">{{ $subscription->till}}</div>@endif
                                    </td>
                                    <td>{{ $subscription->created_at}}</td>
                                    <td>
                                        <!--<form action="{{route('subscriptions_admin.update', $subscription->id)}}" method="POST" class="form-inline">-->
                                        <!--EDIT-->
                                        <button type="button" class="btn btn-sm btn-outline-info shadow-sm" data-bs-toggle="modal" data-bs-target="#editModal{{$subscription->id}}" data-toggle="buttons">
                                            Redaguoti
                                        </button>
                                                <!-- The Edit Modal -->
                                                <div class="modal" id="editModal{{$subscription->id}}">
                                                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <form action="{{ route('subscriptions_admin.update',$subscription->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                            <h4 class="modal-title fw-bold fs-2">{{$subscription->name}} vartotojo abonimento redagavimas</h4>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <div class="modal-body">
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
                                                                <select class="form-select form-select-sm w-25 shadow-sm" aria-label="Small select" name="paid">
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
                                                                <input type="date" value="{{$subscription->till}}" max="2999-12-31" name="till" class="form-control w-25 shadow-sm">
                                                                </div>
                                                                </div>

                                                                <div>
                                                                <div class="fw-bold mt-2 d-inline">{{ __('Order date') }}:</div>
                                                                {{ $subscription->created_at}}
                                                                </div>
                                                            </div>

                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-outline-success">Patvirtinti ir redaguoti</button>
                                                                <button type="button" class="btn btn-outline-danger"  data-bs-dismiss="modal">Uždaryti</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                </div>
                                        <!--EDIT END-->
                                        
                                        <!--DELETE-->
                                        <button type="button" class="btn btn-sm btn-outline-danger shadow-sm" data-bs-toggle="modal" data-bs-target="#delModal{{$subscription->id}}" data-toggle="buttons">
                                                Trinti
                                        </button>
                                            <!-- The Delete Modal -->
                                            <div class="modal" id="delModal{{$subscription->id}}">
                                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <form action="{{route('subscriptions_admin.destroy', $subscription->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')  
                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <div class="text-center h5">Ar tikrai norite ištrinti?</div>
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-sm btn-outline-danger shadow-sm">
                                                                Patvirtinti
                                                            </button>
                                                            <button type="button" class="btn btn-sm btn-outline-success" data-bs-dismiss="modal">Atšaukti</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            </div>
                                        </form>
                                        <!--DELETE END-->
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>


                
        
        </x-app-layout> 
        
    </body>
</html>

