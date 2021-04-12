@extends('layouts.users')

@section('title')
Cost of Transaction Code
@endsection

@section('contents')

<div class="card">
    <div class="card-body">

        <p><strong>Receiver Account Name:</strong> {{ Session::get('recaccname') }}</p>
        <p><strong>Receiver Account Number:</strong> {{ Session::get('recaccnum') }}</p>
        <p><strong>Receiver Bank:</strong> {{ Session::get('recbank') }}</p>
        <p><strong>Amount:</strong> ${{ Session::get('amt') }}</p><br><br>

        <h4 id="rw-fl-row">Cost of Transaction code</h4>
        <p class="subtitle margin-bottom-20">Fill in the field to proceed</p>

        @include('includes.alerts')

        <form method="post" action="{{ action('UserController@fundsTransferCot', $transfer->id) }}">
            @csrf
            <div class="form-group">
                <label>Cost of Transfer Code *</label>
                <input type="text" class="form-control" name="cot" placeholder="Cost of Transfer" required>
            </div>

            <button type="submit" class="btn btn-secondary">Next</button>
        </form>

    </div>
</div>

@endsection
