
@extends('layouts/app')


@section('custom_css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
@endsection


@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Loan Questions Options | EDIT</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Loans</a></li>
            <li class="breadcrumb-item active">Applications</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Loan Question Option
            </div>
            <div class="card-body">


                <form action="{{url("/question/options/{$option->id}/update")}}" method="post" enctype="multipart/form-data">
                    @method("put")
                    @csrf
                    <div class="form-group mb-2">
                        <label for="exampleInputEmail1">Question</label>
                        <select name="question_id" class="form-control" id="exampleInputEmail1" >

                            @foreach ($questions as $question)
                                <option
                                    @if($question->id==$option->question_id) selected @endif
                                    value="{{$question->id}}" >{{$question->category->category}} : {{$question->question}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="exampleInputEmail1">Option Name</label>
                        <input type="text" class="form-control" name="option_name" value="{{$option->option_name}}" id="exampleInputEmail1" >
                    </div>
                    <input  class="btn btn-success" type="submit" value="Submit"/>
                </form>








            </div>
        </div>
    </div>
@endsection


@section('custom_scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script>
        var table;
        $(function() {
            table = $('#example').DataTable({
                dom: 'Bfrtip',
                "buttons": [
                    {
                        text: 'Excel',
                        action: function ( e, dt, node, config ) {
                            alert( 'Button activated' );
                        }
                    }
                ]
            } );


            $('#example tbody').on( 'click', 'tr', function () {
                if ( $(this).hasClass('selected') ) {
                    $(this).removeClass('selected');
                }
                else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            } );

            // $('#button').click( function () {
            //     table.row('.selected').remove().draw( false );
            // } );


        } );
    </script>
@endsection
