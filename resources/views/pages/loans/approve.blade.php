
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
                        Application Fee
                    </div>
                    <div class="card-body">
                        <p><b>Amount :</b> {{$fee_payment->amount}}</p>
                        <p><b>Payment Date :</b> {{$fee_payment->payment_date}}</p>
                        <p><b>Status :</b> {{$fee_payment->status}}</p>
                        <p><b>Payment Ref :</b> {{$fee_payment->payment_ref}}</p>
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

                    <h6 class="text-primary">LOAN INFORMATION</h6>
                    <hr>
                    <p><b>Amount Needed:</b> <span id="amountNeededId">{{$application->amount}}</span></p>
                    <p><b>Repayment Plan:</b> {{$application->loanRepaymentPlan}}</p>
                    <p><b>Repayment Days:</b> {{$application->loanRepaymentPlanDays}}</p>
                    <p><b>Reception:</b> {{$application->moneyReceptionOption}}</p>

                    <h6 class="text-primary">KEY INFORMATION</h6>
                    <hr>
                    <p><b>Interest:</b> {{$application->interest}}% which is {{$application->interestAmount}}</p>
                    <p><b>Payment Grace Period:</b> {{$application->paymentGracePeriod}} Days</p>
                    <p><b>Payment Start Date:</b> {{$application->paymentStartDate}}</p>
                    <p><b>Next Payment Date:</b> {{$application->nextPaymentDate}}</p>
                    <p><b>Payment Interval:</b> {{$application->paymentInterval}} Days</p>
                    <p><b>Payment Full:</b> {{$application->paymentFull}}</p>
                    <p><b>Payment Installment:</b> {{$application->paymentInstallment}}</p>
                    <p><b>Expected Completion Date:</b> {{$application->expectedCompletionDate}}</p>

                    @if($application->loan_status=="Processing")
                        <form action="{{url("/loans/applications/approve/".$application->id."/submit")}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="exampleInputEmail1">Loan Status</label>
                            <select name="loanStatus" type="number" class="form-control" id="exampleInputEmail1" >
                                <option
                                    @if($application->loan_status=="Approved") selected @endif
                                    value="Approved">Approve</option>
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
                    @else
                        <form action="{{url("/loans/applications/disburse/".$application->id."/submit")}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-2">
                                <label for="exampleInputEmail1">Authorisation Code</label>
                                <input name="authorisationCode" type="password"  class="form-control" id="exampleInputEmail1" >
                            </div>
                            <div class="form-group mb-2">
                                <label for="exampleInputEmail1">Loan Status</label>
                                <select name="loanStatus" type="number" class="form-control" id="exampleInputEmail1" >
                                    <option
                                        @if($application->loan_status=="Disbursed") selected @endif
                                    value="Disbursed">Disbursed</option>
                                    <option
                                        @if($application->loan_status=="Declined") selected @endif
                                    value="Declined">Decline</option>
                                </select>
                            </div>

                            <hr class="mt-4">

                            <div class="form-group mb-2" id="disburseAsCtn">
                                <label for="disburseAsId">Disburse As</label>
                                <select name="disburseAs" class="form-control" onchange="OnDisburseAsChanged(this.value);" id="disburseAsId" >
                                    <option value="parts">In Parts</option>
                                    <option selected value="whole">As Whole</option>
                                </select>
                            </div>

                            <div class="form-group mb-2" id="disbursementAmountCtn">
                                <label for="disbursementAmountId">First Amount</label>
                                <input name="disbursementAmount" type="number" readonly value="{{$application->amount}}"  class="form-control" id="disbursementAmountId" >
                            </div>

                            <div class="form-group mb-2" id="disbursementAmountCtn">
                                <label for="transferReference">Transaction Reference/Transfer ID</label>
                                <input name="transferReference" type="text" class="form-control" id="disbursementAmountId" >
                            </div>


                            <div class="form-group mb-2">
                                <label for="exampleInputEmail1">Review</label>
                                <textarea class="form-control" name="review" id="exampleInputEmail1" ></textarea>
                            </div>

                            <input  class="btn btn-success" type="submit" value="Submit"/>

                        </form>
                    @endif
                </div>
            </div>
            </div>

        </div>
    </div>

    <script>
        //DISBURSE AS
        let disburseAsId = document.getElementById("disburseAsId")
        let disbursementAmountId = document.getElementById("disbursementAmountId")
        let amountNeededId = document.getElementById("amountNeededId")

        function OnDisburseAsChanged(value){
            refreshDisburseAmount(value)
        }
        function refreshDisburseAmount(value) {
            if(value === "parts"){
                disbursementAmountId.value = 0
                disbursementAmountId.readOnly = false
            }else if(value === "whole"){
                disbursementAmountId.value = amountNeededId.innerText
                disbursementAmountId.readOnly = true
            }
        }

    </script>
@endsection


@section('custom_scripts')


@endsection
