
@extends('layouts/app')


@section('custom_css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
@endsection


@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Subscription Payments</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Loans</a></li>
            <li class="breadcrumb-item active">Applications</li>
        </ol>

        <div class="row">
            <div class="col-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        User Information
                    </div>
                    <div class="card-body" style="height: 500px">
                        <p><b>Name :</b> {{$applicant->firstName}} {{$applicant->middleName}} {{$applicant->lastName}}</p>
                        <p><b>Email Address :</b> {{$applicant->email}}</p>
                        <p><b>Phone Number :</b> {{$applicant->phoneNumber}}</p>
                        <p><b>Gender :</b> {{$applicant->gender}}</p>
                        <p><b>Nationality :</b> {{$applicant->nationality}}</p>
                        <p><b>Region :</b> {{$applicant->region}}</p>
                        <p><b>Location :</b> {{$applicant->district}} -> {{$applicant->subCounty}} -> {{$applicant->parish}} -> {{$applicant->village}}</p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Subscription Package
                    </div>
                    <div class="card-body" style="height: 500px">
                        <p><b>Name :</b> {{$package->name}}</p>
                        <p><b>Period :</b> {{$package->period}}</p>
                        <p><b>Amount :</b> {{$package->amount}}</p>
                        <p><b>Benefits :</b> {{$package->benefits}}</p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Subscription Payment
                    </div>
                    <div class="card-body" style="height: 500px">
                        <p><b>Amount Needed:</b> {{$subscription->payment->amount}}</p>
                        <p><b>Title:</b> {{$subscription->payment->title}}</p>
                        <p><b>Amount:</b> {{$subscription->payment->amount}}</p>
                        <p><b>Payment Reference:</b> {{$subscription->payment->payment_ref}}</p>
                        <p><b>Payment Method:</b> {{$subscription->payment->payment_method}}</p>
                        <p><b>Created At:</b> {{$subscription->payment->created_at}}</p>

                        <h6 class="text-primary">ACTION FORM</h6>
                        <hr>

                        <form action="{{url("/subscriptions/payments/{$subscription->id}/editSubmit")}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-2">
                                <label for="exampleInputEmail1">Loan Status</label>
                                <select name="status" class="form-control" id="exampleInputEmail1" >
                                    <option
                                        @if($subscription->payment->status=="pending") selected @endif
                                        value="pending">Pending</option>
                                    <option
                                        @if($subscription->payment->status=="approved") selected @endif
                                        value="approved">Approved</option>
                                    <option
                                        @if($subscription->payment->status=="declined") selected @endif
                                        value="declined">Decline</option>
                                </select>
                            </div>

                            <input  class="btn btn-success" type="submit" value="Submit"/>

                        </form>

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

@endsection
