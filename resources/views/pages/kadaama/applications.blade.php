
@extends('layouts/app')


@section('custom_css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
@endsection


@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Kadaama Applications</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Kadaama</a></li>
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
                Kadaama Applications
            </div>
            <div class="card-body">
                <table id="example"
                    class="table table-bordered display nowrap"  >
                    <thead>
                        <tr>
                            <th>#.</th>
                            <th>User Id.</th>
                            <th>Country</th>

                            <th>Work Type</th>
                            <th>Work Address</th>

                            <th>Duration(years)</th>
                            <th>Start Date</th>
                            <th>End Date</th>

                            <th>How often Are you Paid</th>
                            <th>How much Are you Paid</th>

                            <th>Taker Type</th>
                            <th>Taker Name</th>
                            <th>Taker Contact</th>

                            <th>NOK Relation</th>
                            <th>NOK Name</th>
                            <th>NOK Contact</th>

                            <th>Status</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($kadaama_applications as $application)
                            <tr>
                                <td>{{ $application->id }}</td>
                                <td>{{ $application->user_id }}</td>
                                <td>{{ $application->country }}</td>
                                <td>{{ $application->work_type }}</td>
                                <td>{{ $application->work_address }}</td>
                                <td>{{ $application->duration }}</td>
                                <td>{{ $application->start_date }}</td>
                                <td>{{ $application->end_date }}</td>
                                <td>{{ $application->how_often_paid }}</td>
                                <td>{{ $application->how_much_paid }}</td>
                                <td>{{ $application->taker_type }}</td>
                                <td>{{ $application->taker_name }}</td>
                                <td>{{ $application->taker_contact }}</td>
                                <td>{{ $application->nok_relation }}</td>
                                <td>{{ $application->nok_name }}</td>
                                <td>{{ $application->nok_contact }}</td>
                                <td>{{ $application->status }}</td>
                                <td>{{ $application->created_at }}</td>
                                <td>{{ $application->updated_at }}</td>
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
                            window.location.href='/loan_applications/review_loan/'+row[0]
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



        } );
    </script>
@endsection
