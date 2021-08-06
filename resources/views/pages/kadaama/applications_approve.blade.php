
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
            <div class=" col-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Kadaama Applications
                </div>
                <div class="card-body">

                    <p><b>First Name :</b> {{$applicant->firstName}}</p>
                    <p><b>Middle Name :</b> {{$applicant->middleName}}</p>
                    <p><b>Last Name :</b> {{$applicant->lastName}}</p>
                    <p><b>Email Address :</b> {{$applicant->email}}</p>
                    <p><b>Phone Number :</b> {{$applicant->phoneNumber}}</p>

                    <hr>


                    <p><b>Country :</b> {{$application->country}}</p>
                    <p><b>Work City :</b> {{$application->work_city}}</p>
                    <p><b>Work Address :</b> {{$application->work_address}}</p>
                    <p><b>Work Type :</b> {{$application->work_type}}</p>
                    <p><b>Duration :</b> {{$application->duration}} Year(s)</p>
                    <p><b>How often paid :</b> {{$application->how_often_paid}}</p>
                    <p><b>How much paid :</b> {{$application->how_much_paid}}</p>
                    <p><b>Start Date :</b> {{$application->start_date}}</p>
                    <p><b>End Date :</b> {{$application->end_date}}</p>
                </div>
            </div>
            </div>

            <div class=" col-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Kadaama Offer To be approved
                </div>
                <div class="card-body">


                    <p><b>Payment Yearly :</b> {{$application->payment_yearly}}</p>
                    <p><b>Payment Full :</b> {{$application->payment_full}}</p>
                    <p><b>Payment So-Far :</b> {{$application->payment_sofar}}</p>
                    <p><b>Payment Date :</b> {{$application->payment_date}}</p>
                    <p><b>Next Payment Date :</b> {{$application->next_payment_date}}</p>

                    <hr>

                    <form action="{{url("kadaama/applications/approve/".$application->id."/save")}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="exampleInputEmail1">Review</label>
                            <textarea class="form-control" name="review" id="exampleInputEmail1" style="height: 280px"></textarea>
                        </div>

                        <input  class="btn btn-success" type="submit" value="Approval"/>

                    </form>

                </div>
            </div>
            </div>
        </div>
    </div>
@endsection


@section('custom_scripts')


@endsection
