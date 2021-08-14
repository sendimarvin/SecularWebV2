
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
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active">Users</li>
        </ol>

        <div class="row">

            <div class="col-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Users
                    </div>
                    <div class="card-body">

                        <p><b>Name :</b> {{$applicant->firstName}} {{$applicant->middleName}} {{$applicant->lastName}}</p>
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

                        <hr>

                        @if($applicant->status != "approved")
                            <form action="{{url("/users/{$applicant->id}/approve")}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-2">
                                    <label for="exampleInputEmail1">Account Status</label>
                                    <select name="status" type="number" class="form-control" id="exampleInputEmail1" >
                                        <option
                                            @if($applicant->status=="pending") selected @endif
                                        value="pending" >Pending</option>
                                        <option
                                            @if($applicant->status=="approved") selected @endif
                                        value="approved">Approved</option>
                                        <option
                                            @if($applicant->status=="declined") selected @endif
                                        value="declined">Decline</option>
                                    </select>
                                </div>
                                <input  class="btn btn-success" type="submit" value="Submit"/>
                            </form>
                        @else
                            <p class="h3 text-success text-uppercase">STATUS: {{$applicant->status}}</p>
                        @endif

                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Files & Document
                    </div>
                    <div class="card-body">
                        <p><b>Profile Picture :</b></p>
                        <img class="img-thumbnail"
                             style="height: 100px; width: 100px;" src="{{env("IMAGES_URL").$applicant->profilePicture}}"/>

                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <p><b>Identity Card Front :</b></p>
                                <img class="img-thumbnail"
                                     style="height: 200px; " src="{{env("IMAGES_URL").$applicant->cardPictureFront}}"/>
                            </div>
                            <div class="col-6">
                                <p><b>Identity Card Back :</b></p>
                                <img class="img-thumbnail"
                                     style="height: 200px;" src="{{env("IMAGES_URL").$applicant->cardPictureBack}}"/>

                            </div>
                        </div>
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
