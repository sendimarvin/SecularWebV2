
@extends('layouts/app')


@section('custom_css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
@endsection


@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Disbursments</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Disbursments</a></li>
            <li class="breadcrumb-item active">Disbursments</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                List of all Disbursments
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Disbursments
            </div>
            <div class="card-body">
                {{-- <table id="example" 
                    class="table table-bordered display nowrap"  >
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Subscription</th>
                            <th>Payment Method</th>
                            <th>Provider</th>
                            <th>Date</th>
                            <th>Title</th>
                            <th>Amount</th>
                            <th>Payment Ref</th>
                            <th>Names</th>
                            <th>Contact</th>
                            <th>Status</th>
                            <th>Expires at</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($subscriptions as $subscription)
                            <tr>
                                <td>{{ $subscription->id }}</td>
                                <td>{{ $subscription->name }}</td>
                                <td>{{ $subscription->paymentOption }}</td>
                                <td>{{ $subscription->paymentProvider }}</td>
                                <td>{{ $subscription->payment_date }}</td>
                                <td>{{ $subscription->title }}</td>
                                <td>{{ $subscription->amount }}</td>
                                <td>{{ $subscription->payment_ref }}</td>
                                <td>{{ $subscription->firstName }} {{ $subscription->middleName }} {{ $subscription->lastName }}</td>
                                <td>{{ $subscription->phoneNumber }}</td>
                                <td>{{ $subscription->payment_status }}</td>
                                <td>{{ $subscription->expiry_date }}</td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table> --}}
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
                        text: 'Update Status',
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