{{-- <x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 mb-6 rounded-full bg-green-100">
                            <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>

                        <h2 class="text-2xl font-semibold mb-2">Complaint Submitted Successfully!</h2>
                        <p class="text-gray-600 mb-6">Your complaint has been registered in our system.</p>

                        <div class="bg-gray-50 rounded-lg p-6 mb-6 inline-block">
                            <p class="text-sm text-gray-600 mb-2">Your Ticket Number:</p>
                            <p class="text-xl font-mono font-bold text-gray-900">{{ $complaint->ticket_number }}</p>
                        </div>

                        <div class="space-y-4">
                            <p class="text-gray-600">Please keep this ticket number for future reference.</p>
                            <p class="text-gray-600">We will process your complaint and get back to you soon.</p>
                        </div>

                        <div class="mt-8">
                            <a href="{{ route('complaints.index') }}"
                               class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Return to Home
                            </a>
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
            <div class="card-body text-center">

                <!-- Success Icon -->
                <div class="mx-auto mb-4 d-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-10" style="width: 64px; height: 64px;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="32" height="32" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 13l4 4L19 7" />
                    </svg>
                </div>

                <!-- Heading -->
                <h2 class="h4 fw-semibold mb-2">Complaint Submitted Successfully!</h2>

                <!-- Description -->
                <p class="text-muted mb-4">Your complaint has been registered in our system.</p>

                <!-- Ticket Number Box -->
                <div class="bg-light rounded-3 p-4 mb-4 d-inline-block text-start">
                    <p class="mb-1 text-secondary small">Your Ticket Number:</p>
                    <p class="mb-0 fw-monospace fs-4 fw-bold text-dark">{{ $complaint->ticket_number }}</p>
                </div>

                <!-- Additional Info -->
                <div class="mb-4">
                    <p class="text-muted mb-2">Please keep this ticket number for future reference.</p>
                    <p class="text-muted mb-0">We will process your complaint and get back to you soon.</p>
                </div>

                <!-- Return Button -->
                <a href="{{ route('complaints.index') }}" 
                   class="btn btn-dark text-uppercase px-4 py-2 fw-semibold shadow-sm">
                    Return to Home
                </a>

            </div>
        </div>
    </div>
</div>
@endsection
