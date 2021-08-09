
@extends('layouts/app')


@section('custom_css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
@endsection


@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Loan Application Fees</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Payments</a></li>
            <li class="breadcrumb-item active">Application Fees</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Application Fees
            </div>
            <div class="card-body">
                <table id="example"
                       class="table table-bordered display nowrap"  >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Applicant</th>
                            <th>Loan Package</th>
                            <th>Loan Amount</th>
                            <th>Fees Paid</th>
                            <th>Status</th>
                            <th>Paid On</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($feesPayments as $payment)
                            <tr>
                                <td>{{ $payment->id }}</td>
                                <td>{{ $payment->applicant->firstName }} {{ $payment->applicant->middleName }} {{ $payment->applicant->lastName }}</td>
                                <td>
                                    {{ $payment->package->loan }}<br>
                                    {{ $payment->sub_package->sub_loan }}
                                </td>
                                <td>{{ $payment->application->amount }} UGX</td>
                                <td><b>{{ $payment->payment->amount }} UGX</b></td>
                                <td>{{ $payment->payment->status }}</td>
                                <td>{{ $payment->payment->created_at }}</td>
                                <td>
                                    <a href="{{url("/payments/application_fees/{$payment->id}/edit")}}"
                                       class="btn btn-primary @if($payment->payment->status == "approved") disabled @endif" >Update</a>
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
                        text: '***',
                        action: function ( e, dt, node, config ) {

                        }
                    },
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
