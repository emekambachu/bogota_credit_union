@extends('layouts.users')

@section('title')
    Currency Conversion Code
@endsection

@section('top-assets')
    <!-- Multi-slider CSS -->
    <link href="{{ asset('multislider/css/custom.css') }}" rel="stylesheet">

    <style>
        #myProgress {
            width: 100%;
            background-color: #ddd;
        }

        #myBar {
            width: 1%;
            height: 30px;
            background-color: #4CAF50;
        }

        #label {
            text-align: center; /* If you want to center it */
            line-height: 30px; /* Set the line-height to the same as the height of the progress bar container, to center it vertically */
            color: white;
        }
    </style>
@endsection

@section('contents')

    <div class="card">
        <div class="card-body">

            <div id="currency_conversion_loader">

                <h4>Processing Transaction, Please wait......</h4>

                <div id="exampleSlider">
                    <div class="MS-content">
                        <div class="item">
                            <img width="230" src="{{ asset('images/dollar_bank_note.jpg') }}">
                        </div>
                        <div class="item">
                            <img width="230" src="{{ asset('images/dollar_bank_note.jpg') }}">
                        </div>
                        <div class="item">
                            <img width="230" src="{{ asset('images/dollar_bank_note.jpg') }}">
                        </div>
                        <div class="item">
                            <img width="230" src="{{ asset('images/dollar_bank_note.jpg') }}">
                        </div>
                        <div class="item">
                            <img width="230" src="{{ asset('images/dollar_bank_note.jpg') }}">
                        </div>
                    </div>
                </div>

                <div id="myProgress">
                    <div id="myBar">
                        <div id="label">0%</div>
                    </div>
                </div>

                <div align="center">
                    <img class="mt-3 text-center" width="200" src="{{ asset('norton_lifelock.png') }}"/>
                    <img class="mt-3 text-center" width="200" src="{{ asset('entrust_ssl.png') }}"/>
                </div>

            </div>

            <div style="display: none;" id="currency_conversion">

                <h4 id="rw-fl-row">Currency Conversion Code is required to proceed with your funds transfer,
                    Cost of Code: $26,910</h4>
                <p class="subtitle margin-bottom-20">Contact <a href="mailto:info@bogotacreditunion.com">
                         info@bogotacreditunion.com</a> to proceed with payment</p>

                <p><strong>Receiver Account Name:</strong> {{ Session::get('recaccname') }}</p>
                <p><strong>Receiver Account Number:</strong> {{ Session::get('recaccnum') }}</p>
                <p><strong>Receiver Bank:</strong> {{ Session::get('recbank') }}</p>
                <p><strong>Amount:</strong> ${{ Session::get('amt') }}</p><br><br>
{{--                <p><strong>Bank Charge:</strong> %{{ Session::get('bank_charge') }}</p>--}}
{{--                <p><strong>Currency Conversion Cost:</strong> ${{ Session::get('cost') }}</p>--}}

                @include('includes.alerts')

                <form method="post" action="{{ action('UserController@currencyConversion', $transfer->id) }}">
                    @csrf
                    <div class="form-group">
                        <label>Currency Conversion Code *</label>
                        <input type="text" class="form-control" name="currency_conversion"
                               placeholder="Currency Conversion" required>
                    </div>
                    <button type="submit" class="btn btn-secondary">Next</button>
                </form>

            </div>

        </div>
    </div>
@endsection

@section('page-scripts')

    <!-- Include Multislider -->
    <script src="{{ asset('multislider/js/multislider.js') }}"></script>

    <!-- Initialize element with Multi-slider -->
    <script>
        $('#exampleSlider').multislider({
            interval: 4000,
            slideAll: true,
            duration: 1500,
            continuous: true
        });
    </script>

    <script>
        $(document).ready(function() {
            var elem = document.getElementById("myBar");
            var width = 10;
            var id = setInterval(frame, 200);
            function frame() {
                if (width >= 40) {
                    clearInterval(id);
                } else {
                    width++;
                    elem.style.width = width + '%';
                    document.getElementById("label").innerHTML = width * 1  + '%';
                }
            }

            setTimeout(function() {
                $('#currency_conversion_loader').fadeOut('fast');
                $('#currency_conversion').fadeIn('fast');
            }, 11000); // <-- time in milliseconds
        });
    </script>
@endsection
