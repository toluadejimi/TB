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
                <img src="{{url('')}}/assets/images/dashboard/Group126@2x.png" class="gradient-corona-img img-fluid"
                  alt="">
              </div>
              <div class="col-5 col-sm-7 col-xl-8 p-0">
                <h4 class="mb-1 mb-sm-0">Welcome to Digitz</h4>
                <p class="mb-0 font-weight-normal d-none d-sm-block">Get Google Voice, Text Now, Domain GV and many more...
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
    <div class="row">



      <div class="col-xl-4 col-sm-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-9">
                <div class="d-flex align-items-center align-self-start">
                  <h3 class="mb-0">NGN {{ number_format(Auth::user()->wallet,2) }}</h3>
                </div>
              </div>
              <div class="col-3">
                <div class="icon icon-box-success ">
                  <span class="mdi mdi-arrow-top-right icon-item"></span>
                </div>
              </div>
            </div>
            <h6 class="text-muted font-weight-normal">Total Balance</h6>
          </div>
        </div>
      </div>




      <div class="col-xl-4 col-sm-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-7">
                <div class="d-flex align-items-center align-self-start">
                  <h3 class="mb-0">{{ $tc_log }}</h3>
                </div>
              </div>
              <div class="col-4">
                <a href="device" class="badge badge-outline-success my-2">BuyLog</a><br>


              </div>
            </div>
            <h6 class="text-muted font-weight-normal">Total Purchased Logs</h6>
          </div>
        </div>
      </div>




      <div class="col-xl-4 col-sm-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-9">
                <div class="d-flex align-items-center align-self-start">
                  <h3 class="mb-0">NGN {{ number_format($amount, 2) }}</h3>
                  <p class="text-success ms-2 mb-0 font-weight-medium">+3.5%</p>
                </div>
              </div>
              <div class="col-3">
                <div class="icon icon-box-success ">
                  <span class="mdi mdi-arrow-top-right icon-item"></span>
                </div>
              </div>
            </div>
            <h6 class="text-muted font-weight-normal">Total Spent</h6>
          </div>
        </div>
      </div>



    </div>






    <div class="row">

      <div class="col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h5>Fund Wallet</h5>

            <form action="fund-wallet" method="get">
              @csrf
              <div class="row">
                <div class="col-12  my-auto">
                  <div class="d-flex d-sm-block d-md-flex align-items-center">

                    <div class="row">
                      <div class="col-10 my-2">
                        <input type="number" name="amount" class="form-control" required autofocus>
                      </div>


                      <div class="col-sm-8 my-2">
                        <button type="submit" class="btn btn-outline-success my-4 submit-button float-left">{{ __('Deposit Funds') }}</button>

                      </div>

                    </div>
                  </div>
                  <h6 class="text-muted font-weight-normal">We do not refund any successful deposit</h6>

                  


                </div>




              </div>
            </form>
          </div>
        </div>
      </div>


      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Other Channles</h4>

            <div class="row">
              <div class="col-6 my-2">
                <a href="#" class="badge badge-outline-success my-2">Join our whatsapp group></a><br>
              </div>


              <div class="col-sm-6 my-2">
                <a href="#" class="badge badge-outline-success my-2">Get Number for verification</a><br>
              </div>


              <div class="col-sm-6 my-2">
                <a href="#" class="badge badge-outline-danger my-2">Rules and Regulations</a><br>
              </div>

            </div>



          </div>
        </div>
      </div>


    </div>



    <div class="row ">
      <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Order Status</h4>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th class="col-1">{{ __('Title') }}</th>
                    <th class="col-4">{{ __('Amount') }}</th>
                    <th class="col-1">{{ __('Type') }}</th>
                    <th class="col-1">{{ __('Status') }}</th>
                    <th class="col-1 text-left">{{ __('Date') }}</th>
                  </tr>
                </thead>
                @if(count($transactions) != 0)
                <tbody class="list">
                  @foreach($transactions ?? [] as $trx)
                  <tr>
                    @if($trx->type == "2")
                    <td><span>Fund Wallet</span></td>
                    @elseif($trx->type == "1")
                    <td><span>Log purchase</span></td>
                    @else
                    <td><span>Refund</span></td>
                    @endif



                    <td class="">
                      {{ number_format($trx->amount, 2) }}
                    </td>

                    @if($trx->type == "1")
                    <td><span class="badge rounded-pill bg-danger text-white ">Debit</span></td>
                    @elseif($trx->type == "2")
                    <td><span class="badge rounded-pill bg-success text-white">Credit</span></td>
                    @else
                    <td><span class="badge rounded-pill bg-warning text-white">Pending</span></td>
                    @endif

                    @if($trx->status == "2")
                    <td><span class="badge rounded-pill bg-danger text-white ">Decline</span></td>
                    @elseif($trx->status == "1")
                    <td><span class="badge rounded-pill bg-success text-white">Successful</span></td>
                    @else
                    <td><span class="badge rounded-pill bg-warning text-white">Pending</span></td>
                    @endif




                    <td class="">
                      {{ $trx->created_at->format('d F y H i s') }}
                    </td>
                  </tr>
                  @endforeach
                </tbody>
                @endif
              </table>
              @if(count($transactions) == 0)
              <div class="text-center mt-2">
                <div class="alert  bg-gradient-primary text-white">
                  <span class="text-left">{{ __('No Transaction found') }}</span>
                </div>
              </div>
              @endif
            </div>
            <div class="card-footer py-4">
              {{ $transactions->appends($request->all())->links('vendor.pagination.bootstrap-4') }}
            </div>
          </div>
        </div>
      </div>
    </div>






  </div>
  <!-- content-wrapper ends -->
  @endsection