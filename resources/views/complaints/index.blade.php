{{-- <x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-semibold mb-6">Student Complaint System</h2>
                    
                    <div class="mb-4">
                        <p class="text-gray-600 mb-4">Please select the type of issue you're experiencing:</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($issueTypes as $value => $label)
                                <a href="{{ route('complaints.create', ['type' => $value]) }}"
                                   class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-50 transition-colors">
                                    <h5 class="mb-2 text-xl font-semibold tracking-tight text-gray-900">{{ $label }}</h5>
                                    <p class="text-gray-600">Click to submit a complaint regarding {{ strtolower($label) }}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
@extends('layouts.complaints')

@section('content')
<div class="py-4">
    <div class="container">
        <div class="card shadow-sm rounded-3">
            <div class="card-body">
                <h2 class="card-title mb-4 fw-semibold">Student Complaint System</h2>

                <p class="text-muted mb-4">Please select the type of issue you're experiencing:</p>

                <div class="row g-4">
                    @foreach($issueTypes as $value => $label)
                        <div class="col-12 col-md-6 col-lg-4">
                            <a href="{{ route('complaints.create', ['type' => $value]) }}" 
                               class="text-decoration-none">
                                <div class="card h-100 border border-secondary shadow-sm hover-shadow">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title fw-semibold">{{ $label }}</h5>
                                        <p class="card-text text-muted flex-grow-1">
                                            Click to submit a complaint regarding {{ strtolower($label) }}.
                                        </p>
                                        <span class="btn btn-outline-primary mt-auto align-self-start">Submit</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
