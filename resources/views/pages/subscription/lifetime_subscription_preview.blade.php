
@extends('layouts/app')


@section('custom_css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
@endsection


@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Lifetime Subscription</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Kadaama</a></li>
            <li class="breadcrumb-item active">Applications</li>
        </ol>

        <div class="row">
            <div class=" col-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Applicant
                    </div>
                    <div class="card-body">
                        <p><b>First Name :</b> {{$applicant->firstName}}</p>
                        <p><b>Middle Name :</b> {{$applicant->middleName}}</p>
                        <p><b>Last Name :</b> {{$applicant->lastName}}</p>
                        <p><b>Email Address :</b> {{$applicant->email}}</p>
                        <p><b>Phone Number :</b> {{$applicant->phoneNumber}}</p>
                        <p><b>Gender :</b> {{$applicant->gender}}</p>
                        <a href="{{url("/kadaama/applications/preview/1")}}"
                        class="btn btn-primary">View Full Details</a>
                    </div>
                </div>
            </div>

            @foreach ($lifetimeBeneficiaries as $l)

                <div class="col-4">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Beneficiary #{{$l->id}}
                        </div>
                        <div class="card-body">
                            <p><b>Name :</b> {{$l->beneficiary_name}}</p>
                            <p><b>Contact :</b> {{$l->phone_contact}}</p>
                            <p><b>Relationship :</b> {{$l->relationship}}</p>
                            <p><b>Nin :</b> {{$l->nin}}</p>
                            <p><b>Created At :</b> {{$l->created_at}}</p>

                            <hr/>

                            <p>Examination Records</p>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Hospital</th>
                                    <th scope="col">amount</th>
                                    <th scope="col">Year</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($l->records as $record)

                                        <tr>
                                            <th scope="row">{{$record->id}}</th>
                                            <td>{{$record->hospital->name}}</td>
                                            <td>{{$record->amount}} UGX</td>
                                            <td>{{$record->year}}</td>
                                        </tr>

                                    @endforeach
                                </tbody>
                            </table>

                            <a href="{{url("/subscriptions/lifetime_beneficiary/".$l->id."/add_examination")}}" class="btn btn-secondary">Add Record</a>

                        </div>
                    </div>
                </div>

            @endforeach

        <div class="row">

        </div>
    </div>
@endsection


@section('custom_scripts')


@endsection
