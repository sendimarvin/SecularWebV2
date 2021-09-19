
@extends('layouts/app')


@section('custom_css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
@endsection


@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Kadaama Rescue Requests</h1>
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
                    {{--<a href="{{url("/kadaama/applications/preview/".$application->id)}}"
                    class="btn btn-primary">View Full Details</a>--}}
                </div>
            </div>
            </div>

            <div class=" col-8">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Request Details
                </div>
                <div class="card-body row" style="min-height: 310px;">

                    <div class="col-12">
                        <p><b>Reason :</b> {{$request->reason}}</p>
                        <p><b>Narration :</b> {{$request->narration}}</p>
                        <p><b>Admin Comment :</b> {{$request->comment}}</p>
                        <p><b>Status :</b> {{$request->status}}</p>
                        <hr>
                        <p><b>Entry Date :</b> {{$request->entry_date}}</p>
                        <p><b>Created At :</b> {{$request->created_at}}</p>
                        <p><b>Updated At :</b> {{$request->updated_at}}</p>
                    </div>

                </div>
            </div>
            </div>
        </div>


        <div class="row">
            <div class=" col-12"

                 @if($request->status != "pending")
                 hidden
                @endif
            >
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Action / Reaction / Review
                    </div>

                    <div class="card-body">

                        <form action="{{url("/kadaama/rescue_requests/".$request->id."/update")}}"
                              method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mb-2">
                                <label for="loanStatusId">Status</label>
                                <select name="status" class="form-control" id="loanStatusId" onchange="OnLoanStatusAsChanged(this.value)" >
                                    <option
                                        @if($request->status=="pending") selected @endif
                                    value="pending" >Pending</option>
                                    <option
                                        @if($request->status == "approved") selected @endif
                                    value="approved">Approved</option>
                                    <option
                                        @if($request->status == "declined") selected @endif
                                    value="declined">Decline</option>
                                </select>
                            </div>
                            <div class="form-group mb-2" id="applicantReviewCtn">
                                <label for="applicantReviewId">Comment (Sent to Applicant)</label>
                                <textarea class="form-control" name="comment" id="applicantReviewId" ></textarea>
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
