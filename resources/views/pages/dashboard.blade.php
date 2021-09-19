@extends('layouts/app')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>

        <div class="row">
            <div class="col-2">
                <div class="card mb-4">
                    <div class="card-body">Loans : Amount Disbursed</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small stretched-link text-decoration-none">{{$loan_amount_disbursed}} UGX</a>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card mb-4">
                    <div class="card-body">Loans : Amount Paid Back</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small stretched-link text-decoration-none">{{$loan_amount_paid_back}} UGX</a>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card mb-4">
                    <div class="card-body">Loan Application Fee Paid</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small stretched-link text-decoration-none">{{$loan_application_fees}} UGX</a>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card mb-4">
                    <div class="card-body">Subscription Fees Paid</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small stretched-link text-decoration-none">{{$subscription_fees}} UGX</a>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card mb-4">
                    <div class="card-body">Events Fees Paid</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small stretched-link text-decoration-none">{{$events_fees}} UGX</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-3">
                <div class="card mb-4">
                    <div class="card-body">Loan applications</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small stretched-link text-decoration-none">{{$loan_application_all}}</a>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card mb-4">
                    <div class="card-body">Kadaama Application</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small stretched-link text-decoration-none">{{$kadaama_applications}}</a>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card mb-4">
                    <div class="card-body">Applicants | App Users</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small stretched-link text-decoration-none">{{$applicants}}</a>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card mb-4">
                    <div class="card-body">Administrators</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small stretched-link text-decoration-none">{{$administrators}}</a>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-2">
                <div class="card mb-4">
                    <div class="card-body">Pending Loans</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small stretched-link text-decoration-none">{{$loan_application_pending}}</a>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card mb-4">
                    <div class="card-body">Processing Loans</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small stretched-link text-decoration-none">{{$loan_application_processing}}</a>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card mb-4">
                    <div class="card-body">Approved Loans</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small stretched-link text-decoration-none">{{$loan_application_approved}}</a>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card mb-4">
                    <div class="card-body">Disbursed Loans</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small stretched-link text-decoration-none">{{$loan_application_disbursed}}</a>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card mb-4">
                    <div class="card-body">Declined Loans</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small stretched-link text-decoration-none">{{$loan_application_declined}}</a>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card mb-4">
                    <div class="card-body">Paid Loans</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small stretched-link text-decoration-none">{{$loan_application_paid}}</a>
                    </div>
                </div>
            </div>

        </div>

        @if(false)
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">User accounts</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Loan applications</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Subscriptions</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">In-active accounts</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="row">

            <div class="col-5">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar me-1"></i>
                            Application Subscriptions
                        </div>
                        <div class="card-body" style="height: 400px; ">
                            <canvas id="subscriptionBarChart" width="100%" height="95"></canvas>
                        </div>
                        <div id="subscription_total_amounts" hidden>{{$subscription_total_amounts}}</div>
                    </div>
                </div>
            </div>

            <div class="col-7">

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Payment
                    </div>
                    <div class="card-body" style="height: 400px; overflow-y: auto">
                        <table id="example"
                               class="table table-bordered display nowrap"  >
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Title.</th>
                                <th>Amount.</th>
                                <th>Status.</th>
                                <th>Payment Method.</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($payments as $payment)
                                <tr>
                                    <td>{{ $payment->id }}</td>
                                    <td>{{ $payment->title }}</td>
                                    <td>{{ $payment->amount }} UGX</td>
                                    <td>{{ $payment->status }}</td>
                                    <td>{{ $payment->payment_method }}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('custom_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/chart-bar-demo.js') }}"></script>
    <script>

        let subscription_total_amounts = JSON.parse(document.getElementById("subscription_total_amounts").innerText)
        let list_key = subscription_total_amounts.map(it => it.id)
        let list_name = subscription_total_amounts.map(it => it.name.replace("Subscription", ""))
        let list_total_number = subscription_total_amounts.map(it => it.total_number)

        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#292b2c';

        // Bar Chart Example
        var ctx = document.getElementById("subscriptionBarChart");
        var myLineChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: list_name,
                datasets: [{
                    label: "People",
                    backgroundColor: "rgba(2,117,216,1)",
                    borderColor: "rgba(2,117,216,1)",
                    data: list_total_number,
                }],
            },
            options: {
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'month'
                        },
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 6
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                        },
                        gridLines: {
                            display: true
                        }
                    }],
                },
                legend: {
                    display: false
                }
            }
        });
    </script>
@endsection
