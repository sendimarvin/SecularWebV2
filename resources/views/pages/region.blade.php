
@extends('layouts/app')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Region</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Locations</a></li>
            <li class="breadcrumb-item active">Region</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                This retrieves all regions that are in the system
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                regions
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Region</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Region</th>
                        </tr>
                    </tfoot>
                    <tbody>

                        @foreach ($regions as $region)
                            <tr>
                                <td>{{ $region->region }}</td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection