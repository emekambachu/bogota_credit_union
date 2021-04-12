@extends('layouts.admin')

@section('title')
Dashboard
@endsection

@section('contents')
<!-- PAGE CONTENT CONTAINER -->

<div class="form-row margin-bottom-20">

    <div class="col-12 col-lg-6">
        <div class="widget widget--invert-by-parent">
            <div class="widget__icon_layer widget__icon_layer--right">
                <span class="li-users2"></span>
            </div>
            <div class="widget__container">
                <div class="widget__line">
                    <div class="widget__icon"><span class="li-users2"></span></div>
                    <div class="widget__title">Number of Users</div>
                </div>
                <div class="widget__box widget__box--left">
                    <div class="widget__informer">
                    <span class="text-bold">{{ $countUsers }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--     <div class="col-12 col-lg-3">--}}
{{--        <div class="widget widget--invert-by-parent">--}}
{{--            <div class="widget__icon_layer widget__icon_layer--right">--}}
{{--                <span class="li-users2"></span>--}}
{{--            </div>--}}
{{--            <div class="widget__container">--}}
{{--                <div class="widget__line">--}}
{{--                    <div class="widget__icon"><span class="li-users2"></span></div>--}}
{{--                    <div class="widget__title">Number of Transactions</div>--}}
{{--                </div>--}}
{{--                <div class="widget__box widget__box--left">--}}
{{--                    <div class="widget__informer"><span class="text-bold">$1,723.50</span></div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    {{-- <div class="col-12 col-lg-3">
        <div class="widget widget--invert-by-parent">
            <div class="widget__icon_layer widget__icon_layer--right">
                <span class="li-users2"></span>
            </div>
            <div class="widget__container">
                <div class="widget__line">
                    <div class="widget__icon"><span class="li-users2"></span></div>
                    <div class="widget__title">Total Transactions</div>
                </div>
                <div class="widget__box widget__box--left">
                    <div class="widget__informer"><span class="text-bold">14,355</span></div>
                </div>
            </div>
        </div>
    </div> --}}

    </div>
        <div class="card margin-bottom-0">

        <div class="card-body">
            <div class="row">
                <div class="col-9">
                    <h4>Summary</h4>
                </div>
            </div>
        </div>

        <div class="divider-text divider-text--xs">Recent Users</div>
        <div class="card-body padding-top-10">
            <div class="table-responsive">
                <table class="table table-indent-rows margin-bottom-0">
                    <tbody>
                        <tr>
                            <th width="">
                                Name
                            </th>
                            <th width="">
                                Email
                            </th>
                            <th width="">
                                Country
                            </th>
                            <th width="">
                               State
                            </th>
                            <th width="">
                                Mobile
                            </th>
                            <th width="">
                                Account Number
                            </th>
                            <th width="">
                                Account Type
                            </th>
                            <th width="">
                                Status
                            </th>
                            <th width="">
                                Date Registered
                            </th>
                        </tr>

                        @foreach ($users as $user)
                        <tr>
                            <td width="">
                                {{ $user->fname }} {{ $user->lname }}
                            </td>
                            <td width="">
                                {{ $user->email }}
                            </td>
                            <td width="">
                                {{ $user->country }}
                            </td>
                            <td width="">
                                {{ $user->state }}
                            </td>
                            <td width="">
                                {{ $user->mobile }}
                            </td>
                            <td width="">
                                {{ $user->accnum }}
                            </td>
                            <td width="">
                                {{ $user->acctype }}
                            </td>
                            <td width="">
                                {{ $user->is_active == 1 ? 'Active':'Inactive' }}
                            </td>
                            <td width="">
                                {{date('jS \of F Y', strtotime($user->created_at))}}
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

        <div class="divider-text divider-text--xs">Recent Transactions</div>
        <div class="card-body padding-top-10 padding-bottom-10">
            <div class="table-responsive">

                <table class="table table-indent-rows margin-bottom-0">
                    <tbody>
                        <tr>
                            <th width="">
                                Name
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
                            <th width="">
                                Transaction Date
                            </th>
                        </tr>

                        @if($transactions)
                        @foreach($transactions as $trans)
                        <tr>
                            <td width="">
                                {{ $trans->user ? $trans->user->fname : '' }} {{ $trans->user ? $trans->user->lname : '' }}
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
                            <td width="">
                                {{date('jS \of F Y', strtotime($trans->created_at))}}
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
                                Sender
                            </th>
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
                                Amount
                            </th>
                            <th width="">
                                COT
                            </th>
                            <th width="">
                                Insurance Code
                            </th>
                            <th width="">
                                Tax revenue Code
                            </th>
                            <th width="">
                                Description
                            </th>
                            <th width="">
                                Ref
                            </th>
                            <th width="">
                                Status
                            </th>
                            <th width="">
                                Date of Trasfer
                            </th>
                        </tr>

                        @foreach($transfers as $trans)
                        <tr>
                            <td width="">
                                {{ $trans->user ? $trans->user->fname : '' }} {{ $trans->user ? $trans->user->lname : '' }}
                            </td>
                            <td width="">
                                {{ $trans->recbank }}
                            </td>
                            <td width="">
                                {{ $trans->recaccname }}
                            </td>
                            <td width="">
                                {{ $trans->recaccnum }}
                            </td>
                            <td width="">
                                ${{ $trans->amt }}
                            </td>
                            <td width="">
                                {{ $trans->cost_of_transfer }}
                            </td>
                            <td width="">
                                {{ $trans->insurance_code }}
                            </td>
                            <td width="">
                                {{ $trans->tax_revenue_code }}
                            </td>
                            <td width="">
                                {{ $trans->description }}
                            </td>
                            <td width="">
                                {{ $trans->ref }}
                            </td>
                            <td width="">
                                {{ $trans->status }}
                            </td>
                            <td width="">
                                {{ date('jS \of F Y', strtotime($trans->created_at)) }}
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

        </div>
    </div>
<!-- //END PAGE CONTENT CONTAINER -->
@endsection

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
