@extends('layouts.admin')

@section('title')
All Transfers
@endsection

@section('contents')

<div class="card" id="dt-ext-responsive">
        <div class="card-body">
            <h4 id="rw-dt-responsive">All Transfers</h4>
            <table id="dt-example-responsive" class="table table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th width="">
                            Name
                        </th>
                        <th width="">
                            Receiver
                        </th>
                        <th width="">
                            Amount
                        </th>
                        <th width="">
                            Currency Conversion
                        </th>
                        <th width="">
                            Cost of Transfer
                        </th>
                        <th width="">
                            Tax  Revenue
                        </th>
                        <th width="">
                            Ref
                        </th>
                        <th width="">
                            OTP
                        </th>
                        <th width="">
                            Status
                        </th>
                        <th width="">
                            Date
                        </th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th width="">
                            Name
                        </th>
                        <th width="">
                            Receiver
                        </th>
                        <th width="">
                            Amount
                        </th>
                        <th width="">
                            Currency Conversion
                        </th>
                        <th width="">
                            Cost of Transfer
                        </th>
                        <th width="">
                            Tax  Revenue
                        </th>
                        <th width="">
                            Ref
                        </th>
                        <th width="">
                            OTP
                        </th>
                        <th width="">
                            Status
                        </th>
                        <th width="">
                            Date
                        </th>
                    </tr>
                </tfoot>

                <tbody>
                    @if($transfers)
                    @foreach($transfers as $trans)
                    <tr>
                        <td width="">
                            {{ $trans->user ? $trans->user->fname .' '. $trans->user->fname : '' }}
                        </td>
                        <td width="">
                            {{ $trans->recbank }}<br>
                            {{ $trans->recaccname }}<br>
                            {{ $trans->recaccnum }}
                        </td>
                        <td width="">
                            ${{ $trans->amt }}
                        </td>
                        <td width="">
                            {{ $trans->currency_conversion }}<br>
                            {{ $trans->currency_conversion_charge }}
                        </td>
                        <td width="">
                            {{ $trans->cost_of_transfer }}<br>
                            {{ $trans->cost_of_transfer_charge }}
                        </td>
                        <td width="">
                            {{ $trans->tax_revenue }}<br>
                            {{ $trans->tax_revenue_charge }}
                        </td>
                        <td width="">
                            {{ $trans->ref }}
                        </td>
                        <td width="">
                            {{ $trans->otp }}
                        </td>
                        <td width="">
                            {{ $trans->status }}
                        </td>
                        <td width="">
                            {{date('jS \of F Y', strtotime($trans->created_at))}}
                        </td>
                    </tr>
                    @endforeach
                    @endif

                </tbody>
            </table>

            <script type="text/javascript">
                document.addEventListener("DOMContentLoaded", function() {
                    app._loading.show($("#dt-ext-responsive"), {
                        spinner: true
                    });
                    $("#dt-example-responsive").DataTable({
                        "responsive": true,
                        "initComplete": function(settings, json) {
                            setTimeout(function() {
                                app._loading.hide($("#dt-ext-responsive"));
                            }, 1000);
                        }
                    });
                });
            </script>

        </div>
    </div>

@endsection

@section('page-scripts')
<!-- THIS PAGE SCRIPTS ONLY -->
<script type="text/javascript" src="{{ asset('auth/js/vendors/datatables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('auth/js/vendors/datatables/extensions/dataTables.responsive.min.js') }}"></script>
<!-- //END THIS PAGE SCRIPTS ONLY -->
@endsection
