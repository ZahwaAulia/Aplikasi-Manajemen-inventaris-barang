@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6>Edit Profile Photo</h6>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-4">
                                <div class="text-center">
                                    @if ($user->profile_photo)
                                        <img src="{{ asset($user->profile_photo) }}" alt="Profile Photo"
                                            class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                                    @else
                                        <div class="bg-gradient-dark rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 150px; height: 150px;">
                                            <i class="fas fa-user text-white" style="font-size: 4rem;"></i>
                                        </div>
                                    @endif
                                    <p class="mt-3">Current Profile Photo</p>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="profile_photo">Choose New Photo</label>
                                        <input type="file" class="form-control" id="profile_photo" name="profile_photo"
                                            accept="image/*">
                                        <small class="form-text text-muted">Accepted formats: JPEG, PNG, JPG, GIF. Max size:
                                            2MB</small>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Photo</button>
                                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
