
@extends('layouts/app')


@section('custom_css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
@endsection


@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Events</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active">Events</li>
        </ol>

        <div class="row">

            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Event
                    </div>
                    <div class="card-body row">
                        <div class="col-5">
                            <p><b>Title :</b><br>{{$event->title}} </p>
                            <p><b>Start Date :</b> {{$event->start_date}} </p>
                            <p><b>Start Time :</b> {{$event->start_time}} </p>
                            <p><b>End Date :</b> {{$event->end_date}} </p>
                            <p><b>End Time :</b> {{$event->end_time}} </p>
                            <p><b>Location :</b><br>{{$event->location}} </p>
                            <p><b>Attendance Fee :</b><br>{{$event->attendance_fee}} </p>
                        </div>
                        <div class="col-7">
                            <img class="img-thumbnail"
                                 style="height: 200px;"
                                 src="{{env("IMAGES_URL").$event->picture}}"/>
                            <p class="mt-2"><b>About :</b><br>{{$event->about}} </p>

                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Ticket Payments
                    </div>
                    <div class="card-body">
                        <table id="example"
                               class="table table-bordered display nowrap"  >
                            <thead>
                            <tr>
                                <th>Ticket No.</th>
                                <th>Person</th>
                                <th>Number of People</th>

                                <th>Amount</th>
                                <th>Status</th>
                                <th>Payment Date</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($events_tickets as $events_ticket)
                                <tr>
                                    <td>{{ $events_ticket->id }}</td>
                                    @if($events_ticket->applicant == null)
                                    <td>NONE</td>
                                    @else
                                    <td>{{ $events_ticket->applicant->firstName }} {{ $events_ticket->applicant->middleName }} {{ $events_ticket->applicant->lastName }}</td>
                                    @endif

                                    <td>{{ $events_ticket->number_of_people }}</td>
                                    <td>{{ $events_ticket->payment->amount }}</td>
                                    <td>{{ $events_ticket->status }}</td>
                                    <td>{{ $events_ticket->created_at }}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection


@section('custom_scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script>
        $(function() {
            $('#example').DataTable({
                dom: 'Bfrtip',
                "buttons": [
                    {
                        text: 'CSV',
                        action: function ( e, dt, node, config ) {
                            alert( 'Button activated' );
                        }
                    },
                ]
            } );
        } );
    </script>
@endsection
