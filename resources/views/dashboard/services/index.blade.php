@extends('layouts.admin-base')

@section('content')
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="text-white mb-2">Services Management</h2>
                    <p class="text-light mb-0">Manage your restaurant's menu items and services</p>
                </div>
                <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New Service
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- View Toggle -->
    <div class="card mb-4">
        <div class="card-body p-3">
            <div class="btn-group" role="group">
                <button class="btn btn-primary active" id="gridViewBtn">
                    <i class="fas fa-th-large"></i> Grid View
                </button>
                <button class="btn btn-primary" id="tableViewBtn">
                    <i class="fas fa-list"></i> List View
                </button>
            </div>
        </div>
    </div>

    <!-- Grid View -->
    <div id="gridView" class="row">
        @foreach($services as $service)
            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                <div class="card h-100 service-card">
                    <div class="service-image">
                        @if($service->image)
                            <img src="{{ $service->image }}" alt="{{ $service->name }}" class="card-img-top">
                        @else
                            <div class="no-image">
                                <i class="fas fa-utensils"></i>
                            </div>
                        @endif
                        <div class="service-status {{ $service->is_active ? 'active' : 'inactive' }}">
                            <span class="badge bg-{{ $service->is_active ? 'success' : 'danger' }}">
                                {{ $service->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-gold">{{ $service->name }}</h5>
                        <p class="card-text text-light">{{ Str::limit($service->description, 100) }}</p>
                        <div class="price mb-3">${{ number_format($service->price ?? 0, 2) }}</div>
                    </div>
                    <div class="card-footer bg-transparent border-top border-gold-light">
                        <div class="d-flex justify-content-between gap-2">
                            <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-primary flex-grow-1">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline flex-grow-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-100" 
                                        onclick="return confirm('Are you sure you want to delete this service?')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Table View -->
    <div id="tableView" class="card shadow" style="display: none;">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="servicesTable">
                    <thead>
                        <tr>
                            <th style="width: 80px;">Image</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th style="width: 100px;">Price</th>
                            <th style="width: 100px;">Status</th>
                            <th style="width: 150px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $service)
                            <tr>
                                <td>
                                    @if($service->image)
                                        <img src="{{ $service->image }}" alt="{{ $service->name }}" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <div class="text-center text-gold">
                                            <i class="fas fa-utensils fa-2x"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="text-white">{{ $service->name }}</td>
                                <td class="text-light">{{ Str::limit($service->description, 100) }}</td>
                                <td class="text-gold">${{ number_format($service->price ?? 0, 2) }}</td>
                                <td>
                                    <span class="badge bg-{{ $service->is_active ? 'success' : 'danger' }}">
                                        {{ $service->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" 
                                                    onclick="return confirm('Are you sure you want to delete this service?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .text-gold {
        color: var(--gold) !important;
    }

    .border-gold-light {
        border-color: rgba(255, 215, 0, 0.2) !important;
    }

    .service-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .service-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    .service-image {
        position: relative;
        height: 200px;
        overflow: hidden;
        background: rgba(0, 0, 0, 0.2);
    }

    .service-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .service-image .no-image {
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: var(--gold);
    }

    .service-status {
        position: absolute;
        top: 10px;
        right: 10px;
    }

    .price {
        font-size: 1.5rem;
        font-weight: bold;
        color: var(--gold);
    }

    .btn-group .btn {
        margin: 0 2px;
    }

    /* View Toggle Buttons */
    .btn-group .btn {
        background: rgba(255, 215, 0, 0.1);
        color: var(--gold);
        border: 1px solid var(--gold);
    }

    .btn-group .btn.active,
    .btn-group .btn:hover {
        background: var(--gold);
        color: var(--dark);
    }

    /* Table Enhancements */
    .table th {
        font-weight: 600;
    }

    .table tr:hover {
        background: rgba(255, 255, 255, 0.05);
    }
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize DataTable
    const table = $('#servicesTable').DataTable({
        "order": [[1, "asc"]],
        "pageLength": 10,
        "language": {
            "search": "Search services:",
            "lengthMenu": "Show _MENU_ services per page",
            "info": "Showing _START_ to _END_ of _TOTAL_ services"
        }
    });

    // View Toggle Handlers
    $('#gridViewBtn').click(function() {
        $(this).addClass('active');
        $('#tableViewBtn').removeClass('active');
        $('#gridView').fadeIn(300);
        $('#tableView').fadeOut(300);
    });

    $('#tableViewBtn').click(function() {
        $(this).addClass('active');
        $('#gridViewBtn').removeClass('active');
        $('#gridView').fadeOut(300);
        $('#tableView').fadeIn(300);
        table.columns.adjust();
    });
});
</script>
@endpush
