
@extends('layouts/app')


@section('custom_css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
@endsection


@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Lifetime Subscription</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Kadaama</a></li>
            <li class="breadcrumb-item active">Applications</li>
        </ol>

        <div class="row">
            <div class=" col-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Beneficiary Examination Addition
                    </div>
                    <div class="card-body">

                        <p>
                            <b>Name :</b> {{$beneficiary->beneficiary_name}}<br>
                        </p>
                        <p>
                            <b>Contact :</b> {{$beneficiary->phone_contact}}<br>
                        </p>
                        <p>
                            <b>Relationship :</b> {{$beneficiary->relationship}}<br>
                        </p>
                        <p>
                            <b>NIN :</b> {{$beneficiary->nin}}<br>
                        </p>

                        <hr>

                        <form action="{{url("/subscriptions/lifetime_beneficiary/".$beneficiary->id."/save_examination")}}"
                              method="post" enctype="multipart/form-data">
                            @csrf


                            <div class="form-group mb-2">
                                <label for="exampleInputEmail1">Year</label>
                                <input name="year" type="number" class="form-control" id="exampleInputEmail1" value="" >
                            </div>
                            <div class="form-group mb-2">
                                <label for="exampleInputEmail1">Amount</label>
                                <input name="amount" class="form-control" id="exampleInputEmail1" value="" >
                            </div>

                            <div class="form-group mb-2">
                                <label for="loanStatusId">Hospital</label>
                                <select name="hospital_id" class="form-control" id="loanStatusId" >
                                    @foreach($hospitals as $h)
                                    <option value="{{$h->id}}" >{{$h->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <input  class="btn btn-success" type="submit" value="Submit"/>

                        </form>



                    </div>
                </div>
            </div>

        <div class="row">

        </div>
    </div>
@endsection


@section('custom_scripts')


@endsection
