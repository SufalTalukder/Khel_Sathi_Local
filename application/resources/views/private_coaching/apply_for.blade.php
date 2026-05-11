@extends('layouts.private_coaching_auth_layout')
@section('content')



<style>
    .option-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .option-card:hover {
        transform: scale(1.03);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    }
    .option-card.disabled {
        opacity: 0.5;
        pointer-events: none;
        cursor: not-allowed;
    }
</style>

<div class="container-fluid pagecontentbody">
    <div class="tab-content">
        <div class="pagebody removebg-color">
            <div class="col-md-12 pageheader pb-2">
                <div class="row">
                    <div class="col-md-10">
                        <h4 class="mb-0">Apply For</h4>
                    </div>
                </div>
            </div>

            <div class="row g-4 px-3 py-2">

                {{-- Card: Academies --}}
                <div class="col-md-3">
                    <div class="card option-card shadow-sm border-0 h-100 {{ $applied['academies'] ? 'disabled' : '' }}">
                        @unless($applied['academies']) <a href="{{ route('private_coaching_academies') }}" class="text-decoration-none text-dark"> @endunless
                        <div class="card-body text-center">
                            <i class="bi bi-building fs-1 text-primary mb-3"></i>
                            <h5 class="card-title">Academies</h5>
                            <p class="text-muted small">
                                {{ $applied['academies'] ? 'Already Applied' : 'Apply for coaching academies' }}
                            </p>
                        </div>
                        @unless($applied['academies']) </a> @endunless
                    </div>
                </div>

                {{-- Card: Associations --}}
                <div class="col-md-3">
                    <div class="card option-card shadow-sm border-0 h-100 {{ $applied['associations'] ? 'disabled' : '' }}">
                        @unless($applied['associations']) <a href="{{ route('private_coaching_application_form') }}" class="text-decoration-none text-dark"> @endunless
                        <div class="card-body text-center">
                            <i class="bi bi-people fs-1 text-success mb-3"></i>
                            <h5 class="card-title">Associations</h5>
                            <p class="text-muted small">
                                {{ $applied['associations'] ? 'Already Applied' : 'Apply for sports associations' }}
                            </p>
                        </div>
                        @unless($applied['associations']) </a> @endunless
                    </div>
                </div>

                {{-- Card: Gyms --}}
                <div class="col-md-3">
                    <div class="card option-card shadow-sm border-0 h-100 {{ $applied['gyms'] ? 'disabled' : '' }}">
                        @unless($applied['gyms']) <a href="{{ route('private_coaching_gyms') }}" class="text-decoration-none text-dark"> @endunless
                        <div class="card-body text-center">
                            <i class="bi bi-dumbbell fs-1 text-danger mb-3"></i>
                            <h5 class="card-title">Gyms</h5>
                            <p class="text-muted small">
                                {{ $applied['gyms'] ? 'Already Applied' : 'Apply for gym registration' }}
                            </p>
                        </div>
                        @unless($applied['gyms']) </a> @endunless
                    </div>
                </div>

                {{-- Card: Swimming Pools --}}
                <div class="col-md-3">
                    <div class="card option-card shadow-sm border-0 h-100 {{ $applied['swimming'] ? 'disabled' : '' }}">
                        @unless($applied['swimming']) <a href="{{ route('private_coaching_swimming_pool') }}" class="text-decoration-none text-dark"> @endunless
                        <div class="card-body text-center">
                            <i class="bi bi-water fs-1 text-info mb-3"></i>
                            <h5 class="card-title">Swimming Pools</h5>
                            <p class="text-muted small">
                                {{ $applied['swimming'] ? 'Already Applied' : 'Apply for swimming pool registration' }}
                            </p>
                        </div>
                        @unless($applied['swimming']) </a> @endunless
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection
