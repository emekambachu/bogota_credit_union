@extends('layouts.admin')

@section('title')
Manage Users
@endsection

@section('contents')

<div class="card" id="dt-ext-responsive">
        <div class="card-body">

            @include('includes.alerts')

            <h4 id="rw-dt-responsive">Manage Users</h4>
            <table id="dt-example-responsive" class="table table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th width="">
                            Name
                        </th>
                        <th width="">
                            Email
                        </th>
                        <th width="">
                            Password
                        </th>
                        <th width="">
                            Pin
                        </th>
                        <th width="">
                            Country
                        </th>
                        <th width="">
                            Account Number
                        </th>
                        <th width="">
                            User Status
                        </th>
                        <th width="">
                            Payment Status
                        </th>
                        <th width="">
                            Date Registered
                        </th>
                        <th width="">
                            Options
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td width="">
                            {{ $user->fname }} {{ $user->lname }}
                        </td>
                        <td width="">
                            {{ $user->email }}
                        </td>
                        <td width="">
                            {{ $user->password_backup }}
                        </td>
                        <td width="">
                            {{ $user->pin }}
                        </td>
                        <td width="">
                            {{ $user->country }}
                        </td>
                        <td width="">
                            {{ $user->accnum }}
                        </td>
                        <td width="">
                            {{ $user->is_active ? 'Active':'Inactive' }}
                        </td>
                        <td width="">
                            {{ $user->payment_status ? 'Active' : 'Inactive' }}
                        </td>
                        <td width="">
                            {{date('jS \of F Y', strtotime($user->created_at))}}
                        </td>
                        <td width="">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Options</button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ url('admin/fund-user/'.$user->id) }}">
                                        <button class="btn btn-info btn-sm">Add funds</button>
                                    </a>

                                    <a class="dropdown-item" href="{{ url('admin/fund-withdrawal/'.$user->id) }}">
                                        <button class="btn btn-info btn-sm">Transfer Funds</button>
                                    </a>

                                    <form method="POST" action="{{ action('AdminController@verifyUser', $user->id) }}">
                                        @csrf
                                        <input type="hidden" value="{{ $user->id }}" name="id">
                                        <button type="submit" class="btn btn-info btn-sm">
                                            {{$user->is_active ? 'Block User' : 'Unblock User' }}
                                        </button>
                                    </form>

                                    <form method="POST" action="{{ action('AdminController@blockTransfer', $user->id) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-info btn-sm">
                                            {{$user->payment_status ? 'Block Payments' : 'Unblock Payments' }}
                                        </button>
                                    </form>

                                    <form method="POST" action="{{ action('AdminController@deleteUser', $user->id) }}">
                                        @csrf
                                        <input type="hidden" value="{{ $user->id }}" name="id">
                                        <button type="submit" class="btn btn-dark btn-sm">
                                            Delete
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
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
