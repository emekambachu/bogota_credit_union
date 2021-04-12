@extends('layouts.users')

@section('title')
OTP
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

            <p><strong>Receiver Account Name:</strong> {{ Session::get('recaccname') }}</p>
            <p><strong>Receiver Account Number:</strong> {{ Session::get('recaccnum') }}</p>
            <p><strong>Receiver Bank:</strong> {{ Session::get('recbank') }}</p>
            <p><strong>Amount:</strong> ${{ number_format(Session::get('amt')) }}</p><br><br>

            <h4 id="rw-fl-row">OTP</h4>
            <p class="subtitle margin-bottom-20">Insert the OTP sent to your email to complete the transfer</p>

            @include('includes.alerts')

            <form method="post" action="{{ action('UserController@fundsTransferOtp', $transfer->id) }}">
                @csrf
                <div class="form-group">
                    <label>OTP *</label>
                    <input type="text" class="form-control" name="otp" placeholder="OTP" required>
                </div>

                <button type="submit" class="btn btn-secondary">Complete</button>
            </form>
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
                if (width >= 83) {
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
