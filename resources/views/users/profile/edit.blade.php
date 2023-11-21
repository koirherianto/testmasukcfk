@extends('layouts.master')
@section('title')
    Edit Profile
@endsection
@section('page-title')
    Edit Profile
@endsection
@section('body')

    <body>
    @endsection
    @section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Edit Profile</h4>
            </div>
            <div class="card-body">
                @include('flash::message') 
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mt-4 mt-xl-0">
                            <h5 class="font-size-14 mb-4"><i class="mdi mdi-arrow-right text-primary me-1"></i>
                                Data Diri</h5>
                            <form method="POST" action="{{ route('update.profile') }}">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="formrow-firstname-input">Nama</label>
                                    <input type="text" class="form-control" placeholder="Nama" value="{{ $user->name  }}"
                                        id="formrow-firstname-input" name="name">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="formrow-email-input">Email</label>
                                            <input type="email" class="form-control" placeholder="Email" value="{{ $user->email  }}"
                                                id="formrow-email-input" name="email">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="formrow-email-input">Email</label>
                                            <input type="email" class="form-control" placeholder="Email" value="{{ $user->email  }}"
                                                id="formrow-email-input">
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary w-md">Ubah Profile</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-5 ms-lg-auto">
                        <div class="mt-5 mt-lg-4 mt-xl-0">
                            <h5 class="font-size-14 mb-4"><i class="mdi mdi-arrow-right text-primary me-1"></i>
                                Password</h5>

                            <form method="POST" action="{{ route('update.password') }}">
                                @csrf
                                <div class="row mb-4">
                                    <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Password Lama</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" placeholder="Password Lama"
                                            id="horizontal-firstname-input" name="password_lama">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="horizontal-email-input"
                                        class="col-sm-3 col-form-label">Password Baru</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" placeholder="Password Baru"
                                            id="horizontal-email-input" name="password_baru">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="horizontal-password-input"
                                        class="col-sm-3 col-form-label">Password Confirm</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" placeholder="Password Confirm"
                                            id="horizontal-password-input" name="password_confirm">
                                    </div>
                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-sm-9">
                                        <div>
                                            <button type="submit" class="btn btn-primary w-md">Change Password</button>
                                        </div>
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
<!-- End Form Layout -->

<!-- end row -->
@endsection
@section('scripts')
    <!-- App js -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection