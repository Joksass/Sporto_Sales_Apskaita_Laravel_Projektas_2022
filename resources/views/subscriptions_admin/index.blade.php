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
                                        <form action="{{route('subscriptions_admin.destroy', $subscription)}}" method="POST">

                                            <a class="btn btn-sm btn-outline-info shadow-sm" href = "{{ route('subscriptions_admin.edit',$subscription->id) }}">
                                                Redaguoti
                                            </a>

                                            @csrf
                                            @method('DELETE')

                                            <!--DELETE-->
                                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delModal{{$subscription->id}}" data-toggle="buttons">
                                                 Trinti
                                            </button>
                                                    
                                            <!-- The Delete Modal -->
                                            <div class="modal" id="delModal{{$subscription->id}}">
                                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                                <div class="modal-content">

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

                                                </div>
                                            </div>
                                            </div>
                                        </form>
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

