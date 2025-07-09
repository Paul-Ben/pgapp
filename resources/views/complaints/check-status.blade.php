{{-- <x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-semibold mb-6">Check Complaint Status</h2>

                    <form method="POST" action="{{ route('complaints.check-status') }}" class="space-y-6 max-w-md">
                        @csrf

                        <div>
                            <x-input-label for="ticket_number" value="Ticket Number" />
                            <x-text-input id="ticket_number" name="ticket_number" type="text" 
                                class="mt-1 block w-full" required placeholder="Enter your ticket number" />
                            <x-input-error :messages="$errors->get('ticket_number')" class="mt-2" />
                        </div>

                        <x-primary-button>Check Status</x-primary-button>
                    </form>

                    @if(isset($complaint))
                        <div class="mt-8 p-6 bg-gray-50 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Ticket Status</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <span class="font-medium">Ticket Number:</span>
                                    <span class="ml-2">{{ $complaint->ticket_number }}</span>
                                </div>
                                
                                <div>
                                    <span class="font-medium">Issue Type:</span>
                                    <span class="ml-2">{{ ucfirst(str_replace('_', ' ', $complaint->issue_type)) }}</span>
                                </div>

                                <div>
                                    <span class="font-medium">Status:</span>
                                    <span class="ml-2 px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        {{ $complaint->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $complaint->status === 'in_progress' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $complaint->status === 'resolved' ? 'bg-green-100 text-green-800' : '' }}">
                                        {{ ucfirst($complaint->status) }}
                                    </span>
                                </div>

                                <div>
                                    <span class="font-medium">Submitted:</span>
                                    <span class="ml-2">{{ $complaint->created_at->format('F j, Y, g:i a') }}</span>
                                </div>

                                @if($complaint->status === 'resolved')
                                    <div>
                                        <span class="font-medium">Resolved:</span>
                                        <span class="ml-2">{{ $complaint->updated_at->format('F j, Y, g:i a') }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif
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
                <h2 class="card-title mb-4 fw-semibold">Check Complaint Status</h2>

                <form method="POST" action="{{ route('complaints.check-status') }}" class="mb-4" style="max-width: 400px;">
                    @csrf

                    <div class="mb-3">
                        <label for="ticket_number" class="form-label">Ticket Number</label>
                        <input type="text" id="ticket_number" name="ticket_number" 
                               class="form-control @error('ticket_number') is-invalid @enderror" 
                               placeholder="Enter your ticket number" required 
                               value="{{ old('ticket_number') }}">
                        @error('ticket_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Check Status</button>
                </form>

                @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                @if(isset($complaint))
                    <div class="bg-light rounded-3 p-4 text-dark">
                        <h3 class="h5 fw-medium mb-4">Ticket Status</h3>

                        <div class="mb-3">
                            <span class="fw-semibold">Ticket Number:</span>
                            <span class="ms-2">{{ $complaint->ticket_number }}</span>
                        </div>

                        <div class="mb-3">
                            <span class="fw-semibold">Issue Type:</span>
                            <span class="ms-2">{{ ucfirst(str_replace('_', ' ', $complaint->issue_type)) }}</span>
                        </div>

                        <div class="mb-3">
                            <span class="fw-semibold">Status:</span>
                            @php
                                $statusClasses = [
                                    'pending' => 'bg-warning text-dark',
                                    'in_progress' => 'bg-info text-white',
                                    'resolved' => 'bg-success text-white',
                                ];
                                $statusClass = $statusClasses[$complaint->status] ?? 'bg-secondary text-white';
                            @endphp
                            <span class="badge {{ $statusClass }} ms-2 text-uppercase">
                                {{ str_replace('_', ' ', ucfirst($complaint->status)) }}
                            </span>
                        </div>

                        <div class="mb-3">
                            <span class="fw-semibold">Submitted:</span>
                            <span class="ms-2">{{ $complaint->created_at->format('F j, Y, g:i a') }}</span>
                        </div>

                        @if($complaint->status === 'resolved')
                            <div>
                                <span class="fw-semibold">Resolved:</span>
                                <span class="ms-2">{{ $complaint->updated_at->format('F j, Y, g:i a') }}</span>
                            </div>
                        @endif
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
