@extends('layouts.users')

@section('title')
Transaction Complete
@endsection

@section('top-assets')
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

        <div id="loader">
            <h4>Processing Transaction, Please wait......</h4>
            <div id="myProgress">
                <div id="myBar">
                    <div id="label">0%</div>
                </div>
            </div>
        </div>

        <div align="center">
            <img class="mt-3 text-center" width="200" src="{{ asset('norton_lifelock.png') }}"/>
            <img class="mt-3 text-center" width="200" src="{{ asset('entrust_ssl.png') }}"/>
        </div>

        <div style="display: none;" id="contents">
            <span class="fa fa-check fa-5x"></span>

            <h2 style="color:#32CD32;" id="rw-fl-row">Transaction Complete</h2>

            <p><strong>Receiver Account Name:</strong> {{ Session::get('recaccname') }}</p>
            <p><strong>Receiver Account Number:</strong> {{ Session::get('recaccnum') }}</p>
            <p><strong>Receiver Bank:</strong> {{ Session::get('recbank') }}</p>
            <p><strong>Amount:</strong> ${{ number_format(Session::get('amt')) }}</p>
            <p><strong>Transfer Method:</strong> {{ Session::get('select_method') }}</p>
            <p><strong>Description:</strong> {{ Session::get('description') }}</p><br><br>
        </div>

    </div>
</div>

@endsection

@section('page-scripts')
    <script>
        $(document).ready(function() {
            let elem = document.getElementById("myBar");
            let width = 10;
            let id = setInterval(frame, 200);
            function frame() {
                if (width >= 100) {
                    clearInterval(id);
                } else {
                    width++;
                    elem.style.width = width + '%';
                    document.getElementById("label").innerHTML = width * 1  + '%';
                }
            }

            setTimeout(function() {
                $('#loader').fadeOut('fast');
                $('#contents').fadeIn('fast');
            }, 11000); // <-- time in milliseconds
        });
    </script>
@endsection
