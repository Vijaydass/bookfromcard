@include('common.header')
<section class="section profile mt-120">
    <div class="row m-5">
        <div class="col-12">
            @if(count($data)>0)
            @foreach($data as $list)
            <div class="card my-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h5 style="color:#006fbd;font-weight: 500;">{{$list->product_name}}</h5>
                        </div>
                        <div class="col-md-4">
                            <h6 class="p-0 mb-0 mt-2" style="color:#006fbd;font-weight: 500;">User Name </h6>
                            <p class="my-0">{{ucfirst(get_user($list->user_id)->name)}}</p>
                        </div>
                        <div class="col-md-4">
                            <h6 class="p-0 mb-0 mt-2" style="color:#006fbd;font-weight: 500;">Bonus Amount</h6>
                            <p class="my-0 text-success">₹ 50</p>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <img src="{{asset('storage/'.$list->product_img)}}" alt="" width="80">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <h5 style="color:#006fbd;font-weight: 500;">{{$list->product_name}}</h5>
                                    <p class="my-0">{{$list->varient}}</p>
                                    <p class="my-0">{{$list->color}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h6 class="p-0 mb-0" style="color:#006fbd;font-weight: 500;">Order Date :</h6>
                            <p class="my-0">
                                {{date('d M Y', strtotime($list->created_at))}}
                            </p>
                            <h6 class="p-0 mb-0 mt-2" style="color:#006fbd;font-weight: 500;">Tracking id </h6>
                            <p class="my-0">{{$list->tracking_id}}</p>
                            <h6 class="p-0 mb-0 mt-2" style="color:#006fbd;font-weight: 500;">Paid ? </h6>
                            <p class="my-0 {{$list->payment_status?'text-success':'text-danger'}}" style="font-weight: 500;">
                                            {{$list->payment_status?$list->payment_status:'No'}}</p>
                        </div>
                        <div class="col-md-4 mb-2">
                            <h6 class="p-0 mb-0 mt-2" style="color:#006fbd;font-weight: 500;">User Name </h6>
                            
                            <h6 class="p-0 mb-0 mt-2" style="color:#006fbd;font-weight: 500;">Commission </h6>
                            <p class="my-0">₹ {{$list->commission}}</p>
                            <h6 class="p-0 mb-0 mt-2" style="color:#006fbd;font-weight: 500;">Bonus Amount</h6>
                            
                        </div>                        
                    </div> -->
                </div>
            </div>
            @endforeach
            <h5 style="color:#006fbd;font-weight: 500;">
                Total : <b class="text-black">{{50*$total}}</b>
            </h5>
            @else
            <h4 class="title text-warning">Sorry no Referral User is available right now</h4>
            @endif
        </div>
    </div>
</section>
@include('common.footer')