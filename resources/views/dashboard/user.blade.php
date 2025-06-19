@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h2 class="h4 mb-0">{{ __('My Reservations') }}</h2>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($reservations->isEmpty())
                        <div class="text-center py-4">
                            <p class="text-muted mb-0">{{ __('You have no reservations yet.') }}</p>
                            <a href="{{ route('reservation') }}" class="btn btn-primary mt-3">
                                {{ __('Make a Reservation') }}
                            </a>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ __('Tour Type') }}</th>
                                        <th>{{ __('Date') }}</th>
                                        <th>{{ __('Guests') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Message') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reservations as $reservation)
                                        <tr>
                                            <td>{{ $reservation->tour_type }}</td>
                                            <td>{{ $reservation->date->format('Y-m-d') }}</td>
                                            <td>{{ $reservation->guests }}</td>
                                            <td>
                                                <span class="badge bg-{{ $reservation->status_color }}">
                                                    {{ __($reservation->status) }}
                                                </span>
                                            </td>
                                            <td>{{ $reservation->message ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            {{ $reservations->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
