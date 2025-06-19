@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0">{{ __('Users Management') }}</h2>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left"></i> {{ __('Back to Dashboard') }}
            </a>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($users->isEmpty())
                <div class="text-center py-4">
                    <p class="text-muted mb-0">{{ __('No users found.') }}</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Joined') }}</th>
                                <th>{{ __('Reservations') }}</th>
                                <th>{{ __('Last Reservation') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <span class="badge bg-primary">
                                            {{ $user->reservations_count }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($user->reservations()->latest()->first())
                                            {{ $user->reservations()->latest()->first()->date->format('Y-m-d') }}
                                            <button type="button" class="btn btn-link btn-sm" data-bs-toggle="modal" data-bs-target="#userReservations{{ $user->id }}">
                                                <i class="fas fa-eye"></i> {{ __('View Details') }}
                                            </button>
                                        @else
                                            <span class="text-muted">{{ __('No reservations') }}</span>
                                        @endif
                                    </td>
                                </tr>

                                <!-- Reservations Modal -->
                                <div class="modal fade" id="userReservations{{ $user->id }}" tabindex="-1" aria-labelledby="userReservationsLabel{{ $user->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="userReservationsLabel{{ $user->id }}">
                                                    {{ __('Reservations for') }} {{ $user->name }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                @if($user->reservations->isEmpty())
                                                    <p class="text-center text-muted">{{ __('No reservations found') }}</p>
                                                @else
                                                    <div class="table-responsive">
                                                        <table class="table">
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
                                                                @foreach($user->reservations()->latest()->get() as $reservation)
                                                                    <tr>
                                                                        <td>{{ $reservation->tour_type }}</td>
                                                                        <td>{{ $reservation->date->format('M d, Y') }}</td>
                                                                        <td>
                                                                            <span class="badge bg-info">
                                                                                {{ $reservation->guests }} {{ __('Guest(s)') }}
                                                                            </span>
                                                                        </td>
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
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
    .modal-lg {
        max-width: 800px;
    }
    .btn-link {
        text-decoration: none;
        padding: 0;
        margin-left: 0.5rem;
    }
    .btn-link:hover {
        text-decoration: underline;
    }
</style>
@endpush
@endsection
