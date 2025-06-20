@extends('layouts.admin-base')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mt-4">{{ __('tours.manage_tours') }}</h1>
        <a href="{{ route('admin.tours.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> {{ __('tours.add_new') }}
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-fish me-1"></i>
            {{ __('tours.tours_list') }}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>{{ __('tours.image') }}</th>
                            <th>{{ __('tours.name') }}</th>
                            <th>{{ __('tours.category') }}</th>
                            <th>{{ __('tours.price') }}</th>
                            <th>{{ __('tours.status') }}</th>
                            <th>{{ __('tours.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tours as $tour)
                        <tr>
                            <td width="100">
                                @if($tour->image)
                                    <img src="{{ $tour->image }}" alt="{{ $tour->name }}" class="img-thumbnail" width="80">
                                @else
                                    <div class="no-image">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $tour->name }}</strong>
                                <br>
                                <small>{{ Str::limit($tour->description, 100) }}</small>
                            </td>
                            <td>
                                <span class="badge {{ $tour->category === 'fishing' ? 'bg-primary' : 'bg-success' }}">
                                    {{ __('tours.categories.' . $tour->category) }}
                                </span>
                            </td>
                            <td>{{ $tour->formatted_price }}</td>
                            <td>
                                <span class="badge {{ $tour->is_active ? 'bg-success' : 'bg-danger' }}">
                                    {{ $tour->is_active ? __('tours.active') : __('tours.inactive') }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.tours.edit', $tour) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.tours.destroy', $tour) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('{{ __('tours.confirm_delete') }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <div class="empty-state">
                                    <i class="fas fa-fish fa-2x mb-3"></i>
                                    <p>{{ __('tours.no_tours') }}</p>
                                    <a href="{{ route('admin.tours.create') }}" class="btn btn-primary">
                                        {{ __('tours.add_first_tour') }}
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end">
                {{ $tours->links() }}
            </div>
        </div>
    </div>
</div>

<style>
.no-image {
    width: 80px;
    height: 80px;
    background: #f8f9fa;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #adb5bd;
    border-radius: 0.25rem;
}

.empty-state {
    text-align: center;
    padding: 2rem;
    color: #6c757d;
}

.table > :not(caption) > * > * {
    vertical-align: middle;
}
</style>
@endsection
