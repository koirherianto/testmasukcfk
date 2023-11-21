@extends('layouts.master')
@section('title')
    Profile
@endsection
@section('page-title')
    Profile
@endsection
@section('body')
<body>
    @endsection
    @section('content')
    <div class="row">
        <div class="col-xxl-3">
            <div class="card">
                    @include('flash::message')
                    <div class="card-body p-0">
                        <div class="user-profile-img">
                            <img src="{{ URL::asset('build/images/pattern-bg.jpg') }}"
                                class="profile-img profile-foreground-img rounded-top" style="height: 120px;" alt="">
                            <div class="overlay-content rounded-top">
                                <div>
                                    <div class="user-nav p-3">
                                        <div class="d-flex justify-content-end">
                                            <div class="dropdown">
                                                <a class="text-muted dropdown-toggle font-size-16" href="#"
                                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true">
                                                    <i class="bx bx-dots-vertical text-white font-size-20"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="{{ route('edit.profile') }}">Edit</a>
                                                    <a class="dropdown-item" href="{{ route('edit.profile') }}">Action</a>
                                                    <a class="dropdown-item" href="{{ route('edit.profile') }}">Remove</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 pt-0">

                            <div class="mt-n5 position-relative text-center border-bottom pb-3">
                                <a href="#" id="changePhotoBtn" style="position: relative; display: inline-block;">
                                    <img src="{{ $user->getFirstMediaUrl('foto') ?: asset('build/images/users/avatar-3.jpg') }}" alt="" class="avatar-xl rounded-circle img-thumbnail">
                                    <div style="position: absolute; bottom: 0; right: 0;  padding: 4px;">
                                        <i class="fas fa-camera"></i> 
                                    </div>
                                </a>
                                

                                <!-- Formulir tersembunyi untuk mengunggah foto -->
                                {!! Form::open(['route' => 'update.foto.profile', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'uploadForm']) !!}
                                <input type="file" style="display: none" id="fotoInput" name="foto" accept="image/*">
                                <button type="submit" style="display: none" id="submitBtn">Upload Foto Profil</button>
                                {!! Form::close() !!}

                                <div class="mt-3">
                                    <h5 class="mb-1">{{ $user->name }}</h5>
                                    <p class="text-muted mb-0">
                                        {{ $user->email }}
                                    </p>
                                </div>

                            </div>

                            <div class="table-responsive mt-3 border-bottom pb-3">
                                <table
                                    class="table align-middle table-sm table-nowrap table-borderless table-centered mb-0">
                                    <tbody>
                                        <tr>
                                            <th class="fw-bold">
                                                Name :</th>
                                            <td class="text-muted">{{ $user->name }}</td>
                                        </tr>
                                        <!-- end tr -->
                                        <tr>
                                            <th class="fw-bold">
                                                Email :</th>
                                            <td class="text-muted">{{ $user->email }}</td>
                                        </tr>
                                        <!-- end tr -->
                                        <tr>
                                            <th class="fw-bold">
                                                Terdaftar Pada :</th>
                                            <td class="text-muted">{{ $user->created_at }}</td>
                                        </tr>
                                    </tbody><!-- end tbody -->
                                </table>
                            </div>

                            <div class="pt-2 text-center border-bottom pb-4">
                                <a href="{{ route('edit.profile') }}" class="btn btn-primary waves-effect waves-light btn-sm">Edit Profile</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('scripts')
        <script>
            document.getElementById('changePhotoBtn').addEventListener('click', function() {
                // Saat foto diklik, picu klik pada elemen input file tersembunyi
                document.getElementById('fotoInput').click();
            });
        
            // Saat input file tersembunyi berubah (pengguna memilih file), picu submit pada formulir
            document.getElementById('fotoInput').addEventListener('change', function() {
                document.getElementById('submitBtn').click();
            });
        </script>
    

        <!-- apexcharts -->
        <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

        <script src="{{ URL::asset('build/js/pages/profile.init.js') }}"></script>
        <!-- App js -->
        <script src="{{ URL::asset('build/js/app.js') }}"></script>
    @endsection
