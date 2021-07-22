
@extends('layouts/app')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Nationality</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Locations</a></li>
            <li class="breadcrumb-item active">Nationality</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                This retrieves all nationalities that are in the system
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Nationalities
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Nationality</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nationality</th>
                        </tr>
                    </tfoot>
                    <tbody>

                        @foreach ($nationalities as $nationality)
                            <tr>
                                <td>{{ $nationality->nationality }}</td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection