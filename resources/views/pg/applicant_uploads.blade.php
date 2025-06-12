@extends('layouts.dashboard')
@section('content')
    <div class="title-header">
        <h5>Document Upload</h5>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>Upload Required Documents</h5>
                                   
                                    <span class="text-muted">Please upload your credentials and passport. Ensure that the files are in the correct format and size.</span><br>
                                    <span class="text-muted">Note: You are to compile all credentials into a single pdf file and upload as a single document.</span>
                                    
                                </div>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('document.upload', $applicants_id) }}"
                                    enctype="multipart/form-data" class="theme-form theme-form-2 mega-form">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-4">
                                                Upload Credentials (PDF)
                                            </label>
                                            <div class="col-sm-4 mb-4">
                                                <input class="form-control" type="file" name="credentials"
                                                    accept="application/pdf" required onchange="showPdfThumbnail(this)">
                                                <small class="text-muted">Only PDF files allowed. Max size: 2MB.</small>
                                                <div id="pdf-thumbnail" class="mt-2"></div>
                                            </div>
                                            <div>
                                                <input type="text" name="applicants_id" value="{{ $applicants_id }}"
                                                    class="form-control" hidden>
                                            </div>
                                            <label class="form-label-title col-sm-2 mb-4">
                                                Upload Passport (Image)
                                            </label>
                                            <div class="col-sm-4 mb-4">
                                                <input class="form-control" type="file" name="passport" accept="image/*"
                                                    required onchange="showImageThumbnail(this)">
                                                <small class="text-muted">Only image files allowed. Max size: 300KB.</small>
                                                <div id="image-thumbnail" class="mt-2"></div>
                                            </div>
                                        </div>
                                        <div class="button login button-1 text-center">
                                            <button class="btn btn-primary" type="submit">
                                                <span>Upload</span>
                                                <i class="fa fa-upload"></i>
                                            </button>
                                            {{-- <a href="{{ route('referees.form', $applicants_id) }}">
                                                <button class="btn btn-success" type="button" style="background: blue">
                                                    <span>Next</span>
                                                    <i class="fa fa-arrow-right"></i>
                                                </button>
                                            </a> --}}
                                        </div>
                                    </div>
                                </form>
                                {{-- Preview Section --}}
                                {{-- @if ($credentials != null)
                                    <div class="mt-5">
                                        <h6>Preview Uploaded Documents</h6>
                                        <ul class="list-unstyled">
                                            @if ($credentials->credentials != null)
                                                <li>
                                                    <a href="{{ $credentials->credentials }}" target="_blank"
                                                        class="btn btn-outline-primary mb-2">
                                                        <i class="fa fa-file-pdf-o"></i> Preview Uploaded Credential
                                                    </a>
                                                </li>
                                            @endif

                                            @if ($credentials->passport != null)
                                                <li>
                                                    <a href="{{ $credentials->passport }}" target="_blank"
                                                        class="btn btn-outline-success mb-2">
                                                        <i class="fa fa-image"></i> Preview Uploaded Passport
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                @endif --}}
                                @if ($credentials)
                                    <div class="mt-5">
                                        <h6>Preview Uploaded Documents After Upload</h6>
                                        <ul class="list-unstyled">
                                            @if ($credentials->credentials)
                                                <li>
                                                    <a href="{{ $credentials->credentials }}" target="_blank"
                                                        class="btn btn-outline-primary mb-2">
                                                        <i class="fa fa-file-pdf-o"></i> Preview Uploaded Credential
                                                    </a>
                                                </li>
                                            @endif

                                            @if ($credentials->passport)
                                                <li>
                                                    <a href="{{ $credentials->passport }}" target="_blank"
                                                        class="btn btn-outline-success mb-2">
                                                        <i class="fa fa-image"></i> Preview Uploaded Passport
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function showPdfThumbnail(input) {
            const container = document.getElementById('pdf-thumbnail');
            container.innerHTML = '';
            if (input.files && input.files[0]) {
                const file = input.files[0];
                if (file.type === "application/pdf") {
                    const url = URL.createObjectURL(file);
                    container.innerHTML =
                        `<embed src="${url}#toolbar=0&navpanes=0&scrollbar=0" type="application/pdf" width="100%" height="120px" style="border:1px solid #ccc; border-radius:4px;" />`;
                }
            }
        }

        function showImageThumbnail(input) {
            const container = document.getElementById('image-thumbnail');
            container.innerHTML = '';
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    container.innerHTML =
                        `<img src="${e.target.result}" alt="Passport Preview" style="max-width:100px; max-height:120px; border:1px solid #ccc; border-radius:4px;" />`;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
