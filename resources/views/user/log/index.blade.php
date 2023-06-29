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



  <div class="col-xl-6 col-sm-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-9">
            <div class="d-flex align-items-center align-self-start">
              <h3 class="mb-0">{{ number_format($total_sold) }}</h3>
            </div>
          </div>
          <div class="col-3">
            <div class="icon icon-box-success ">
              <span class="mdi mdi-arrow-top-right icon-item"></span>
            </div>
          </div>
        </div>
        <h6 class="text-muted font-weight-normal">Total Logs</h6>
      </div>
    </div>
  </div>




  <div class="col-xl-6 col-sm-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-7">
            <div class="d-flex align-items-center align-self-start">
              <h3 class="mb-0">NGN {{ number_format($total_amount, 2) }}</h3>
            </div>
          </div>
          <div class="col-3">
            <div class="icon icon-box-success ">
              <span class="mdi mdi-arrow-top-right icon-item"></span>
            </div>
          </div>
        </div>
        <h6 class="text-muted font-weight-normal">Total Money Spent</h6>
      </div>
    </div>
  </div>




 



</div>










<div class="row ">
  <div class="col-12 grid-margin">
    <div class="card">
        @if(count($solds ?? []) == 0)
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-body">
						<center>
							<h3 class="text-center">{{ __('!Opps You Have Not Created Any Log Yet') }}</h3>
						</center>
					</div>
				</div>
			</div>
		</div>
		@else
		<div class="card">			
			<div class="card-body">
				<div class="row">
					<div class="col-sm-12 table-responsive">
						<table class="table col-12">
							<thead>
								<tr>
									<tr>
										<th class="col-1">{{ __('Logs') }}</th>
										<th class="col-1">{{ __('Area Code') }}</th>
										<th class="col-4">{{ __('Amount') }}</th>
										<th class="col-1">{{ __('Status') }}</th>
										<th class="col-1">{{ __('Date') }}</th>
									  </tr>
								</tr>
							</thead>
							<tbody class="tbody">
								@foreach($solds ?? [] as $trx)
								<tr>
									
									<td class="text-white">
										{{ $trx->data }}
									</td>
									<td class="">
										{{ $trx->area_code }}
									</td>
					  
									<td class="">
									  {{ number_format($trx->amount, 2) }}
									</td>
					  
									@if($trx->status == "3")
									<td><span class="badge rounded-pill bg-danger text-white ">Decline</span></td>
									@elseif($trx->status == "0")
									<td><span class="badge rounded-pill bg-success text-white">Sold</span></td>
									@else
									<td><span class="badge rounded-pill bg-warning">Pending</span></td>
									@endif
		
					  
									<td class="">
									  {{ $trx->created_at->format('d F y H i s') }}
									</td>
								  </tr>
								@endforeach
							</tbody>
						</table>

            <p class="text-muted"> Swipe/Move right to get more info
						<div class="d-flex justify-content-center">{{ $solds->links('vendor.pagination.bootstrap-4') }}</div>
					</div>
				</div>
			</div>
		</div>
		@endif
    </div>
  </div>
</div>






</div>




@endsection
