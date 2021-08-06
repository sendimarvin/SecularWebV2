
@extends('layouts/app')


@section('custom_css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
@endsection


@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Kadaama Applications</h1>
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
                    <p><b>DOB :</b> {{$applicant->dob}}</p>
                    <p><b>Card Type :</b> {{$applicant->cardType}}</p>
                    <p><b>Card Number :</b> {{$applicant->cardNumber}}</p>
                    <p><b>Marital Status :</b> {{$applicant->maritalStatus}}</p>
                    <p><b>Nationality :</b> {{$applicant->nationality}}</p>
                    <p><b>Region :</b> {{$applicant->region}}</p>
                    <p><b>Location :</b> {{$applicant->district}} -> {{$applicant->subCounty}} -> {{$applicant->parish}} -> {{$applicant->village}}</p>
                </div>
            </div>
            </div>

            <div class=" col-8">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Application Details
                </div>
                <div class="card-body row">

                    <div class="col-6">
                        <h5 class="p-2"><u>Working Details</u></h5>
                        <p><b>Country :</b> {{$application->country}}</p>
                        <p><b>Work City :</b> {{$application->work_city}}</p>
                        <p><b>Work Address :</b> {{$application->work_address}}</p>
                        <p><b>Work Type :</b> {{$application->work_type}}</p>
                        <p><b>Duration :</b> {{$application->duration}} Year(s)</p>
                        <p><b>How often paid :</b> {{$application->how_often_paid}}</p>
                        <p><b>How much paid :</b> {{$application->how_much_paid}}</p>
                        <hr>
                        <p><b>Start Date :</b> {{$application->start_date}}</p>
                        <p><b>End Date :</b> {{$application->end_date}}</p>
                        <hr>
                        <p><b>Status :</b> <span class="text-primary"><b>{{$application->status}}</b></span></p>
                        <p><b>Created At :</b> {{$application->created_at}}</p>
                    </div>
                    <div class="col-6">
                        <p><b>Taker Type :</b> {{$application->taker_type}}</p>
                        <p><b>Taker Name :</b> {{$application->taker_name}}</p>
                        <p><b>Taker Contact :</b> {{$application->taker_contact}}</p>
                        <hr>
                        <p><b>NOK Relation :</b> {{$application->nok_relation}}</p>
                        <p><b>NOK Name :</b> {{$application->nok_name}}</p>
                        <p><b>NOK Contact :</b> {{$application->nok_contact}}</p>
                        <hr>
                        <p><b>Payment Yearly :</b> {{$application->payment_yearly}}</p>
                        <p><b>Payment Full :</b> {{$application->payment_full}}</p>
                        <p><b>Payment So-Far :</b> {{$application->payment_sofar}}</p>
                        <p><b>Payment Date :</b> {{$application->payment_date}}</p>
                        <p><b>Next Payment Date :</b> {{$application->next_payment_date}}</p>
                    </div>

                </div>
            </div>
            </div>
        </div>


        <div class="row">
            <div class=" col-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Applicant Reviews
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Admin</th>
                                <th>State</th>
                                <th>Review</th>
                                <th>Created At</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach( $reviews as $review)
                                <tr>
                                    <td>{{$review->id}}</td>
                                    <td>{{$review->admin_id}}</td>
                                    <td>{{$review->state}}</td>
                                    <td>{{$review->review}}</td>
                                    <td>{{$review->created_at}}</td>
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


@endsection
