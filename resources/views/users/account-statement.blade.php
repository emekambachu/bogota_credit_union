@extends('layouts.users')

@section('title')
Account Statement
@endsection

@section('contents')

<div class="card preloading" id="dt-ext-responsive">
        <div class="card-body">
            <h4 id="rw-dt-responsive">Account Statement</h4>
            <table id="dt-example-responsive" class="table table-bordered" cellspacing="0" width="100%">
                <thead>
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
                </thead>
                <tfoot>
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
                </tfoot>

                <tbody>
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
                            {{ number_format($trans->currbal, 0) }}
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
