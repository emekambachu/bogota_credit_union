
@extends('layouts.users')

@section('title')
    Sports and Gaming
@endsection

@section('contents')

    <div class="card">
        <div class="card-body">
            <h4 id="rw-fl-row">Sports and Gaming</h4>

            @include('includes.alerts')

            <form method="" action="">
                @csrf
                <div class="form-group">
                    <label>Select Merchant</label>
                    <select name="category" class="form-control" required>
                        <option value="">Sporty Bet</option>
                        <option value="">Bet United</option>
                        <option value="">Western Bet</option>
                        <option value="">Billions Bet United</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-secondary">Next</button>
            </form>

        </div>
    </div>

@endsection
