@extends('layouts.admin-base')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mt-4">{{ __('reservations.reservation_details') }}</h1>
        <a href="{{ route('admin.reservations.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> {{ __('common.back') }}
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Reservation Details Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-info-circle me-1"></i>
                    {{ __('reservations.reservation_info') }}
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h5 class="text-muted mb-1">{{ __('reservations.reservation_id') }}</h5>
                            <p class="h4">#{{ $reservation->id }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-muted mb-1">{{ __('reservations.status') }}</h5>
                            <span class="badge bg-{{ $reservation->status_color }} fs-6">
                                {{ ucfirst($reservation->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h5 class="text-muted mb-1">{{ __('reservations.date') }}</h5>
                            <p>
                                <i class="fas fa-calendar me-1"></i>
                                {{ $reservation->date ? $reservation->date->format('Y-m-d') : 'N/A' }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-muted mb-1">{{ __('reservations.time') }}</h5>
                            <p>
                                <i class="fas fa-clock me-1"></i>
                                {{ $reservation->date ? $reservation->date->format('H:i') : 'N/A' }}
                            </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h5 class="text-muted mb-1">{{ __('reservations.guests') }}</h5>
                            <p>
                                <i class="fas fa-users me-1"></i>
                                {{ $reservation->guests }} {{ __('reservations.people') }}
                            </p>
                        </div>
                        @if($reservation->price)
                        <div class="col-md-6">
                            <h5 class="text-muted mb-1">{{ __('reservations.price') }}</h5>
                            <p>
                                <i class="fas fa-euro-sign me-1"></i>
                                {{ number_format($reservation->price, 2) }} €
                            </p>
                        </div>
                        @endif
                    </div>

                    @if($reservation->message)
                    <div class="row mb-3">
                        <div class="col-12">
                            <h5 class="text-muted mb-1">{{ __('reservations.message') }}</h5>
                            <p class="mb-0">{{ $reservation->message }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Tour Details Card -->
            @if($reservation->fishingTour)
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-fish me-1"></i>
                    {{ __('tours.tour_details') }}
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h5 class="text-muted mb-1">{{ __('tours.name') }}</h5>
                            <p class="h4">{{ $reservation->fishingTour->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-muted mb-1">{{ __('tours.category') }}</h5>
                            <span class="badge {{ $reservation->fishingTour->category === 'fishing' ? 'bg-primary' : 'bg-success' }}">
                                {{ __('tours.categories.' . $reservation->fishingTour->category) }}
                            </span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <h5 class="text-muted mb-1">{{ __('tours.description') }}</h5>
                            <p>{{ $reservation->fishingTour->description }}</p>
                        </div>
                    </div>

                    @if($reservation->fishingTour->features)
                    <div class="row">
                        <div class="col-12">
                            <h5 class="text-muted mb-2">{{ __('tours.features') }}</h5>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($reservation->fishingTour->features as $feature)
                                <span class="badge bg-light text-dark">
                                    <i class="fas fa-check me-1"></i>
                                    {{ $feature }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>

        <div class="col-lg-4">
            <!-- Customer Details Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-user me-1"></i>
                    {{ __('reservations.customer_info') }}
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h5 class="text-muted mb-1">{{ __('reservations.name') }}</h5>
                        <p class="h4">{{ $reservation->name }}</p>
                    </div>

                    <div class="mb-3">
                        <h5 class="text-muted mb-1">{{ __('reservations.email') }}</h5>
                        <p>
                            <a href="mailto:{{ $reservation->email }}" class="text-decoration-none">
                                <i class="fas fa-envelope me-1"></i>
                                {{ $reservation->email }}
                            </a>
                        </p>
                    </div>

                    <div class="mb-3">
                        <h5 class="text-muted mb-1">{{ __('reservations.phone') }}</h5>
                        <p>
                            <a href="tel:{{ $reservation->phone }}" class="text-decoration-none">
                                <i class="fas fa-phone me-1"></i>
                                {{ $reservation->phone }}
                            </a>
                        </p>
                    </div>

                    <div class="mb-3">
                        <h5 class="text-muted mb-1">{{ __('reservations.created_at') }}</h5>
                        <p>
                            <i class="fas fa-calendar-alt me-1"></i>
                            {{ $reservation->created_at->format('Y-m-d H:i') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Actions Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-cog me-1"></i>
                    {{ __('common.actions') }}
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.reservations.update-status', $reservation) }}" method="POST" class="mb-3">
                        @csrf
                        @method('PATCH')
                        <div class="input-group">
                            <select name="status" class="form-select">
                                <option value="pending" {{ $reservation->status === 'pending' ? 'selected' : '' }}>
                                    {{ __('reservations.status_pending') }}
                                </option>
                                <option value="confirmed" {{ $reservation->status === 'confirmed' ? 'selected' : '' }}>
                                    {{ __('reservations.status_confirmed') }}
                                </option>
                                <option value="cancelled" {{ $reservation->status === 'cancelled' ? 'selected' : '' }}>
                                    {{ __('reservations.status_cancelled') }}
                                </option>
                            </select>
                            <button type="submit" class="btn btn-primary">
                                {{ __('common.update') }}
                            </button>
                        </div>
                    </form>

                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.reservations.edit', $reservation) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-1"></i>
                            {{ __('common.edit') }}
                        </a>
                        
                        <form action="{{ route('admin.reservations.destroy', $reservation) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100" onclick="return confirm('{{ __('reservations.confirm_delete') }}')">
                                <i class="fas fa-trash me-1"></i>
                                {{ __('common.delete') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.badge {
    font-size: 0.9rem;
    padding: 0.5rem 0.75rem;
}
.card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}
</style>
@endsection
