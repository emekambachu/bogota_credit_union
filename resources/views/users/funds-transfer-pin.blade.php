@extends('layouts.users')

@section('title')
Funds Transfer Pin
@endsection

@section('contents')

<div class="card">

    <div class="card-body">

        <p><strong>Receiver Account Name:</strong> {{ Session::get('recaccname') }}</p>
        <p><strong>Receiver Account Number:</strong> {{ Session::get('recaccnum') }}</p>
        <p><strong>Receiver Bank:</strong> {{ Session::get('recbank') }}</p>
        <p><strong>Amount:</strong> ${{ number_format(Session::get('amt')) }}</p><br><br>

        <h4 id="rw-fl-row">Funds Transfer Pin</h4>
        <p class="subtitle margin-bottom-20">Fill all fields to complete Transfer</p>

        @include('includes.alerts')

        <form method="post" action="{{ action('UserController@fundsTransferPin', $transfer->id) }}">
            @csrf
            <div class="form-group">
                <label>Pin *</label>
                <input type="password" max="4" class="form-control" name="pin" placeholder="4 Digit Transaction Pin" required>
            </div>

            <button type="submit" class="btn btn-secondary">Next</button>
        </form>

    </div>
</div>

@endsection
