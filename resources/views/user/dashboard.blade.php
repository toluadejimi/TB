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
      {{ session()->get('message') }}x
    </div>
    @endif
    @if (session()->has('error'))
    <div class="alert alert-danger">
      {{ session()->get('error') }}
    </div>
    @endif


    @if($link->status == 1)
    <div class="col-12 stretch-card mb-3">
      <div class="card badge-outline bg-success">
        <div class="card-body">

          <marquee>
            <h5>{{ $link->data }}</h5>
          </marquee>

        </div>
      </div>
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
                <h4 class="mb-1 mb-sm-0">Welcome {{ Auth::user()->name }}</h4>
                <p class="mb-0 font-weight-normal d-none d-sm-block">Get Google Voice, Text Now, Domain GV and many
                  more...
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


      <div class="col-sm-12 grid-margin stretch-card">

        <div class="card my-2">
          <div class="card-body">
            <h5>Quick Links</h5>


            <div class="col-12 my-auto">
              <a href="device" class="btn btn-inverse-primary text-white my-2 btn-lg submit-button">{{
                __('Buy Numbers') }}</a>

                <a href="instant" class="btn btn-inverse-danger text-white my-2 btn-lg submit-button">{{
                  __('Instant Verification') }}</a>

               

              {{-- <a href="rent" class="btn btn-inverse-danger text-white my-2 btn-lg submit-button">{{
                __('Rent Number') }}</a> --}}

              {{-- <a href="vpn" class="btn btn-inverse-success text-white my-2 btn-lg submit-button">{{
                __('Buy VPN/Netflix') }}</a> --}}


              {{-- <a href="debitcard" class="btn btn-inverse-warning text-white my-2 btn-lg submit-button">{{
                __('Buy Credit/Debit Card') }}</a> --}}

              <a href="host" class="btn btn-inverse-warning text-white my-2 btn-lg submit-button">{{
                __('Buy Bullet Proof Hosting') }}</a>

                <a href="logs" class="btn btn-inverse-danger text-white my-2 btn-lg submit-button">{{
                  __('View Purchased Number') }}</a>


            </div>

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
                        <label class="mb-2">Enter amount to fund (NGN)</label>
                        <input type="number" name="amount" class="form-control text-white" required autofocus>
                      </div>


                      <div class="col-sm-8 my-2">
                        <button type="submit" class="btn btn-inverse-success btn-lg my-4 submit-button float-left">{{
                          __('Deposit Funds') }}</button>

                      </div>

                    </div>
                  </div>

                  <hr>
                  <br>

                  <p> You can also fund with crypto we accept only <strong> USDT</strong>
                    <br>

                    <button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                      class="btn btn-inverse-primary btn-lg my-4 submit-button float-left">{{ __('Fund with USDT')
                      }}</button>


                </div>

                <h6 class="text-muted font-weight-normal">We do not refund any successful deposit</h6>


                <!-- Button trigger modal -->






              </div>
            </form>
          </div>
        </div>
      </div>



      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Instant SMS for Verification</h4>
            <p> Receive instant sms to verify any authentication process <br>

              <a href="device" class="btn btn-inverse-success btn-lg my-4 submit-button float-left">{{
                __('Get Number') }}</a>

            <div class="row">

              {{--
              <div class="col-6 my-2">
                <p> Choose Country <br>
                  <select name="department" id="department" class="form-control text-white">
                    <option value=""> -- Select One --</option>
                    @foreach ($getcountry as $val)
                    <option value="{{ $val['code'] }}">{{ $val['title'] }}</option>
                    @endforeach
                  </select>
              </div> --}}





              <hr>

              <div class="col-sm-12 my-2">
                <p> For support | Join our whatsapp channel <br>
                  <a href="#" class="btn btn-inverse-warning my-2">Join our channel</a>
              </div>

              <hr>

              <div class="col-sm-12 my-2">
                <p> Rules & Regulations | Carefuly read our rules and regulations <br>
                  <a href="#" class="btn btn-inverse-danger my-2">Rules and Regulations</a><br>
              </div>

            </div>



          </div>
        </div>
      </div>


      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Other Channles</h4>

            <div class="row">
              <div class="col-12 my-2">
                <p> For other products | Website building | Spamming Tools | Dating Tools | Bullet proof Link Hosting
                  and many more <br>
                  <a href="#" class="btn btn-inverse-secondary  my-2">Make Request</a>
              </div>

              <hr>

              <div class="col-sm-12 my-2">
                <p> For support | Join our whatsapp channel <br>
                  <a href="#" class="btn btn-inverse-warning my-2">Join our channel</a>
              </div>

              <hr>

              <div class="col-sm-12 my-2">
                <p> Rules & Regulations | Carefuly read our rules and regulations <br>
                  <a href="#" class="btn btn-inverse-danger my-2">Rules and Regulations</a><br>
              </div>

            </div>



          </div>
        </div>
      </div>


      <!-- Modal -->

      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Fund With USDT | Rate - {{$rate}}/USD </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="fund-wallet-usdt" method="post">
                @csrf
                <div class="row">
                  <div class="col-12  my-auto">
                    <div class="d-flex d-sm-block d-md-flex align-items-center">

                      <div class="row">


                        <div class="col- my-2">
                          <label class="mb-3 text-warning">Send USDT only to this address (BEP20)</label><br>
                          <p class="mb-3 text-white">scan or copy address</p><br>


                          {!!
                          SimpleSoftwareIO\QrCode\Facades\QrCode::size(200)->generate('0x54879ae031850bc7ea21f14b96a3a0bff2373fd7')
                          !!}
                          <br><br>
                          <p> {{"USDT ADDRESS"}}
                          <p>
                          <h4> {{"0x54879ae031850bc7ea21f14b96a3a0bff2373fd7"}}<h4>

                        </div>

                        <hr>


                        <div class="col- my-2">
                          <label class="mb-2">Pay with Binance</label>
                          <h4> {{"My Pay ID - 135034470"}}<h4>
                        </div>


                        <hr>


                        <div class="col-8">
                          <label class="mb-2">Enter amount sent (USD) | Rate {{ $rate }}</label>
                          <input type="number" id="input1" onkeyup="sumNumbers()" name="amount"
                            class="form-control text-white" required autofocus>
                        </div>

                        <h4 class="mt-3 text-success" id="result">You get NGN 0.00</h4>


                        <div class="col-sm-8">
                          <button type="submit" class="btn btn-inverse-success btn-lg my-4 submit-button float-left">{{
                            __('I have Sent the Money') }}</button>


                          <script>
                            function sumNumbers() {
                                let input1 = parseInt(document.getElementById('input1').value);
                                let input2 = {{ $rate }};
                                let sum = input1 * input2;
                                
                                if (!isNaN(sum)) {
                                  document.getElementById('result').textContent = "You get NGN " + sum;
                                } else {
                                  document.getElementById('result').textContent = "";
                                }
                              }
                           
                              
                              
                              
                              
                              
                          </script>

                        </div>

                      </div>
                    </div>

                  </div>
              </form>

              <hr>

              <div class="col- my-2">
                <h4 class="text-danger"> {{"Please Read Carefully"}}<h4>
              </div>

              <p> After payment send a screenshot for payment confirmation

                <a href="#" class="btn btn-inverse-warning my-2">Send screenshot here</a>



            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal -->




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
                    @elseif($trx->status == "3")
                    <td><span class="badge rounded-pill bg-primary text-white">Pending Confirmation</span></td>
                    @else
                    <td><span class="badge rounded-pill bg-danger text-white">Declined</span></td>
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