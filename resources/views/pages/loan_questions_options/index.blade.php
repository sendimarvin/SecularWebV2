
@extends('layouts/app')


@section('custom_css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
@endsection


@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Loan Questions Options</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Loans</a></li>
            <li class="breadcrumb-item active">Applications</li>
        </ol>

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
                            <th>#</th>
                            <th>Question</th>
                            <th>Option</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($list as $options)
                            <tr>
                                <td>{{ $options->id }}</td>
                                <td>{{ $options->question->question }}</td>
                                <td>{{ $options->option_name }}</td>
                                <td>
                                    <a href="{{url("/question/options/{$options->id}/edit")}}" class="btn btn-primary" >Update</a>
                                    <a href="{{url("/question/options/{$options->id}/delete")}}" class="btn btn-danger" >Delete</a>
                                </td>
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
                        text: 'Add Loan Question Option',
                        action: function ( e, dt, node, config ) {
                            window.location.href='/question/options/create'
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
