
@extends('layouts.users')

@section('title')
    Airtime and Bills
@endsection

@section('contents')

    <div class="card">
        <div class="card-body">
            <h4 id="rw-fl-row">Airtime and Bills</h4>

            @include('includes.alerts')

            <form method="" action="">
                @csrf
                <div class="form-group">
                    <label>Select Category</label>
                    <select name="category" class="form-control" required>
                        <option value="">Mobile Top-up</option>
                        <option value="">Data Bundle</option>
                        <option value="">Cable TV</option>
                        <option value="">Insurance</option>
                        <option value="">Visa Fee</option>
                        <option value="">Taxes</option>
                        <option value="">Airline Tickets</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-secondary">Next</button>
            </form>

        </div>
    </div>

@endsection
