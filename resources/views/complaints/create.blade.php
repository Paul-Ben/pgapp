{{-- @extends('layouts.complaints')

@section('content')
<div class="py-4">
    <div class="container">
        <div class="card shadow-sm rounded-3">
            <div class="card-body">
                <h2 class="card-title mb-4 fw-semibold">Submit a Complaint</h2>

                <form method="POST" action="{{ route('complaints.store') }}">
                    @csrf
                    <input type="hidden" name="issue_type" value="{{ $issueType }}">

                    <!-- Matric/JAMB Number - Required for all -->
                    <div class="mb-3">
                        <label for="matric_number" class="form-label">Matric/JAMB Registration Number</label>
                        <input type="text" id="matric_number" name="matric_number" 
                               class="form-control @error('matric_number') is-invalid @enderror" 
                               value="{{ old('matric_number') }}" required>
                        @error('matric_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    @if (!in_array($issueType, ['registration', 'login']))
                        <!-- User Name - Required for non-registration/login issues -->
                        <div class="mb-3">
                            <label for="user_name" class="form-label">Full Name</label>
                            <input type="text" id="user_name" name="user_name" 
                                   class="form-control @error('user_name') is-invalid @enderror" 
                                   value="{{ old('user_name') }}" required>
                            @error('user_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                    @endif

                    @if ($issueType === 'payment')
                        <!-- Payment specific fields -->
                        <div class="mb-3">
                            <label for="payment_reference" class="form-label">Payment Reference Number</label>
                            <input type="text" id="payment_reference" name="payment_reference" 
                                   class="form-control @error('payment_reference') is-invalid @enderror" 
                                   value="{{ old('payment_reference') }}" required>
                            @error('payment_reference')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="payment_item" class="form-label">Payment Item</label>
                            <input type="text" id="payment_item" name="payment_item" 
                                   class="form-control @error('payment_item') is-invalid @enderror" 
                                   value="{{ old('payment_item') }}" required>
                            @error('payment_item')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="amount_paid" class="form-label">Amount Paid</label>
                            <input type="number" step="0.01" id="amount_paid" name="amount_paid" 
                                   class="form-control @error('amount_paid') is-invalid @enderror" 
                                   value="{{ old('amount_paid') }}" required>
                            @error('amount_paid')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                         <div class="mb-3">
                            <label for="description" class="form-label">Description of the Issue</label>
                            <textarea id="description" name="description" rows="4" 
                                      class="form-control @error('description') is-invalid @enderror" 
                                      required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif

                    @if ($issueType === 'others')
                        <!-- Description field for other issues -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description of the Issue</label>
                            <textarea id="description" name="description" rows="4" 
                                      class="form-control @error('description') is-invalid @enderror" 
                                      required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif

                    <div class="d-flex align-items-center gap-3">
                        <button type="submit" class="btn btn-primary">Submit Complaint</button>
                        <a href="{{ route('complaints.index') }}" class="btn btn-link text-decoration-none">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection --}}
@extends('layouts.complaints')

@section('content')
    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm rounded-3">
                <div class="card-body">
                    <h2 class="card-title mb-4 fw-semibold">Submit {{$issueType}} Complaint</h2>

                    <form method="POST" action="{{ route('complaints.store') }}">
                        @csrf
                        <input type="hidden" name="issue_type" value="{{ $issueType }}">

                        <!-- Matric/JAMB Number - Required for all -->
                        <div class="mb-3">
                            <label for="matric_number" class="form-label">Matric/JAMB Registration Number</label>
                            <input type="text" id="matric_number" name="matric_number"
                                class="form-control @error('matric_number') is-invalid @enderror"
                                value="{{ old('matric_number') }}" placeholder="20244012345SD or BSU/SS/com/22/123" required>
                            @error('matric_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @if (!in_array($issueType, ['registration', 'login']))
                            <!-- User Name - Required for non-registration/login issues -->
                            <div class="mb-3">
                                <label for="user_name" class="form-label">Full Name</label>
                                <input type="text" id="user_name" name="user_name"
                                    class="form-control @error('user_name') is-invalid @enderror"
                                    value="{{ old('user_name') }}" placeholder="Terna Shima" required>
                                @error('user_name')
                                    <div class="invalid-feedback">{{ $error }}</div>
                                @enderror
                            </div>
                        @endif

                        @if ($issueType === 'payment')
                            <!-- Payment specific fields -->
                            <div class="mb-3">
                                <label for="payment_reference" class="form-label">Payment Reference Number</label>
                                <input type="text" id="payment_reference" name="payment_reference"
                                    class="form-control @error('payment_reference') is-invalid @enderror"
                                    value="{{ old('payment_reference') }}" placeholder="PR0000000001" required>
                                @error('payment_reference')
                                    <div class="invalid-feedback">{{ $error }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="payment_item" class="form-label">Payment Item</label>
                                <input type="text" id="payment_item" name="payment_item"
                                    class="form-control @error('payment_item') is-invalid @enderror"
                                    value="{{ old('payment_item') }}" placeholder="Eg. School Fees/Acceptance/Admission Checking" required>
                                @error('payment_item')
                                    <div class="invalid-feedback">{{ $error }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="amount_paid" class="form-label">Amount Paid</label>
                                <input type="number" step="0.01" id="amount_paid" name="amount_paid"
                                    class="form-control @error('amount_paid') is-invalid @enderror"
                                    value="{{ old('amount_paid') }}" required>
                                @error('amount_paid')
                                    <div class="invalid-feedback">{{ $error }}</div>
                                @enderror
                            </div>
                        @endif

                        <!-- Description field for all issue types -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description of the Issue</label>
                            <textarea id="description" name="description" rows="4"
                                class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
                            <small id="wordCountHelp" class="form-text text-muted">0 / 50 words</small>
                            @error('description')
                                <div class="invalid-feedback">{{ $error }}</div>
                            @enderror
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <button type="submit" class="btn btn-primary">Submit Complaint</button>
                            <a href="{{ route('complaints.index') }}" class="btn btn-link text-decoration-none">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const textarea = document.getElementById('description');
            const wordCountHelp = document.getElementById('wordCountHelp');
            const maxWords = 50;

            textarea.addEventListener('input', function() {
                let words = this.value.trim().split(/\s+/);
                if (this.value.trim() === '') {
                    words = [];
                }

                if (words.length > maxWords) {
                    // Trim to maxWords
                    this.value = words.slice(0, maxWords).join(' ');
                    words = this.value.trim().split(/\s+/);
                }

                // Update word count display
                wordCountHelp.textContent = `${words.length} / ${maxWords} words`;
            });
        });
    </script>
@endsection
