@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Admin Profile</h1>
    
    <!-- Tampilkan pesan sukses jika ada -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Display current user info -->
    <p>Username: {{ $user->username }}</p>
    <p>Role: {{ $user->role }}</p>
    
    <!-- Button to trigger the modal -->
    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#editProfileModal">
        Edit Profile
    </button>

    <!-- Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form to edit username and password -->
                    <form action="{{ route('admin.updateProfile') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <!-- Edit Username -->
                        <div class="form-group">
                            <label for="username">New Username:</label>
                            <input type="text" name="username" class="form-control" value="{{ $user->username }}" required>
                        </div>
                        
                        <!-- Edit Password -->
                        <div class="form-group">
                            <label for="password">New Password:</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        
                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
