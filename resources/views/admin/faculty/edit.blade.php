@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>Add a Faculty</h5>
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>

                                    @endif
                                </div>
                                <form method="POST" action="{{ route('faculty.update', $faculty->id) }}"
                                    class="theme-form theme-form-2 mega-form">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="mb-4 row align-items-center">

                                            <label class="form-label-title col-sm-2 mb-4">Faculty Name</label>
                                            <div class="col-sm-4 mb-4">
                                                <input class="form-control" value="{{ $faculty->name }}" name="name" type="text"
                                                    placeholder="Faculty Name" required>
                                            </div>
                                            <label class="form-label-title col-sm-2 mb-4">Faculty Code</label>
                                            <div class="col-sm-4 mb-4">
                                                <input class="form-control" value="{{ $faculty->code }}" name="code" type="text"
                                                    placeholder="Faculty Code" required>
                                            </div>
                                        </div>

                                        {{-- <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-4">Phone Number</label>
                                            <div class="col-sm-4 mb-4">
                                                <input class="form-control" name="phone_no" type="text"
                                                    placeholder="Phone Number" required>
                                            </div>
                                            <label class="form-label-title col-sm-2 mb-4">Rank</label>
                                            <div class="col-sm-4 mb-4">
                                                <input class="form-control" name="rank" type="text" placeholder="Rank"
                                                    required>
                                            </div>

                                        </div> --}}

                                        <div class="button login button-1 text-center">
                                            <button class="btn btn-primary" type="submit">
                                                <span>Submit</span>
                                                <i class="fa fa-check"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
