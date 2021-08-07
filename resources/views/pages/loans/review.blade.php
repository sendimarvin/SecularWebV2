
@extends('layouts/app')


@section('custom_css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
@endsection


@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Loan Applications</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Loan</a></li>
            <li class="breadcrumb-item active">Applications</li>
        </ol>

        <div class="row">
            <div class="col-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Applicant Details
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
                    </div>
                </div>
            </div>
            <div class=" col-4">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Application Questions
                </div>
                <div class="card-body">
                    @foreach( json_decode($application->questions) as $category)
                        <h6>{{$category->category}}</h6>
                    <hr>
                        @foreach( $category->questions as $question)
                            <p><b>{{$question->question}}</b><br>REPLY: {{$question->value}}</p>
                        @endforeach

                    @endforeach
                </div>
            </div>
            </div>
            <div class=" col-4">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Application Details ({{$application->loan_status}})
                </div>
                <div class="card-body">
                    <h6 class="text-primary">LOAN TYPE</h6>
                    <hr>
                    <p><b>Package :</b> {{$loan_package->loan}}</p>
                    <p><b>Sub Package :</b> {{$loan_sub_package->sub_loan}}</p>
                    <p><b>Maximum :</b> {{$loan_sub_package->max_amount}}</p>
                    <p><b>Interest :</b> {{$loan_sub_package->interest}}</p>
                    <p><b>Maximum Period :</b> {{$loan_sub_package->max_period}}</p>

                    <h6 class="text-primary">LOAN INFORMATION</h6>
                    <hr>
                    <p><b>Amount Needed:</b> {{$application->amount}}</p>
                    <p><b>Repayment Plan:</b> {{$application->loanRepaymentPlan}}</p>
                    <p><b>Repayment Days:</b> {{$application->loanRepaymentPlanDays}}</p>
                    <p><b>Reception:</b> {{$application->moneyReceptionOption}}</p>

                    <form action="{{url("/loans/applications/review/".$application->id."/submit")}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="exampleInputEmail1">Payment Grace Period (Days)</label>
                            <input name="paymentGracePeriod" value="{{$application->paymentGracePeriod}}" type="number" class="form-control" id="exampleInputEmail1" >
                        </div>
                        <div class="form-group mb-2">
                            <label for="exampleInputEmail1">Payment Interval (Days)</label>
                            <input name="paymentInterval" value="{{$application->paymentInterval}}"  type="number" class="form-control" id="exampleInputEmail1" >
                        </div>
                        <div class="form-group mb-2">
                            <label for="exampleInputEmail1">Payment Installment (UGX)</label> <span class="text-warning">* 10 </span>
                            <input name="paymentInstallment" value="{{$application->paymentInstallment}}"  type="number" class="form-control" id="exampleInputEmail1" >
                        </div>
                        <div class="form-group mb-2">
                            <label for="exampleInputEmail1">Loan Status</label>
                            <select name="loanStatus" type="number" class="form-control" id="exampleInputEmail1" >
                                <option
                                    @if($application->loan_status=="Pending") selected @endif
                                    value="Pending" >Pending</option>
                                <option
                                    @if($application->loan_status=="Processing") selected @endif
                                    value="Processing">Process</option>
                                <option
                                    @if($application->loan_status=="Declined") selected @endif
                                    value="Declined">Decline</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="exampleInputEmail1">Review</label>
                            <textarea class="form-control" name="review" id="exampleInputEmail1" ></textarea>
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


@endsection
