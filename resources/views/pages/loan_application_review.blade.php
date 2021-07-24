
@extends('layouts/app')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Loan Application Review - {{ $loan_application->application_id ?? '' }}</h1>
        {{-- <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Loan Applications</a></li>
            <li class="breadcrumb-item active">Review</li>
        </ol> --}}
        <div class="card mb-4">
            <div class="card-header">
                <b>User Details</b>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3"><b>First Name: </b>{{ $user->firstName ?? '' }}</div>
                    <div class="col-md-3"><b>Last Name: </b>{{ $user->lastName ?? '' }}</div>
                    <div class="col-md-3"><b>Middle Name: </b>{{ $user->middleName ?? '' }}</div>
                    <div class="col-md-3"><b>D.O.B: </b>{{ $user->dob ?? '' }}</div>
                </div>
                <div class="row">
                    <div class="col-md-3"><b>Phone: </b>{{ $user->phoneNumber ?? '' }}</div>
                    <div class="col-md-3"><b>Email: </b>{{ $user->email ?? '' }}</div>
                    <div class="col-md-3"><b>Gender: </b>{{ $user->gender ?? '' }}</div>
                    <div class="col-md-3"><b>Card Type: </b>{{ $user->cardType ?? '' }}</div>
                </div>
                <div class="row">
                    <div class="col-md-3"><b>Card Number: </b>{{ $user->cardNumber ?? '' }}</div>
                    <div class="col-md-3"><b>Marital Status: </b>{{ $user->maritalStatus ?? '' }}</div>
                    <div class="col-md-3"><b>Disctrict: </b>{{ $user->district ?? '' }}</div>
                    <div class="col-md-3"><b>Subcounty: </b>{{ $user->subCounty ?? '' }}</div>
                </div>
                <div class="row">
                    <div class="col-md-3"><b>Parish: </b>{{ $user->parish ?? '' }}</div>
                    <div class="col-md-3"><b>Village: </b>{{ $user->village ?? '' }}</div>
                    <div class="col-md-3"><b>Region: </b>{{ $user->region ?? '' }}</div>
                    <div class="col-md-3"><b>Nationality: </b>{{ $user->nationality ?? '' }}</div>
                </div>
            </div>
        </div>


        <div class="card mb-4">
            <div class="card-header">
                Loan Details
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3"><b>Loan: </b>{{ $loan_package->loan ?? '' }}</div>
                    <div class="col-md-3"><b>Sub Package: </b>{{ $loan_sub_package->sub_loan ?? '' }}</div>
                    <div class="col-md-3"><b>Max Amount: </b>{{ $loan_sub_package->max_amount ?? '' }}</div>
                    <div class="col-md-3"><b>Interest: </b>{{ $loan_sub_package->interest ?? '' }}</div>
                </div>
                <div class="row">
                    <div class="col-md-3"><b>Max Period: </b>{{ $loan_sub_package->max_period ?? '' }}</div>
                    <div class="col-md-3"><b>Amount Requested: </b>{{ $loan_application->amount ?? '' }}</div>
                    <div class="col-md-3"><b>Repayment Plan: </b>{{ $loan_application->loanRepaymentPlan ?? '' }}</div>
                    <div class="col-md-3"><b>Application Date: </b>{{ $loan_application->entry_date ?? '' }}</div>
                </div>
                <div class="row">
                    <div class="col-md-3"><b>Repayment Plan Days: </b>{{ $loan_sub_package->loanRepaymentPlanDays ?? '' }}</div>
                    <div class="col-md-3"><b>Reception Option: </b>{{ $loan_application->moneyReceptionOption ?? '' }}</div>
                    <div class="col-md-3"><b>Reception Bank: </b>{{ $loan_application->moneyReceptionBank ?? '' }}</div>
                    <div class="col-md-3"><b>Reception Bank Account No.: </b>{{ $loan_application->moneyReceptionBankAccountNumber ?? '' }}</div>
                </div>
                <div class="row">
                    <div class="col-md-3"><b>Repayment Reception Telcom: </b>{{ $loan_sub_package->moneyReceptionMobileTelecom ?? '' }}</div>
                    <div class="col-md-3"><b>Reception Mobile No.: </b>{{ $loan_application->moneyReceptionMobileNumber ?? '' }}</div>
                    <div class="col-md-3"><b>Reception Account Names: </b>{{ $loan_application->moneyReceptionAccountNames ?? '' }}</div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                Assessment
            </div>
            <div class="card-body">
                @foreach (json_decode($loan_application->questions) as $question)
                <div class="row">
                    <div class="col-md-3"><b>Loan: </b>{{ $loan_package->loan ?? '' }}</div>
                    <div class="col-md-3"><b>Sub Package: </b>{{ $loan_sub_package->sub_loan ?? '' }}</div>
                    <div class="col-md-3"><b>Max Amount: </b>{{ $loan_sub_package->max_amount ?? '' }}</div>
                    <div class="col-md-3"><b>Interest: </b>{{ $loan_sub_package->interest ?? '' }}</div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                Verdict
            </div>
            <div class="card-body">
                {{ Form::open(array('method'=>'PUT','route' => ['/loan_applications/update_loan_application', $loan_application->id])) }}
                    <div class="mb-3">
                        <textarea name="comment" id="comment" cols="30" rows="10"
                            class="form-control"
                            style="margin-top: 0px; margin-bottom: 0px; height: 99px;"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Approve & Disburse</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="submit" class="btn btn-danger">Decline</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <button type="submit" class="btn btn-warning">Print</button>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="/loan_applications" class="btn btn-default">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection