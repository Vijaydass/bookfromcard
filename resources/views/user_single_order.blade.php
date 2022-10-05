@include('common.header')
<section class="section mt-120">
    <div class="row m-1">
        <div class="col-12">
            @if(Session::has('message'))
            <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                <i class="fa fa-check"></i><strong>Success!</strong> {{ Session::get('message') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
            @endif
            @if(Session::has('errormessage'))
            <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ Session::get('errormessage') }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
            @endif
            @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                <i class="fa fa-close"></i><strong>Error!</strong> {{ $error }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
            @endforeach
            @endif
            <div class="card my-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <img src="{{asset('storage/'.$orders->product_img)}}" alt="" width="80">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <h5 style="font-size: 14px;font-weight: bold;">{{$orders->product_name}}</h5>
                                    <p class="my-0">{{$orders->varient}}</p>
                                    <p class="my-0">{{$orders->color}}</p>
                                    <p class="my-0">Fulfil By - {{date('d M Y', strtotime($orders->fulfil_date))}}</p>
                                    <p class="my-0">Expected Delivery By -
                                        {{date('d M Y', strtotime($orders->delivery_date))}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <form action="{{route('single_order_update.order')}}" method="POST">
                                @csrf
                            <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <h6 class="p-0 mb-0">Order No :</h6>
                                        <p class="my-0" style="color:#006fbd;font-weight: 500;"> {{$orders->order_number}}
                                        </p>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <h6 class="p-0 mb-0" style="color:#006fbd;font-weight: 500;">Price </h6>
                                        <p class="my-0">₹ {{$orders->product_price}}</p>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <h6 class="p-0 mb-0">Tracking Id </h6>
                                        <input name="tracking_id" type="text" class="form-control"
                                            value="{{$orders->tracking_id}}">
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <h6 class="p-0 mb-0" style="color:#006fbd;font-weight: 500;">Commission : </h6>
                                        <p class="my-0">₹ {{$orders->commission}}</p>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <h6 class="p-0 mb-0" style="color:#006fbd;font-weight: 500;">OTP : </h6>
                                        <input name="otp" type="text" class="form-control" placeholder="Enter Otp"
                                            value="{{$orders->otp}}">
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <h6 class="p-0 mb-0" style="color:#006fbd;font-weight: 500;">Delivery Status :
                                        </h6>
                                        <select class="form-control" name="delivery_status" required>
                                            <option value="pending"
                                                <?php if($orders->delivery_status==='pending'){ echo 'selected'; }?>>
                                                Pending
                                            </option>
                                            <option value="delivered"
                                                <?php if($orders->delivery_status==='delivered'){ echo 'selected'; }?>>
                                                Delivered
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <input type="hidden" name="orderid" value="{{$orders->id}}" class="form-control"
                                            required>
                                        <button type="submit" class="btn btn-success mt-2">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-6 mb-2">

                                </div>
                                <div class="col-md-6 mb-2">
                                    <h6 class="p-0 mb-0" style="color:#006fbd;font-weight: 500;">You'll Receive :
                                    </h6>
                                    <p class="my-0">₹ {{$orders->product_price + $orders->commission}}</p>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <h6 class="p-0 mb-0" style="color:#006fbd;font-weight: 500;">Delivery Verified ?
                                    </h6>
                                    <p class="my-0 {{$orders->delivery_status?'text-success':'text-danger'}}">{{$orders->delivery_status==='delivered'?'Yes':'No'}}</p>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <h6 class="p-0 mb-0" style="color:#006fbd;font-weight: 500;">Payment Status ? : </h6>
                                    <p class="my-0 {{$orders->payment_status?'text-success':'text-danger'}}"
                                        style="font-weight: 500;">
                                        {{$orders->payment_status?Str::ucfirst($orders->payment_status):'Not Paid'}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h2 class="mt-2">Order Screenshot</h2>
                    <div class="row">
                        @foreach($photos as $image)
                        <div class="col-md">
                            <img id="uploadPreview" src="{{asset('storage/'.$image->image)}}" style="width: 200px;" />
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
</section>
@include('common.footer')