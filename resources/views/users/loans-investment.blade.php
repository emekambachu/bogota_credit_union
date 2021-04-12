
@extends('layouts.users')

@section('title')
    Loans and Investments
@endsection

@section('contents')

    <div class="card">
        <div class="card-body">
            <h4 id="rw-fl-row">Loans and Investments</h4>

            @include('includes.alerts')

            <form method="" action="">
                @csrf
                <div class="form-group">
                    <label>Select Category</label>
                    <select name="category" class="form-control" required>
                        <option value="">Loans</option>
                        <option value="">Investments</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Amount to Transfer USD$ *</label>
                    <input type="number" class="form-control" name="amt" placeholder="Amount to Transfer USD$" required>
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description" required></textarea>
                </div>

                <button type="submit" class="btn btn-secondary">Next</button>
            </form>

        </div>
    </div>

@endsection
