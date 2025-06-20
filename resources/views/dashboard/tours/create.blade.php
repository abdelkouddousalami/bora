@extends('layouts.admin-base')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="mt-4">
            {{ isset($tour) ? __('tours.edit_tour') : __('tours.add_tour') }}
        </h1>
        <a href="{{ route('admin.tours.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> {{ __('tours.back_to_list') }}
        </a>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-edit me-1"></i>
            {{ isset($tour) ? __('tours.edit_details') : __('tours.tour_details') }}
        </div>
        <div class="card-body">
            <form action="{{ isset($tour) ? route('admin.tours.update', $tour) : route('admin.tours.store') }}" 
                  method="POST" 
                  enctype="multipart/form-data">
                @csrf
                @if(isset($tour))
                    @method('PUT')
                @endif

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('tours.name') }} *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" required 
                                   value="{{ old('name', $tour->name ?? '') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">{{ __('tours.category') }} *</label>
                            <select class="form-select @error('category') is-invalid @enderror" 
                                    id="category" name="category" required>
                                <option value="fishing" {{ (old('category', $tour->category ?? '') === 'fishing') ? 'selected' : '' }}>
                                    {{ __('tours.categories.fishing') }}
                                </option>
                                <option value="excursion" {{ (old('category', $tour->category ?? '') === 'excursion') ? 'selected' : '' }}>
                                    {{ __('tours.categories.excursion') }}
                                </option>
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="duration" class="form-label">{{ __('tours.duration') }}</label>
                            <input type="text" class="form-control @error('duration') is-invalid @enderror" 
                                   id="duration" name="duration" 
                                   value="{{ old('duration', $tour->duration ?? '') }}"
                                   placeholder="e.g., 4h, Half Day">
                            @error('duration')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="capacity" class="form-label">{{ __('tours.capacity') }}</label>
                            <input type="text" class="form-control @error('capacity') is-invalid @enderror" 
                                   id="capacity" name="capacity" 
                                   value="{{ old('capacity', $tour->capacity ?? '') }}"
                                   placeholder="e.g., 2-6 persons, Max 4 guests">
                            @error('capacity')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="price" class="form-label">{{ __('tours.price') }}</label>
                            <div class="input-group">
                                <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" 
                                       id="price" name="price" 
                                       value="{{ old('price', $tour->price ?? '') }}">
                                <select class="form-select @error('price_type') is-invalid @enderror" 
                                        id="price_type" name="price_type">
                                    <option value="per_person" {{ (old('price_type', $tour->price_type ?? '') === 'per_person') ? 'selected' : '' }}>
                                        {{ __('tours.per_person') }}
                                    </option>
                                    <option value="total" {{ (old('price_type', $tour->price_type ?? '') === 'total') ? 'selected' : '' }}>
                                        {{ __('tours.total') }}
                                    </option>
                                </select>
                            </div>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">{{ __('tours.image') }}</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if(isset($tour) && $tour->image)
                                <div class="mt-2">
                                    <img src="{{ $tour->image }}" alt="Current image" class="img-thumbnail" width="150">
                                </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" 
                                       id="is_active" name="is_active" value="1"
                                       {{ old('is_active', $tour->is_active ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">{{ __('tours.is_active') }}</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">{{ __('tours.description') }} *</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" name="description" rows="4" required>{{ old('description', $tour->description ?? '') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="features" class="form-label">{{ __('tours.features') }}</label>
                    <div class="features-container">
                        @if(isset($tour) && $tour->features)
                            @foreach($tour->features as $feature)
                                <div class="feature-input mb-2 d-flex gap-2">
                                    <input type="text" class="form-control" name="features[]" value="{{ $feature }}">
                                    <button type="button" class="btn btn-danger remove-feature">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            @endforeach
                        @endif
                        <div class="feature-input mb-2 d-flex gap-2">
                            <input type="text" class="form-control" name="features[]">
                            <button type="button" class="btn btn-danger remove-feature">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary mt-2" id="add-feature">
                        <i class="fas fa-plus"></i> {{ __('tours.add_feature') }}
                    </button>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> 
                        {{ isset($tour) ? __('tours.update_tour') : __('tours.create_tour') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.querySelector('.features-container');
    const addButton = document.querySelector('#add-feature');

    addButton.addEventListener('click', function() {
        const div = document.createElement('div');
        div.className = 'feature-input mb-2 d-flex gap-2';
        div.innerHTML = `
            <input type="text" class="form-control" name="features[]">
            <button type="button" class="btn btn-danger remove-feature">
                <i class="fas fa-times"></i>
            </button>
        `;
        container.appendChild(div);
    });

    container.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-feature') || 
            e.target.closest('.remove-feature')) {
            const input = e.target.closest('.feature-input');
            if (container.children.length > 1) {
                input.remove();
            } else {
                input.querySelector('input').value = '';
            }
        }
    });
});
</script>
@endsection
