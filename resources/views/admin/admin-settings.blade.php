@extends('layouts.admin')

@section('title')
    Admin Account Settings
@endsection

@section('contents')

    <div class="card">
        <div class="card-body">

            <h4 id="rw-fl-row"><strong>Account Settings</strong></h4>
            <p class="subtitle margin-bottom-20">Update Information</p>

            @include('includes.alerts')

            <form method="post" action="{{ route('update-admin-account') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Name *</label>
                    <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required>
                </div>

                <div class="form-group">
                    <label>Email *</label>
                    <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required>
                </div>

                <div class="form-group">
                    <label>Username *</label>
                    <input type="text" class="form-control" name="username" value="{{ Auth::user()->username }}" required>
                </div>

                <div class="form-group">
                    <label>Password *</label>
                    <input type="password" class="form-control" name="password">
                </div>

                <button type="submit" class="btn btn-secondary" style="background-color: #002D55; color: #fff;">Update</button>
            </form>

        </div>
    </div>

@endsection
