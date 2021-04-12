@extends('layouts.admin')

@section('title')
    User withdrawal and Transfer
@endsection

@section('contents')

    <div class="card">
        <div class="card-body">
            <h4 id="rw-fl-row">Transfer Funds from {{$user->fname}} {{$user->lname}}'s Account</h4>
            <h5 id="rw-fl-row">Current Balance: ${{$user->accbal}}</h5>
            <p class="subtitle margin-bottom-20">Fill in the Details</p>

            @include('includes.alerts')

            <form method="post" action="{{ action('AdminController@fundWithdrawal', $user->id) }}">
                @csrf
                <div class="form-group">
                    <label>Receiver Account Name *</label>
                    <input type="text" class="form-control" name="recaccname" placeholder="Receiver Account Name" required>
                </div>

                <div class="form-group">
                    <label>Receiver Account Number *</label>
                    <input type="number" class="form-control" name="recaccnum" placeholder="Receiver Account Number" required>
                </div>

                <div class="form-group">
                    <label>Receiver Bank *</label>
                    <input type="text" class="form-control" name="recbank" placeholder="Receiver bank" required>
                </div>

                <div class="form-group">
                    <label>Amount to Transfer USD$ *</label>
                    <input type="number" class="form-control" name="amt" placeholder="Amount to Withdraw USD$" required>
                </div>

                <div class="form-group">
                    <label>Description *</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>

                <button type="submit" class="btn btn-secondary">User Withdrawal</button>
            </form>

        </div>
    </div>

@endsection
