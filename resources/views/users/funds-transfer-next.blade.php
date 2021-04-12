@extends('layouts.users')

@section('title')
Account Verification
@endsection

@section('contents')

<div class="card">
    <div class="card-body">

        <p><strong>Receiver Account Name:</strong> {{ Session::get('recaccname') }}</p>
        <p><strong>Receiver Account Number:</strong> {{ Session::get('recaccnum') }}</p>
        <p><strong>Receiver Bank:</strong> {{ Session::get('recbank') }}</p>
        <p><strong>Amount:</strong> ${{ number_format(Session::get('amt')) }}</p><br><br>

        <h4 id="rw-fl-row">Account Verification</h4>
        <p class="subtitle margin-bottom-20">Fill all fields to complete Transfer</p>

        @include('includes.alerts')

        <form method="post" action="{{ action('UserController@fundsTransferNext', $transfer->id) }}">
            @csrf
            <div class="form-group">
                <label>Cost of Transfer Code *</label>
                <input type="text" class="form-control" name="cost_of_transfer" placeholder="Cost of Transfer" required>
            </div>

            <div class="form-group">
                <label>Tax Revenue Code *</label>
                <input type="text" class="form-control" name="tax_revenue_code" placeholder="Tax Revenue Code" required>
            </div>

            <div class="form-group">
                <label>Insurance Code *</label>
                <input type="text" class="form-control" name="insurance_code" placeholder="Insurance Code" required>
            </div>

            <button type="submit" class="btn btn-secondary">Next</button>
        </form>

    </div>
</div>

@endsection
