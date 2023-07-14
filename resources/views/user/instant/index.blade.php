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

    <div class="row">
      <div class="col-sm-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body mb-3">
            <h4 class="card-title">Instant SMS for Verification</h4>
            <p> Receive instant sms to verify any authentication process <br><br>

              Whatsapp | Twitter | Facebook | Wechat | Bank verifications and many more <br>




            <div class="row">

              <form action="check" method="post">
                @csrf
                <div class="col-xl-12 col-md-12">
                  <div class="form-group">
                    <label>Choose Country</label>

                    <form action="get-product" method="GET">
                      @csrf

                      <select id="country-dropdown" required name="country" class="form-control text-white">
                        <option value="">-- Select Item --</option>
                        @foreach ($country as $data)
                        <option value="{{$data->text_en}}">
                          {{$data->text_en}}
                        </option>
                        @endforeach
                      </select>

                  </div>


                  <div class="col-xl-12 col-md-12">
                    <div class="form-group">
                      <label>Choose Item</label>

                      <select id="country-dropdown" required name="country" class="form-control text-white">
                        <option value="">-- Select Item --</option>
                        @foreach ($product as $data)
                        <option value="{{$data->product}}">
                          {{$data->product}}
                        </option>
                        @endforeach
                      </select>


                    </div>
                  </div>

                  <div>
                    <button type="submit" class="btn btn-inverse-success my-4  btn-lg submit-button float-left">{{
                      __('Check Avalibility') }}</button>
                  </div>
              </form>


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