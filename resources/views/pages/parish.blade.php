
@extends('layouts/app')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Parish</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Locations</a></li>
            <li class="breadcrumb-item active">Parish</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                This retrieves all parishes that are in the system
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Parishes
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Country</th>
                            <th>District</th>
                            <th>Sub-counties</th>
                            <th>Parish</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Country</th>
                            <th>District</th>
                            <th>Sub-counties</th>
                            <th>Parish</th>
                        </tr>
                    </tfoot>
                    <tbody>

                        @foreach ($parishes as $parish)
                            <tr>
                                <td>{{ $parish->id }}</td>
                                <td>{{ "Uganda" }}</td>
                                <td>{{ $parish->district }}</td>
                                <td>{{ $parish->subcounty }}</td>
                                <td>{{ $parish->parish }}</td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection