<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Tools Bank | Instant Verification</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link rel="shortcut icon" href="{{url('')}}/assets/images/favicon.png" />

  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <link href="{{url('')}}/assets/bootstrap-5/bootstrap.min.css" rel="stylesheet" />
  <script src="{{url('')}}/assets/bootstrap-5/bootstrap.bundle.min.js"></script>
  <script src="{{url('')}}/assets/dselect.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



  <style>
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }
    
    td, th {
      border: 1px solid #999999;
      text-align: left;
      padding: 8px;
    }
    
    tr:nth-child(even) {
      background-color: #999999;
    }
    </style>



  <!-- vendors CSS Files -->
  <link href="{{url('')}}/assets/vendors/aos/aos.css" rel="stylesheet">
  <link href="{{url('')}}/assets/vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{url('')}}/assets/vendors/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="{{url('')}}/assets/vendors/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="{{url('')}}/assets/vendors/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="{{url('')}}/assets/vendors/remixicon/remixicon.css" rel="stylesheet">
  <link href="{{url('')}}/assets/vendors/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{url('')}}/assets/css/style1.css" rel="stylesheet">


</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="/user/dashboard">Toolz Bank</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="{{url('')}}/assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="/user/dashboard">Dashboard</a></li>
          <li><a class="nav-link scrollto active" href="/user/instant">Server 1</a></li>
          <li><a class="nav-link scrollto active" href="/user/server2">Server 2</a></li>
          <li><a class="getstarted scrollto" href="#about">NGN {{ number_format(Auth::user()->wallet, 2) }}</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1"
          data-aos="fade-up" data-aos-delay="200">

          <p class="text-white">Hi {{ Auth::user()->name }}</p>
          <h1>Better Solutions For Your Verification</h1>
          <div class="d-flex justify-content-center justify-content-lg-start">
            <a href="/user/dashboard" class="btn-get-started scrollto">Fund Wallet - NGN {{
              number_format(Auth::user()->wallet,
              2) }}</a>
          </div>
        </div>



        <div class="col-lg-6 order-2" data-aos="zoom-in" data-aos-delay="200">
        
            <div class="col-12 col-md-12 mt-5">


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
              @if (session()->has('bad'))
              <div class="alert alert-danger">
                {{ session()->get('bad') }}
              </div>
              @endif
      
          <input id="myInput" class="form-control my-2" type="text" placeholder="Search..">

              <div style="height:300px; width:100%; overflow-y: scroll;">
                <div class="table-responsive">
                <table>
                  <thead>

                    <tr class="text-white">
                        <th>Service</th>
                        <th>Price</th>
                        <th>Count</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody id="myTable">

                  @forelse ($get_prices as $item)
               
                  <tr>
                    <td class="text-white">{{$item['name']}} | USA</td>
                    <td class="text-white">NGN {{number_format($item['cost'])}}</td>
                    <td class="text-white">{{$item['count']}}</td>
                    @if($item['count'] != 0 )
             
                      <td>
                      <a href="buy-sever2?service={{$item['code']}}&code={{$item['cost2']}}" class="btn btn-success btn-sm" role="button">Buy</a>
                      </td>
             
                    @endif
                  
                  </tr>
                  @empty
                  <tr colspan="20" class="text-center">No Record Found</tr>
                  @endforelse


              </tbody>
                
                </table>
              </div>
            </div>

              
     
                
            </div>

     

            




            {{-- <div class="row">


              <div class="col-6 col-md-6 mt-5 mb-5">
                <button type="submit" class="btn btn-primary btn-lg mb-5" role="button">Purchase Number</button>
              </div>
  
              <div class="col-6 col-md-6 mt-5 mb-5">
                <button type="submit" class="btn btn-warning btn-lg mb-5" role="button">Switch to Server 1</button>
              </div>


            </div> --}}

           

      










    </div>

  </section><!-- End Hero -->

  <main id="main">



    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Get Number</h2>
        </div>

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
          <div class="col-xl-12 col-md-12">
            <div class="icon-box">
              <div class="col-12 col-md-12">

                <hr>

                @if($number_view == 1)

                <div class="row">

                  <input type="country" value="{{ $nid }}" id="nid" hidden>


                  <input type="country" value="{{ $amount }}" id="amount" hidden>
                  <input type="country" value="{{ Auth::user()->id }}" id="user_id" hidden>


                  <h4>Waiting for SMS </h4>
                  <h4 style="color:red;" id="timer"> <span id="countdown"></span></h4>

                  <div class="row">

                    <div class="col-6 ">
                      <h5>Country </h5>
                      <p>{{$country_name ?? " "}} </p>

                    </div>

                    <div class="col-6">
                      <h5>Phone No</h5>
                      <p>+{{$number ?? " "}}</p>

                    </div>

                    <div class="col-8 my-4">

                      <textarea id="displaySms"> </textarea>

                    </div>
                  </div>

                  <div class="row mt-3">


                    <div class="col-6 mt-4">
                      <a href="#" id="requestButtonp" class="btn btn-success btn-lg" role="button">Get Sms</a>
                    </div>


                    <div class="col-6 my-4">
                      <a href="/user/ban-server2-number?nid={{$nid ?? " "}}"
                        class="btn btn-danger btn-lg" role="button">Cancle Order</a>
                    </div>




                  </div>





                  </div>


                  @elseif($number_view == 2)



                  <div class="row">

                    <div class="col-6 col-md-6">
                      @if($country != null )
                      <h5>County </h5> <img src="{{$flag ?? " "}}" alt="">
                      <p>{{$country ?? " "}} </p>
                      @endif
                    </div>

                    <div class="col-6 col-md-6">
                      @if($service != null )
                      <h5>Service</h5>
                      <p>{{$service ?? " "}}</p>
                      @endif
                    </div>


                    <div class="col-6 col-md-6">
                      @if($amount != null )
                      <h5>Amount</h5>
                      <p>NGN {{number_format($amount, 2)}}</p>
                      @endif
                    </div>





                    <div class="col-6 col-md-6">
                      @if($count != null )
                      <h5>Count</h5>
                      <p>{{number_format($count)}} Available</p>
                      @endif
                    </div>


                    <div class="col-6 col-md-6 mt-4">
                      @if($count ?? null != 0)
                      <a href="/user/buyinstant-number?service={{$service ?? " "}}&country={{$country  ?? " " }}&amount={{$amount  ?? " " }}"
                        id="requestButtonp" class="btn btn-success btn-md" role="button">Buy Number</a>
                      @endif
                    </div>






                  </div>

                  @else


                  <div class="row">


                    <h6>Select Country and Service to get a number for verification</h6>




                  </div>

                  @endif












                </div>
              </div>

            </div>



          </div>

          <div class="col-xl-12 col-md-12 my-5 d-flex justify-content-center">

            <div class="alert alert-danger rounded-pill col-lg-6 text-center" role="alert">
              YOU ARE SHOPPING FROM SERVER 2
            </div>

          </div>
    </section><!-- End Services Section -->



  </main>

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- vendors JS Files -->
  <script src="{{url('')}}/assets/vendors/aos/aos.js"></script>
  <script src="{{url('')}}/assets/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{url('')}}/assets/vendors/glightbox/js/glightbox.min.js"></script>
  <script src="{{url('')}}/assets/vendors/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="{{url('')}}/assets/vendors/swiper/swiper-bundle.min.js"></script>
  <script src="{{url('')}}/assets/vendors/waypoints/noframework.waypoints.js"></script>
  <script src="{{url('')}}/assets/vendors/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="{{url('')}}/assets/js/main.js"></script>



  <script>
    function displaySms(data) {
      const message = data.sms;
      const getSmsDiv = document.getElementById("getSms"); 
    }


    let repeatRequest = true;


    function makeRequest() {
    if (!repeatRequest) {
        return; // Stop the repetition
    }




    const country = document.getElementById('country_cc').value;
    const service = document.getElementById('service_cc').value;
    const sid = document.getElementById('sid').value;


    console.log(country);
    console.log(service);
    console.log(sid);



   

    const url = "{{ url('') }}/api/fetch-sms?country=" +country+"&service="+service+"&id="+sid;
    fetch(url)
  
        .then((response) => response.json())
        .then(data => {
        // Process the response data
        console.log(data);
        //displaySms(data);

        if (data.status === 'pending') {
            // Repeat the request after 5 seconds
            setTimeout(makeRequest, 10000);



        } else if (data.status === 'success') {

          const user_id = document.getElementById('user_id').value;
          const amount = document.getElementById('amount').value;

          document.getElementById("displaySms")
          .innerHTML += data.sms;

          var audio = new Audio('{{url('')}}/{{url('')}}/{{url('')}}/assets/Yeet.mp3');
          audio.play();

          fetch("{{ url('') }}/api/process", {
            method: "POST",
            body: JSON.stringify({
              user_id: user_id,
              amount: amount
            }),
            headers: {
              "Content-type": "application/json; charset=UTF-8"
            }

          })

            .then((response) => response.json())
            .then((json) => console.log(json));

       

         



            repeatRequest = false; // Stop the repetition
        }
        })

        //console.log(error);
        //.catch(error => {
        // Handle any errors that occurred during the request
        //console.error(error);
       // });
    }



    function startTimer(duration, display) {
        let timer = duration;
        const countdownElement = document.getElementById(display);

        const intervalId = setInterval(function() {
            const minutes = Math.floor(timer / 60);
            const seconds = timer % 60;

            countdownElement.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;





          if (timer === 0) {


          const user_id = document.getElementById('user_id').value;
          const amount = document.getElementById('amount').value;

         

            fetch("{{ url('') }}/api/ban", {
              method: "POST",
              body: JSON.stringify({
                user_id: user_id,
                amount: amount
              }),
              headers: {
                "Content-type": "application/json; charset=UTF-8"
              }
  
            })
  
              .then((response) => response.json())
              .then((json) => console.log(json));
           
            window.location.href = "{{url('')}}/user/instant";

          }

          timer--;
        }, 1000);
      }


  const btn =    document.getElementById('requestButtonp');
  btn.addEventListener("click", function(){
    //document.getElementById('requestButtonp').classList.add('hidden');

    startTimer(600, 'countdown');
    makeRequest()
  })


  </script>




  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>



</body>

</html>