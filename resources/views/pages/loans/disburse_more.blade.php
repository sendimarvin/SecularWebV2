
@extends('layouts/app')


@section('custom_css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
@endsection


@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Loan Applications | Clearing</h1>
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
                    <div class="card-body" style="height: 500px">
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
                    </div>
                </div>
            </div>
            <div class=" col-4">
                <div class="card mb-4 bg-dark text-white" >
                    <div class="card-header text-danger">
                        <i class="fas fa-table me-1"></i>
                        KEY APPLICATION INFORMATION
                    </div>
                    <div class="card-body"  style="height: 500px">
                        <p><b>Interest:</b> {{$application->interest}}% which is {{$application->interestAmount}}</p>
                        <p><b>Payment Grace Period:</b> {{$application->paymentGracePeriod}} Days</p>
                        <p><b>Payment Start Date:</b> {{$application->paymentStartDate}}</p>
                        <p><b>Next Payment Date:</b> {{$application->nextPaymentDate}}</p>
                        <p><b>Payment Interval:</b> {{$application->paymentInterval}} Days</p>
                        <p><b>Payment So Far:</b> {{$application->paymentSofar}}</p>
                        <p><b>Payment Left:</b> {{$application->paymentFull - $application->paymentSofar}}</p>
                        <p><b>Payment Full:</b> {{$application->paymentFull}}</p>
                        <p><b>Payment Installment:</b> {{$application->paymentInstallment}}</p>
                        <p><b>Expected Completion Date:</b> {{$application->expectedCompletionDate}}</p>
                        <p><b>Loan Status:</b> {{$application->loan_status}}</p>

                        <div>
                            <a class="btn btn-success" href="{{url("/loans/applications/clear/{$application->id}")}}"
                               style="width: 100%">Clear Loan | Mark as Paid</a>
                        </div>

                    </div>
                </div>
            </div>
            <div class=" col-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Application Details ({{$application->loan_status}})
                    </div>
                    <div class="card-body"  style="height: 500px">
                        <h6 class="text-primary">LOAN TYPE</h6>
                        <hr>
                        <p><b>Package :</b> {{$loan_package->loan}}</p>
                        <p><b>Sub Package :</b> {{$loan_sub_package->sub_loan}}</p>

                        <h6 class="text-primary">LOAN INFORMATION</h6>
                        <hr>
                        <p><b>Amount Needed:</b> {{$application->amount}}</p>
                        <p><b>Repayment Plan:</b> {{$application->loanRepaymentPlan}}</p>
                        <p><b>Repayment Days:</b> {{$application->loanRepaymentPlanDays}}</p>
                        <p><b>Reception:</b> {{$application->moneyReceptionOption}}</p>

                        @if($application->moneyReceptionOption=="Mobile Money")
                            <p><b>Mobile Telecom:</b> {{$application->moneyReceptionMobileTelecom}}</p>
                            <p><b>Mobile Number:</b> {{$application->moneyReceptionMobileNumber}}</p>
                            <p><b>Account Names:</b> {{$application->moneyReceptionAccountNames}}</p>
                        @else
                            <p><b>Bank:</b> {{$application->moneyReceptionBank}}</p>
                            <p><b>Account Number:</b> {{$application->moneyReceptionBankAccountNumber}}</p>
                        @endif


                    </div>
                </div>
            </div>
            <div class="col-12 row">

                <div class="col-6">
                    <div class="card mb-4 bg-dark text-white" >
                        <div class="card-header text-danger">
                            <i class="fas fa-table me-1"></i>
                            DISBURSEMENT
                        </div>
                        <div class="card-body table-responsive"  style="height: 300px">
                            <table class="table table-head-fixed text-nowrap text-white">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Created Date</th>
                                    <th>Updated Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($loan_disbursements as $disbursement)
                                    <tr>
                                        <td>{{$disbursement->id}}</td>
                                        <td>{{$disbursement->type}}</td>
                                        <td>{{$disbursement->amount}} UGX</td>
                                        <td>{{$disbursement->created_at}}</td>
                                        <td>{{$disbursement->updated_at}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Next Disbursement (Balance: {{$application->amount - $loan_disbursements_sum}} UGX)
                        </div>
                        <div class="card-body" style="height: 300px;">

                            <form action="{{url("/loans/applications/disburse_more/".$application->id."/submit")}}" method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group mb-2">
                                    <label for="exampleInputEmail1">Authorisation Code</label>
                                    <input name="authorisationCode" type="password"  class="form-control" id="exampleInputEmail1" >
                                </div>

                                <div class="form-group mb-2" id="disbursementAmountCtn">
                                    <label for="disbursementAmountId">First Amount</label>
                                    <input name="disbursementAmount" type="number"
                                           value="{{$application->amount - $loan_disbursements_sum}}"  class="form-control" id="disbursementAmountId" >
                                </div>

                                <div class="form-group mb-2">
                                    <label for="exampleInputEmail1">Review</label>
                                    <textarea class="form-control" name="review" id="exampleInputEmail1" ></textarea>
                                </div>

                                <input  class="btn btn-success" type="submit" value="Disburse"/>

                            </form>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection


@section('custom_scripts')


@endsection
