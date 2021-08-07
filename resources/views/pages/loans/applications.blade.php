
@extends('layouts/app')


@section('custom_css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
@endsection


@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Loan Applications</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Loans</a></li>
            <li class="breadcrumb-item active">Applications</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                List of all applications
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Loan Applications
            </div>
            <div class="card-body">
                <table id="example"
                    class="table table-bordered display nowrap"  >
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Application ID.</th>
                            <th>Names</th>
                            <th>Loan</th>
                            <th>Sub Package</th>
                            <th>Amount</th>
                            <th>Repayment Plan</th>
                            <th>Repayment Plan Days</th>
                            <th>Status</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($applications as $application)
                            <tr>
                                <td>{{ $application->id }}</td>
                                <td>{{ $application->application_id }}</td>
                                <td>{{ $application->user->firstName }} {{ $application->user->middleName }} {{ $application->user->lastName }}</td>
                                <td>{{ $application->loan_package->loan }}</td>
                                <td>{{ $application->loan_sub_package->sub_loan }}</td>
                                <td>{{ $application->amount }}</td>
                                <td>{{ $application->loanRepaymentPlan }}</td>
                                <td>{{ $application->loanRepaymentPlanDays }}</td>
                                <td>{{ $application->loan_status }}</td>

                                <td>{{ $application->created_at }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


@section('custom_scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script>
        var table;
        $(function() {
            table = $('#example').DataTable({
                dom: 'Bfrtip',
                "scrollX": true,
                "buttons": [
                    {
                        text: 'Review & Action',
                        action: function ( e, dt, node, config ) {
                            let row = $('#example').DataTable().row('.selected').data();
                            let idtodelete = row[0];
                            window.location.href='/loans/applications/review/'+row[0]
                        }
                    },
                    {
                        text: 'Preview',
                        action: function ( e, dt, node, config ) {
                            let row = $('#example').DataTable().row('.selected').data();
                            let idtodelete = row[0];
                            window.location.href='/loans/applications/preview/'+row[0]
                        }
                    },
                    {
                        text: 'Excel',
                        action: function ( e, dt, node, config ) {
                            alert( 'Button activated' );
                        }
                    }
                ]
            } );


            $('#example tbody').on( 'click', 'tr', function () {
                if ( $(this).hasClass('selected') ) {
                    $(this).removeClass('selected');
                }
                else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            } );

            // $('#button').click( function () {
            //     table.row('.selected').remove().draw( false );
            // } );


        } );
    </script>
@endsection
