
@extends('layouts/app')


@section('custom_css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
@endsection


@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Subscription Packages</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Subscription</a></li>
            <li class="breadcrumb-item active">Packages</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                This retrieves all system admins that can access the dashboard
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Packages
            </div>
            <div class="card-body">
                <table id="example" 
                    class="table table-bordered display nowrap"  >
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Period</th>
                            <th>Amount</th>
                            <th>Benefits</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($subscriptionpackages as $package)
                            <tr>
                                <td>{{ $package->id }}</td>
                                <td>{{ $package->name }}</td>
                                <td>{{ $package->period }}</td>
                                <td>{{ $package->amount }}</td>
                                <td>{{ $package->benefits }}</td>
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
                        text: 'New',
                        action: function ( e, dt, node, config ) {
                            window.location.href='/subscription/new_subscription_package'
                        }
                    },
                    {
                        text: 'Edit',
                        action: function ( e, dt, node, config ) {
                            let row = $('#example').DataTable().row('.selected').data();
                            let idtodelete = row[0];
                            window.location.href='/subscription/edit_subscription_package/'+row[0]
                        }
                    },
                    {
                        text: 'Delete',
                        action: function ( e, dt, node, config ) {
                            // alert( 'Button activated' );
                            let row = $('#example').DataTable().row('.selected').data();
                            let idtodelete = row[0];
                            window.location.href='/subscription/delete_subscription_package/'+row[0]
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