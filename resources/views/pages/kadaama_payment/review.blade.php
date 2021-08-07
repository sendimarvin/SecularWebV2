
@extends('layouts/app')


@section('custom_css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
@endsection


@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Kadaama Payment</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Kadaama</a></li>
            <li class="breadcrumb-item active">Applications</li>
        </ol>

        <div class="row">
            <div class=" col-4">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    User/Applicant
                </div>
                <div class="card-body">

                    <p><b>First Name :</b> {{$applicant->firstName}}</p>
                    <p><b>Middle Name :</b> {{$applicant->middleName}}</p>
                    <p><b>Last Name :</b> {{$applicant->lastName}}</p>
                    <p><b>Gender :</b> {{$applicant->gender}}</p>
                    <hr>
                    <p><b>Card Type :</b> {{$applicant->cardType}}</p>
                    <p><b>Card Number :</b> {{$applicant->cardNumber}}</p>
                    <hr>
                    <p><b>Email Address :</b> {{$applicant->email}}</p>
                    <p><b>Phone Number :</b> {{$applicant->phoneNumber}}</p>

                </div>
            </div>
            </div>
            <div class=" col-4">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Application
                </div>
                <div class="card-body">

                    <p><b>Country :</b> {{$application->country}}</p>
                    <p><b>Work City :</b> {{$application->work_city}}</p>
                    <p><b>Work Address :</b> {{$application->work_address}}</p>
                    <hr>
                    <p><b>Work Type :</b> {{$application->work_type}}</p>
                    <p><b>Duration :</b> {{$application->duration}}</p>
                    <hr>
                    <p><b>Payment Full :</b> {{$application->payment_full}}</p>
                    <p><b>Payment Sofar :</b> {{$application->payment_sofar}}</p>
                    <p><b>Payment Yearly :</b> {{$application->payment_yearly}}</p>

                </div>
            </div>
            </div>
            <div class=" col-4">
            <div class="card bg-dark text-white mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Current Payment
                </div>
                <div class="card-body">

                    <p><b>Payment Date :</b> {{$kadaamaPayment->payment_date}}</p>
                    <hr>
                    <p><b>Title :</b> {{$payment->title}}</p>
                    <p><b>Amount :</b> {{$payment->amount}}</p>
                    <p><b>Payment Reference :</b> {{$payment->payment_ref}}</p>
                    <p><b>Payment Method :</b> {{$payment->payment_method}}</p>
                    <p><b>Status :</b> {{$payment->status}}</p>

                    <hr>
                    <h4>Actions</h4>


                    <div class="row text-center">
                        @if($payment->status != "pending")
                            <form class="col-4 mb-2" action="{{url("kadaama/payments/review/".$kadaamaPayment->id."/pending")}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input style="width: 100%" type="submit" name="submit" value="Pending" class="btn btn-primary">
                            </form>
                        @endif

                        @if($payment->status != "approved")
                        <form class="col-4 mb-2" action="{{url("kadaama/payments/review/".$kadaamaPayment->id."/accept")}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input style="width: 100%"  type="submit" name="submit" value="Approve" class="btn btn-success">
                        </form>
                        @endif

                        @if($payment->status != "declined")
                        <form class="col-4"  action="{{url("kadaama/payments/review/".$kadaamaPayment->id."/decline")}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input style="width: 100%"  type="submit" name="submit" value="Decline" class="btn btn-danger">
                        </form>
                        @endif
                    </div>

                </div>
            </div>
            </div>
        </div>
    </div>
@endsection


@section('custom_scripts')


@endsection
