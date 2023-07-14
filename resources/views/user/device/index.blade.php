@extends('layouts.main.headerone')

@section('content')



<div class="main-panel">
  <div class="content-wrapper">
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

      <div class="col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body mb-3">
            <h5 class="mb-4">Buy log, Google Voice, Domain GV, Textnow and many more</h5>

            <form action="buy-now" method="post">
              @csrf

              <div class="row">

                <div class="col-xl-6 col-md-6">
                  <div class="form-group">
                    <label>Choose Item</label>
                    <select id="country-dropdown" required name="product" class="form-control text-white">
                      <option value="">-- Select Item --</option>
                      @foreach ($products as $data)
                      <option value="{{$data->item_id}}">
                        {{$data->item_name}}
                      </option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="col-xl-6 col-md-6">


                  <div class="form-group mb-3">
                    <label>Choose Area Code</label>
                    <select id="state-dropdown" rwquired name="area_code" class="form-control text-white">
                    </select>



                  </div>

                </div>
                <div class="col-xl-6 col-md-6">



                  <div class="form-group">
                    <label>Amount (NGN)</label>
                    <select id="city-dropdown" required name="amount" class="form-control text-white">
                    </select>
                  </div>


                </div>

                {{-- <div class="col-xl-6 col-md-6">


                  <div class="form-group mb-3">
                    <label>Quantity</label>
                    <input type="number" name="qty[]" id="qty" value="1" required class="form-control text-white">
                    </select>
                  </div>

                </div> --}}

                <div class="col-xl-6 col-md-6">

                  {{-- <div class="my-1">
                    <p>Total Price: <strong id="totalPrice">NGN 0</strong></p>
                  </div> --}}

                  <div>
                    <button type="submit" class="btn btn-inverse-success my-4  btn-lg submit-button float-left">{{
                      __('Buy Now') }}</button>
                  </div>
                </div>


              </div>

            </form>


            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script>
              $(document).ready(function () {
                     
                               /*------------------------------------------
                               --------------------------------------------
                               Country Dropdown Change Event
                               --------------------------------------------
                               --------------------------------------------*/
                               $('#country-dropdown').on('change', function () {
                                   var item_id = this.value;
                                   $("#state-dropdown").html('');
                                   $.ajax({
                                       url: "{{url('api/fetch-code')}}",
                                       type: "POST",
                                       data: {
                                            item_id: item_id,
                                           _token: '{{csrf_token()}}'
                                       },
                                       dataType: 'json',
                                       success: function (result) {
                                          console.log(result)
                                           $('#state-dropdown').html('<option value="">-- Select Area Code --</option>');
                                           $.each(result.states, function (key, value) {
                                               $("#state-dropdown").append('<option value="' + value
                                                   .id + '">' + value.area_code + '</option>');
                                           });
                                           $('#city-dropdown').html('<option value="">-- Amount --</option>');
                                       }
                                   });
                               });
                     
                               /*------------------------------------------
                               --------------------------------------------
                               State Dropdown Change Event
                               --------------------------------------------
                               --------------------------------------------*/
                               $('#state-dropdown').on('change', function () {
                                   var id = this.value;
                                   $("#city-dropdown").html('');
                                   $.ajax({
                                       url: "{{url('api/fetch-amount')}}",
                                       type: "POST",
                                       data: {
                                           id: id,
                                           _token: '{{csrf_token()}}'
                                       },
                                       dataType: 'json',
                                       success: function (res) {
                                          console.log(res)
                                           $('#city-dropdown').html(res.price);
                                           $.each(res.cities, function (key, value) {
                                               $("#city-dropdown").append('<option value="' + value.price + '">' + value.price + '</option>');
                                           });
                                       }
                                   });
                               });
                     
                           });
            </script>


            <script>
              var quantityInput = document.getElementById("qty");
                     var totalPriceElement = document.getElementById("totalPrice");
                     var amount = document.getElementById("city-dropdown");

                 
                     quantityInput.addEventListener("change", updateTotalPrice);
                 
                     function updateTotalPrice() {
                       var quantity = parseInt(quantityInput.value);
                       var price = parseInt(amount.value); // Example price per item
                       var totalPrice = quantity * price;
                       console.log(totalPrice);
                       console.log(price);
                       console.log(amount);

                       totalPriceElement.textContent = "NGN " + totalPrice;
                     }
            </script>



          </div>
        </div>
      </div>



      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Instant SMS for Verification</h4>
            <p> Receive instant sms to verify any authentication process <br><br>

              Whatsapp | Twitter | Facebook | Wechat | Bank verifications and many more <br>

              <a href="instant" class="btn btn-inverse-warning btn-lg my-4 submit-button float-left">{{
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





           

            </div>



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
              Note: Buy clicking on buy you have agreed with our terms of service / Replacemnt.
              <br>
              <br>
              Terms: All logs been uploaded to our platform is been tested before uploaded, therefore we only replace
              logs
              that the password is incorrect. Replacement is been done within 1 hour of the logs in your hands.
              <br>
              <br>
              Logs we replace: Gmail Google voice, TEXTNOW, Domain Google voice, Talkatone
              <br>
              <br>
              Knowledge: If you get a TEXTNOW logs, try to login directly from the TEXTNOW App or Login using Google
              account.
              <br>
              If your Gmail google voice get disabled, kindly request a review from Google they will unblock it for you
              within 1 to 2 days

            </div>

          </div>
        </div>
      </div>
    </div>


  </div>









  @endsection