@extends('layouts.users')

@section('title')
Funds Transfer
@endsection

@section('contents')

<div class="card">
    <div class="card-body">
        <h4 id="rw-fl-row">Fund Transfer</h4>
        <p class="subtitle margin-bottom-20">Fill all fields to initiate Transfer</p>

        @include('includes.alerts')

        <form method="post" action="{{ route('start.funds-transfer') }}">
            @csrf
            <div id="transfer_method" class="form-group">
                <label>Select Transfer Method *</label>
                <select name="select_method" id="select_method" class="form-control" required>
                    <option selected disabled>Select Transfer Method</option>
                    <option value="local">Local Transfer</option>
                    <option value="international">International Transfer</option>
                </select>
            </div>

            <div id="beneficiary_bank" style="display: none;" class="form-group">
                <label>Beneficiary Bank Name (Local) *</label>
                <select class="form-control" name="recbank" required>
                    <option selected disabled>Select Beneficiary Bank</option>
                    <option value="JPMorgan Chase">JPMorgan Chase</option>
                    <option value="Bank of America">Bank of America</option>
                    <option value="Citigroup">Citigroup</option>
                    <option value="Wells Fargo">Wells Fargo</option>
                    <option value="Goldman Sachs">Goldman Sachs</option>
                    <option value="Morgan Stanley">Morgan Stanley</option>
                    <option value="U.S. Bancorp">U.S. Bancorp</option>
                    <option value="Truist Financial">Truist Financial</option>
                    <option value="PNC Financial Services">PNC Financial Services</option>
                    <option value="TD Bank, N.A.">TD Bank, N.A.</option>
                    <option value="Capital One">Capital One</option>
                    <option value="The Bank of New York Mellon">The Bank of New York Mellon</option>
                    <option value="Charles Schwab Corporation">Charles Schwab Corporation</option>
                    <option value="TIAA">TIAA</option>
                    <option value="HSBC Bank USA">HSBC Bank USA</option>
                    <option value="State Street Corporation">State Street Corporation</option>
                    <option value="American Express">American Express</option>
                    <option value="Ally Financial">Ally Financial</option>
                    <option value="MUFG Union Bank">MUFG Union Bank</option>
                    <option value="Fifth Third Bank">Fifth Third Bank</option>
                    <option value="State Farm">State Farm</option>
                    <option value="USAA">USAA</option>
                    <option value="Citizens Financial Group">Citizens Financial Group</option>
                    <option value="Bank of the west">Bank of the west</option>
                    <option value="Huntington Bank">Huntington Bank</option>
                    <option value="Sun Trust Ban">Sun Trust Ban</option>
                    <option value="Woodforest National Bank">Woodforest National Bank</option>
                    <option value="BBVA Compass">BBVA Compass</option>
                    <option value="BMO Harris Bank">BMO Harris Bank</option>
                    <option value="MUFG Union Bank">MUFG Union Bank</option>
                    <option value="Valley National Bank">Valley National Bank</option>
                </select>
            </div>

            <div id="bank_name_international" style="display: none;" class="form-group">
                <label>Beneficiary Bank Name (International) *</label>
                <input type="text" class="form-control" name="recbank"
                       placeholder="Beneficiary Bank Name (International)" required>
            </div>

            <div class="form-group">
                <label>Beneficiary Name *</label>
                <input type="text" class="form-control" name="recaccname"
                       placeholder="Beneficiary Name" required>
            </div>

            <div class="form-group">
                <label>Beneficiary Account Number *</label>
                <input type="number" class="form-control" name="recaccnum"
                       placeholder="Beneficiary Account Number" required>
            </div>

            <div class="form-group">
                <label>Routing / Swift Code *</label>
                <input type="text" class="form-control" name="routing"
                       placeholder="Routing / ABA Number" required>
            </div>

            <div class="form-group">
                <label>Amount to Transfer *</label>
                <input type="number" class="form-control" name="amount"
                       placeholder="Amount to Transfer USD$" required>
            </div>

            <div class="form-group">
                <label>Select Currency *</label>
                <select name="currency" class="form-control" required>
                    <option value="USD">USD</option>
                    <option value="GBP">GBP</option>
                    <option value="GBP">EURO</option>
                    <option value="GBP">RUPEES</option>
                </select>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" name="description"></textarea>
            </div>

            <button type="submit" class="btn btn-secondary">Next</button>
        </form>

    </div>
</div>
@endsection

@section('page-scripts')
    <script>
        $(document).ready(function(){
            // on div change (the selection field is inside the transfer_method div)
            $('#transfer_method').on('change', function() {

                // assign variable to the selected value of select_method id
                let selected = $('#select_method').find(":selected").val()

                if(selected === "local") {

                    // Show show these divs
                    $("#beneficiary_bank").show();

                    // Enable these fields
                    $("#beneficiary_bank :input").prop("disabled", false);

                    // Hide Div
                    $("#bank_name_international").hide();

                    // Disable Field
                    $("#bank_name_international :input").prop("disabled", true);

                }else if(selected === "international"){

                    // Show these divs
                    $("#bank_name_international").show();

                    // Enable these fields
                    $("#bank_name_international :input").prop("disabled", false);

                    // Hide these divs
                    $("#beneficiary_bank").hide();

                    // Disable these fields
                    $("#beneficiary_bank :input").prop("disabled", true);
                }
            });
        });
    </script>
@endsection
