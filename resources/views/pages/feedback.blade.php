
@extends('layouts/app')


@section('custom_css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
@endsection


@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Feedback</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Feedback</a></li>
            <li class="breadcrumb-item active">Feedback</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                List of all application Feedbacks
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Feedbacks
            </div>
            <div class="card-body">
                <table id="example" 
                    class="table table-bordered display nowrap"  >
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Rating Title</th>
                            <th>Rating</th>
                            <th>Comment</th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Posted At</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($feedbacks as $feedback)
                            <tr>
                                <td>{{ $feedback->id }}</td>
                                <td>{{ $feedback->rating_title }}</td>
                                <td>{{ $feedback->rating }}</td>
                                <td>{{ $feedback->comment }}</td>
                                <td>{{ $feedback->firstName }} {{ $feedback->middleName }} {{ $feedback->lastName }}</td>
                                <td>{{ $feedback->phoneNumber }}</td>
                                <td>{{ $feedback->created_at }}</td>
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
                // "scrollX": true,
                "buttons": [
                    // {
                    //     text: 'New',
                    //     action: function ( e, dt, node, config ) {
                    //         window.location.href='/events/new_event'
                    //     }
                    // },
                    // {
                    //     text: 'Edit',
                    //     action: function ( e, dt, node, config ) {
                    //         let row = $('#example').DataTable().row('.selected').data();
                    //         let idtodelete = row[0];
                    //         window.location.href='/events/edit_event/'+row[0]
                    //     }
                    // },
                    // {
                    //     text: 'Delete',
                    //     action: function ( e, dt, node, config ) {
                    //         // alert( 'Button activated' );
                    //         let row = $('#example').DataTable().row('.selected').data();
                    //         let idtodelete = row[0];
                    //         window.location.href='/events/delete_event/'+row[0]
                    //     }
                    // },
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