
@extends('layouts/app')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Country</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Locations</a></li>
            <li class="breadcrumb-item active">Country</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                This retrieves all Countries that are in the system
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Countries
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Country</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Country</th>
                        </tr>
                    </tfoot>
                    <tbody>

                        @foreach ($countries as $country)
                            <tr>
                                <td>{{ $country->country }}</td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection