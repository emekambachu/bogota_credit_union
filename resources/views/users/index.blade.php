@extends('layouts.users')

@section('title')
Dashboard
@stop

@section('contents')
<!-- PAGE CONTENT CONTAINER -->

<div class="form-row margin-bottom-20">

        <div class="col-12 col-lg-4 bg-gradient-1">
            <div class="widget widget--invert-by-parent">
                <div class="widget__icon_layer widget__icon_layer--right">
                    <span class="li-cash-dollar"></span></div>
                <div class="widget__container">

                    <div class="widget__line">
                        <div class="widget__icon">
                            <span class="li-cash-dollar"></span>
                        </div>
                        <div class="widget__title">Account Number</div>
                    </div>

                    <div class="widget__line">
                        <div class="widget__icon">
                        </div>
                        <div class="widget__title">
                            <h2>{{ Auth::user()->accnum }}</h2>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    <div class="col-12 col-lg-4 bg-gradient-1">
        <div class="widget widget--invert-by-parent">
            <div class="widget__icon_layer widget__icon_layer--right">
                <span class="li-cash-dollar"></span></div>
            <div class="widget__container">

                <div class="widget__line">
                    <div class="widget__icon">
                        <span class="li-cash-dollar"></span>
                    </div>
                    <div class="widget__title">Account Type</div>
                </div>

                <div class="widget__line">
                    <div class="widget__icon">
                    </div>
                    <div class="widget__title">
                        <h2>{{ Auth::user()->acctype }}</h2>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-12 col-lg-4 bg-gradient-1">
        <div class="widget widget--invert-by-parent">
            <div class="widget__icon_layer widget__icon_layer--right">
                <span class="li-cash-dollar"></span></div>
            <div class="widget__container">

                <div class="widget__line">
                    <div class="widget__icon">
                        <span class="li-cash-dollar"></span>
                    </div>
                    <div class="widget__title">Account Balance</div>
                </div>

                <div class="widget__line">
                    <div class="widget__icon">
                    </div>
                    <div class="widget__title">
                        <h2>${{ number_format(Auth::user()->accbal, 0) }}</h2>
                    </div>
                </div>

            </div>
        </div>
    </div>

        </div>

        <div class="form-row">
            <div class="col-12 col-xl-12">
                <div class="card card-inner-container--up margin-bottom-20" id="dashboard-orders-card">
                    <div class="card-body">
                        <div class="card-inner-container card-inner-container card-inner-container--light">
                            <div class="form-row">
                                <div class="col-8 col-md-6">
                                    <h4>Transaction Summary</h4>
                                </div>

                                <div class="col-4 col-md-6">
                                    <button class="btn btn-light d-none d-md-block float-right margin-right-5" id="dashboard-rp-customrange">Custom range</button>
                                </div>
                            </div>
                        </div>
                        <div id="dashboard-ec-line" style="width: 100%; height: 350px; overflow-x: hidden"></div>
                    </div>
                </div>
            </div>

{{--            <div class="col-12 col-xl-4">--}}
{{--                <div class="card card-inner-container--up margin-bottom-20" id="dashboard-budget-card">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="card-inner-container card-inner-container card-inner-container--light">--}}
{{--                            <div class="form-row">--}}
{{--                                <div class="col-9">--}}
{{--                                    <h4>Budget allocation</h4>--}}
{{--                                    <p class="subtitle">Actual for 01/18 - 05/18</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div id="dashboard-ec-radar" style="width: 100%; height: 350px; overflow-x: hidden"></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

        </div>

        <div class="card margin-bottom-0">

            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <h4>Transaction Summary</h4>
                    </div>
                </div>
            </div>

            <div class="divider-text divider-text--xs">Recent Transactions</div>
            <div class="card-body padding-top-10 padding-bottom-10">
                <div class="table-responsive">

                    <table class="table table-indent-rows margin-bottom-0">
                        <tbody>
                            <tr>
                                <th width="">
                                    Transaction Date
                                </th>
                                <th width="">
                                    Reference Number
                                </th>
                                <th width="">
                                    Description
                                </th>
                                <th width="">
                                    Credit Balance
                                </th>
                                <th width="">
                                    Debit
                                </th>
                                <th width="">
                                    Credit
                                </th>
                            </tr>

                            @if($transactions)
                            @foreach($transactions as $trans)
                            <tr>
                                <td width="">
                                    {{date('jS \of F Y', strtotime($trans->created_at))}}
                                </td>
                                <td width="">
                                    {{ $trans->ref }}
                                </td>
                                <td width="">
                                    {{ $trans->description }}
                                </td>
                                <td width="">
                                    ${{ number_format($trans->currbal, 0) }}
                                </td>
                                <td width="">
                                    {{ !empty($trans->debit) ? '$'.number_format($trans->debit, 0):'' }}
                                </td>
                                <td width="">
                                    {{ !empty($trans->credit) ? '$'.number_format($trans->credit, 0):'' }}
                                </td>
                            </tr>
                            @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="divider-text divider-text--xs">Recent Transfers</div>
            <div class="card-body padding-top-10">
                <div class="table-responsive">
                    <table class="table table-indent-rows margin-bottom-0">
                        <tbody>
                            <tr>
                                <th width="">
                                    Receiving Bank
                                </th>
                                <th width="">
                                    Receiver
                                </th>
                                <th width="">
                                    Receiver Account Number
                                </th>
                                <th width="">
                                    Swift
                                </th>
                                <th width="">
                                    Amount
                                </th>
                                <th width="">
                                    Transaction Type
                                </th>
                                <th width="">
                                    Description
                                </th>
                                <th width="">
                                    Ref
                                </th>
                            </tr>

                            <tr>
                                <td width="">
                                    Receiving Bank
                                </td>
                                <td width="">
                                    Receiver
                                </td>
                                <td width="">
                                    Receiver Account Number
                                </td>
                                <td width="">
                                    Swift
                                </td>
                                <td width="">
                                    Amount
                                </td>
                                <td width="">
                                    Transaction Type
                                </td>
                                <td width="">
                                    Description
                                </td>
                                <td width="">
                                    Ref
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
<!-- //END PAGE CONTENT CONTAINER -->
@stop

@section('page-scripts')
<!-- THIS PAGE SCRIPTS ONLY -->
<script type="text/javascript" src="{{ asset('auth/js/vendors/moment/moment-with-locales.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('auth/js/vendors/echarts/echarts.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('auth/js/vendors/select2/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('auth/js/vendors/daterangepicker/daterangepicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('auth/js/vendors/raty/jquery.raty.js') }}"></script>
<!-- //END THIS PAGE SCRIPTS ONLY -->

<!-- THIS PAGE DEMO -->
<script type="text/javascript" src="{{ asset('auth/js/demo_dashboard.js') }}"></script>
<!-- //THIS PAGE DEMO -->
@endsection
