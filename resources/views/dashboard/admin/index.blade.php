@extends('layouts.admin-base')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">{{ __('dashboard.admin_dashboard') }}</h1>
    
    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="small">{{ __('dashboard.total_users') }}</div>
                            <div class="fs-4">{{ $totalUsers }}</div>
                        </div>
                        <i class="fas fa-users fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="small">{{ __('dashboard.monthly_revenue') }}</div>
                            <div class="fs-4">€{{ number_format($monthlyRevenue, 2) }}</div>
                        </div>
                        <i class="fas fa-euro-sign fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="small">{{ __('dashboard.total_reservations') }}</div>
                            <div class="fs-4">{{ $totalReservations }}</div>
                        </div>
                        <i class="fas fa-calendar-check fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="small">{{ __('dashboard.total_tours') }}</div>
                            <div class="fs-4">{{ $totalTours }}</div>
                        </div>
                        <i class="fas fa-fish fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>    <!-- Tours Management Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <div>
                        <i class="fas fa-fish me-2"></i>
                        <span class="fw-bold">Tours Management</span>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.tours.index') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-list me-1"></i> View All Tours
                        </a>
                        <a href="{{ route('admin.tours.create') }}" class="btn btn-success btn-sm">
                            <i class="fas fa-plus me-1"></i> Add New Tour
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Quick Stats -->
                    <div class="row g-4 mb-4">
                        <div class="col-md-3">
                            <div class="p-3 bg-light rounded">
                                <h6 class="mb-2">Total Tours</h6>
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="mb-0">{{ $totalTours }}</h3>
                                    <i class="fas fa-fish fa-2x text-primary opacity-50"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-3 bg-light rounded">
                                <h6 class="mb-2">Fishing Tours</h6>
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="mb-0">{{ $tourStats['fishing'] }}</h3>
                                    <i class="fas fa-fish fa-2x text-primary opacity-50"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-3 bg-light rounded">
                                <h6 class="mb-2">Excursions</h6>
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="mb-0">{{ $tourStats['excursion'] }}</h3>
                                    <i class="fas fa-ship fa-2x text-success opacity-50"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="p-3 bg-light rounded">
                                <h6 class="mb-2">Active Tours</h6>
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="mb-0">{{ $recentTours->where('is_active', true)->count() }}</h3>
                                    <i class="fas fa-check-circle fa-2x text-success opacity-50"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Tours Table -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>{{ __('tours.name') }}</th>
                                    <th>{{ __('tours.category') }}</th>
                                    <th>{{ __('tours.price') }}</th>
                                    <th>{{ __('tours.status') }}</th>
                                    <th class="text-end">{{ __('tours.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentTours as $tour)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            @if($tour->image)
                                                <img src="{{ asset('storage/' . $tour->image) }}" alt="{{ $tour->name }}" 
                                                     class="rounded-circle" width="40" height="40" 
                                                     style="object-fit: cover;">
                                            @else
                                                <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center" 
                                                     style="width: 40px; height: 40px;">
                                                    <i class="fas fa-fish text-white"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="fw-bold">{{ $tour->name }}</div>
                                                <small class="text-muted">ID: {{ $tour->id }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge {{ $tour->category === 'fishing' ? 'bg-primary' : 'bg-success' }}">
                                            {{ __('tours.categories.' . $tour->category) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="fw-bold">{{ $tour->formatted_price }}</div>
                                    </td>
                                    <td>
                                        <span class="badge {{ $tour->is_active ? 'bg-success' : 'bg-danger' }}">
                                            {{ $tour->is_active ? __('tours.active') : __('tours.inactive') }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.tours.edit', $tour) }}" 
                                               class="btn btn-sm btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.tours.destroy', $tour) }}" 
                                                  method="POST" class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this tour?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fas fa-fish fa-2x mb-3"></i>
                                            <p class="mb-3">{{ __('tours.no_tours') }}</p>
                                            <a href="{{ route('admin.tours.create') }}" class="btn btn-primary">
                                                <i class="fas fa-plus me-1"></i> {{ __('tours.add_first_tour') }}
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tour Statistics -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-chart-pie me-2"></i>
                    <span class="fw-bold">Tour Statistics</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="card-title mb-4">Tour Categories Distribution</h5>
                            <div class="mb-4">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="fw-bold">{{ __('tours.categories.fishing') }}</span>
                                    <span class="badge bg-primary">{{ $tourStats['fishing'] }}</span>
                                </div>
                                <div class="progress" style="height: 10px">
                                    <div class="progress-bar bg-primary" role="progressbar" 
                                         style="width: {{ ($tourStats['fishing'] / max(1, $totalTours)) * 100 }}%">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="fw-bold">{{ __('tours.categories.excursion') }}</span>
                                    <span class="badge bg-success">{{ $tourStats['excursion'] }}</span>
                                </div>
                                <div class="progress" style="height: 10px">
                                    <div class="progress-bar bg-success" role="progressbar" 
                                         style="width: {{ ($tourStats['excursion'] / max(1, $totalTours)) * 100 }}%">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5 class="card-title mb-4">Tour Status</h5>
                            <div class="d-flex justify-content-around text-center">
                                <div>
                                    <div class="h3 mb-2">
                                        {{ $recentTours->where('is_active', true)->count() }}
                                    </div>
                                    <div class="text-success fw-bold">Active Tours</div>
                                </div>
                                <div>
                                    <div class="h3 mb-2">
                                        {{ $recentTours->where('is_active', false)->count() }}
                                    </div>
                                    <div class="text-danger fw-bold">Inactive Tours</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    box-shadow: 0 0.15rem 1.75rem 0 rgba(33, 40, 50, 0.15);
    margin-bottom: 1rem;
}

.progress {
    height: 0.5rem;
    background-color: rgba(0, 0, 0, 0.1);
}

.bg-light {
    background-color: rgba(255, 255, 255, 0.05) !important;
}

.rounded {
    border-radius: 0.5rem !important;
}

.table > :not(caption) > * > * {
    padding: 1rem;
}

.btn-group {
    gap: 0.25rem;
}

.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
}

.tour-stats-card {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 215, 0, 0.1);
    transition: all 0.3s ease;
}

.tour-stats-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.5rem 1rem rgba(255, 215, 0, 0.1);
}

.progress-bar {
    transition: width 0.6s ease;
}

.badge {
    font-size: 0.75rem;
    padding: 0.35em 0.65em;
}

.text-muted {
    color: #6c757d !important;
}

.table-light {
    background-color: rgba(255, 255, 255, 0.05);
}

.fw-bold {
    font-weight: 600 !important;
}
</style>
@endsection
