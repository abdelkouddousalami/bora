@extends('layouts.admin-base')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mt-4">{{ __('reservations.manage_reservations') }}</h1>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-calendar me-1"></i>
            {{ __('reservations.reservations_list') }}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>{{ __('reservations.id') }}</th>
                            <th>{{ __('reservations.user') }}</th>
                            <th>{{ __('reservations.phone') }}</th>
                            <th>{{ __('reservations.tour') }}</th>
                            <th>{{ __('reservations.date') }}</th>
                            <th>{{ __('reservations.status') }}</th>
                            <th>{{ __('reservations.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reservations as $reservation)
                        <tr>
                            <td>#{{ $reservation->id }}</td>
                            <td>
                                {{ $reservation->user->name }}
                                <br>
                                <small class="text-muted">{{ $reservation->user->email }}</small>
                            </td>
                            <td>
                                <a href="tel:{{ $reservation->phone }}" class="text-decoration-none">
                                    <i class="fas fa-phone-alt me-1"></i>
                                    {{ $reservation->phone }}
                                </a>
                            </td>
                            <td>{{ $reservation->fishingTour->name ?? 'N/A' }}</td>
                            <td>{{ $reservation->date ? $reservation->date->format('Y-m-d H:i') : 'N/A' }}</td>
                            <td>
                                <span class="badge bg-{{ $reservation->status_color }}">
                                    {{ $reservation->status }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.reservations.show', $reservation) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.reservations.edit', $reservation) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.reservations.destroy', $reservation) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ __('reservations.confirm_delete') }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>

                                <div class="mt-2">
                                    <form action="{{ route('admin.reservations.update-status', $reservation) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <div class="input-group input-group-sm">
                                            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                                <option value="pending" {{ $reservation->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="confirmed" {{ $reservation->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                                <option value="cancelled" {{ $reservation->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <div class="empty-state">
                                    <i class="fas fa-calendar fa-2x mb-3"></i>
                                    <p>{{ __('reservations.no_reservations') }}</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end">
                {{ $reservations->links() }}
            </div>
        </div>
    </div>
</div>

<style>
.empty-state {
    text-align: center;
    padding: 2rem;
    color: #6c757d;
}
</style>
@endsection
