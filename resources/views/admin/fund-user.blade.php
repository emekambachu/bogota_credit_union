@extends('layouts.admin')

@section('title')
Fund User
@endsection

@section('contents')

<div class="card">
    <div class="card-body">
        <h4 id="rw-fl-row">Fund {{$user->fname}} {{$user->lname}}'s Account</h4>
        <h5 id="rw-fl-row">Current Balance: ${{$user->accbal}}</h5>
        <p class="subtitle margin-bottom-20">Fill in the amount</p>

        @include('includes.alerts')

        <form method="post" action="{{ action('AdminController@fundUser', $user->id) }}">
            @csrf
            <div class="form-group">
                <label>Sender Account Name *</label>
                <input type="text" class="form-control" name="sendaccname" placeholder="Sender Account Name" required>
            </div>

            <div class="form-group">
                <label>Sender Account Number *</label>
                <input type="number" class="form-control" name="sendaccnum" placeholder="Sender Account Number" required>
            </div>

            <div class="form-group">
                <label>Sender Bank *</label>
                <input type="text" class="form-control" name="sendbank" placeholder="Sender bank" required>
            </div>

            <div class="form-group">
                <label>Amount to Transfer USD$ *</label>
                <input type="number" class="form-control" name="amt" placeholder="Amount to Transfer USD$" required>
            </div>

            <div class="form-group">
                <label>Description *</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-secondary">Fund User</button>
        </form>

    </div>
</div>

@endsection
