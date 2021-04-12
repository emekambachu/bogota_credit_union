
@extends('layouts.users')

@section('title')
    Credit Card Payments
@endsection

@section('contents')

    <div class="card">
        <div class="card-body">
            <h4 id="rw-fl-row">Credit Card Payments</h4>

            @include('includes.alerts')

            <form method="" action="">
                @csrf
                <div class="form-group">
                    <label>Select Card Type</label>
                    <select name="card-type" class="form-control" required>
                        <option value="">Mastercard</option>
                        <option value="">Verve</option>
                        <option value="">Visa</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Select Account Type</label>
                    <select name="account-type" class="form-control" required>
                        <option value="">Personal Account</option>
                        <option value="">Corporate Account</option>
                        <option value="">Student Account</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Fund Card USD$ *</label>
                    <input type="number" class="form-control" name="amt" placeholder="Amount to Transfer USD$" required>
                </div>

                <button type="submit" class="btn btn-secondary">Next</button>
            </form>

        </div>
    </div>

@endsection
