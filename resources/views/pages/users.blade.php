
@extends('layouts/app')


@section('custom_css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
@endsection


@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Users</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Dasboads</a></li>
            <li class="breadcrumb-item active">Users</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                This retrieves all application users that are in the system
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Application users
            </div>
            <div class="card-body">
                <table id="example" 
                    {{-- class="table table-striped  table-hover table-condensed"  > --}}
                    class="table table-bordered display nowrap"  >
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>First&nbsp;Name</th>
                            <th>Last&nbsp;Name</th>
                            <th>Middle&nbsp;Name</th>
                            <th>Phone&nbsp;Number</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Date&nbsp;of&nbsp;Birth</th>
                            <th>Card&nbsp;Type</th>
                            <th>Card&nbsp;No.</th>
                            <th>Marital&nbsp;Status</th>
                            <th>District</th>
                            <th>County</th>
                            <th>Parish</th>
                            <th>Village</th>
                            <th>Region</th>
                            <th>Nationality</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->firstName }}</td>
                                <td>{{ $user->lastName }}</td>
                                <td>{{ $user->middleName }}</td>
                                <td>{{ $user->phoneNumber }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->gender }}</td>
                                <td>{{ $user->dob }}</td>
                                <td>{{ $user->cardType }}</td>
                                <td>{{ $user->cardNumber }}</td>
                                <td>{{ $user->maritalStatus }}</td>
                                <td>{{ $user->district }}</td>
                                <td>{{ $user->subCounty }}</td>
                                <td>{{ $user->parish }}</td>
                                <td>{{ $user->village }}</td>
                                <td>{{ $user->region }}</td>
                                <td>{{ $user->nationality }}</td>
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
        $(function() {
            $('#example').DataTable({ 
                dom: 'Bfrtip',
                "scrollX": true,
                "buttons": [
                    {
                        text: 'CSV',
                        action: function ( e, dt, node, config ) {
                            alert( 'Button activated' );
                        }
                    },
                    {
                        text: 'Copy',
                        action: function ( e, dt, node, config ) {
                            alert( 'Button activated' );
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
        } );    
    </script>
@endsection