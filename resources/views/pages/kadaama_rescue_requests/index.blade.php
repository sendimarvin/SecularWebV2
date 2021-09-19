
@extends('layouts/app')


@section('custom_css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
@endsection


@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Kadaama Rescue Requests</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Kadaama</a></li>
            <li class="breadcrumb-item active">Rescue Requests</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Kadaama Rescue Requests
            </div>
            <div class="card-body">
                <table id="example"
                    class="table table-bordered display nowrap"  >
                    <thead>
                        <tr>
                            <th>#.</th>
                            <th>Applicant Names.</th>
                            <th>Reason</th>
                            <th>Narration</th>
                            <th>Entry Date</th>

                            <th>Created At</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($requests as $request)
                            <tr>
                                <td>{{ $request->id }}</td>
                                <td>{{$request->applicant->firstName}} {{$request->applicant->middleName}} {{$request->applicant->lastName}}</td>

                                <td>{{ $request->reason }}</td>
                                <td>{{ $request->narration }}</td>
                                <td>{{ $request->entry_date }}</td>
                                <td>{{ $request->created_at }}</td>
                                <td>{{ $request->status }}</td>
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
                "buttons": [
                    {
                        text: 'Review Record',
                        action: function ( e, dt, node, config ) {
                            let row = $('#example').DataTable().row('.selected').data();
                            let idtodelete = row[0];
                            window.location.href='/kadaama/rescue_requests/'+row[0]
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
