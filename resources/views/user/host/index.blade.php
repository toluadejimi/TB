@extends('layouts.main.headerone')

@section('content')





<div class="main-panel">
    <div class="content-wrapper">

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
        @endif


        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card corona-gradient-card">
                    <div class="card-body py-0 px-0 px-sm-3">
                        <div class="row align-items-center">
                            <div class="col-4 col-sm-3 col-xl-2">
                                <img src="{{url('')}}/assets/images/dashboard/Group126@2x.png"
                                    class="gradient-corona-img img-fluid" alt="">
                            </div>
                            <div class="col-5 col-sm-7 col-xl-8 p-0">
                                <h4 class="mb-1 mb-sm-0">Welcome to Digitz</h4>
                                <p class="mb-0 font-weight-normal d-none d-sm-block">Get Bulletproff Hosting for your
                                    project
                                    Host with secure hosting
                                </p>
                            </div>
                            <div class="col-3 col-sm-2 col-xl-2 ps-0 text-center">
                                <span>
                                    <a href="https://wa.me/2348105317336" target="_blank"
                                        class="btn btn-outline-light btn-rounded get-started-btn">Chat with us</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>


        <h5 class="mb-4">Buy Bulletproof Hosting</h5>

        <div class="row">
            @if(count($products) != 0)
            @foreach($products as $div)
            <div class="col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body mb-3">
                        <h6 class="text-muted">Country</h6>
                        <p> {{ $div->country }} </p>
                        <h6 class="text-muted">Title</h6>
                        <p> {{ $div->name }} </p>
                        <h6 class="text-muted">Amount</h6>
                        <p> NGN {{ number_format($div->amount, 2) }}</p>
                        <h6 class="text-muted">Duration</h6>
                        <p> {{ ($div->term) }} Month</p>

                        <form method="POST" action="buy-hosting?ref_trans_id={{$div->id}}&amount={{ $div->amount }}">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-inverse-success btn-lg  mt-2">Buy</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
        @if(count($products) == 0)
        <div class="text-center mt-2">
            <div class="alert  bg-gradient-primary text-white">
                <span class="text-left">{{ __('No Bulletproof Hosting Available') }}</span>
            </div>
        </div>
        @endif



        <div class="row">

            <div class="col-sm-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body mb-3">
                        <h5 class="mb-4">Hosting History</h5>


                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-white">
                                    <tr>
                                        <th class="text-white">Data</th>
                                        <th class="text-white">Amount</th>

                                    </tr>
                                </thead>
                                @if(count($soldhost) != 0)
                                <tbody class="list">
                                    @foreach($soldhost ?? [] as $trx)
                                    <tr>
                                        <td class="text-white">
                                            {{ $trx->data }}
                                        </td>
                                        <td class="text-white">
                                            NGN {{ number_format($trx->amount, 2) }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                @endif
                            </table>
                            @if(count($soldhost) == 0)
                            <div class="text-center mt-2">
                                <div class="alert  bg-gradient-primary text-white">
                                    <span class="text-left">{{ __('No Bulletproof Hosting found') }}</span>
                                </div>
                            </div>
                            @endif
                            </table>
                        </div>

                    </div>
                </div>
            </div>


            <div class="col-12 grid-margin stretch-card">
                <div class="card corona-gradient-card">
                    <div class="card-body mt-3 mb-3 ml-4 mr-4">
                        <div class="row align-items-center">


                            <div class="mt-3 mb-3 ml-4 mr-4">
                                <h4 class="mb-1 mb-sm-0">Read Carefully!!!</h4>
                                Hosting services availabe for hosting your project, we gurantte hosting of ONE Month
                                without
                                removal of project.
                                <br>
                                <br>
                                If your link get disconneted within 3 days we can give you one free link.
                                <br>
                                <br>
                                We can also HOST for you, Note: its a paid service


                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>









        @endsection