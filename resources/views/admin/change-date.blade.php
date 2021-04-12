@extends('layouts.admin')

@section('title')
    Change Transaction Date
@endsection

@section('contents')

    <div class="card">
        <div class="card-body">
            <h4 id="rw-fl-row">Change {{ $transaction->user ? $transaction->user->fname : '' }} {{ $transaction->user ? $transaction->user->lname : '' }}'s Transaction Date</h4>
            <h5 id="rw-fl-row">Current Transaction Date: {{date('jS \of F Y', strtotime($transaction->created_at))}}</h5>
            <p class="subtitle margin-bottom-20">Change Transaction Date</p>

            @include('includes.alerts')

            <form method="post" action="{{ action('AdminController@changeDate', $transaction->id) }}">
                @csrf
                <div class="form-group">
                    <label>Transaction Date *</label>
                    <input type="date" class="form-control" name="date" placeholder="Change Date" required>
                </div>
                <button type="submit" class="btn btn-secondary">Update</button>
            </form>

        </div>
    </div>
@endsection
