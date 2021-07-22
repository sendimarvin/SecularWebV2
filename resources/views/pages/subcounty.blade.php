
@extends('layouts/app')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Region</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Locations</a></li>
            <li class="breadcrumb-item active">District</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                This retrieves all districts that are in the system
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                districts
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Country</th>
                            <th>District</th>
                            <th>Sub-counties</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Country</th>
                            <th>District</th>
                            <th>Sub-counties</th>
                        </tr>
                    </tfoot>
                    <tbody>

                        @foreach ($subcounties as $subcounty)
                            <tr>
                                <td>{{ $subcounty->id }}</td>
                                <td>{{ "Uganda" }}</td>
                                <td>{{ $subcounty->district }}</td>
                                <td>{{ $subcounty->subcounty }}</td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection