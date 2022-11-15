@include('common.header')
<section class="single-order">
    <div class="container">
        <h2 class="Page-title text-center">Order Details - <span>{{$orders->order_number}}</span></h2>
        <div class="row order-item">
            @if(Session::has('message'))
            <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                <i class="fa fa-check"></i><strong>Success!</strong> {{ Session::get('message') }}
                <button type="button" class="btn-close btn-close-white close" data-dismiss="alert"
                    aria-label="Close"></button>
            </div>
            @endif
            @if(Session::has('errormessage'))
            <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ Session::get('errormessage') }}
                <button type="button" class="btn-close btn-close-white close" data-dismiss="alert"
                    aria-label="Close"></button>
            </div>
            @endif
            @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                <i class="fa fa-close"></i><strong>Error!</strong> {{ $error }}
                <button type="button" class="btn-close btn-close-white close" data-dismiss="alert"
                    aria-label="Close"></button>
            </div>
            @endforeach
            @endif
            <div class="col-12 col-lg-3 order-item-design">
                <h4 class="single-order-titles">Item Detail</h4>
                <div class="row g-2 g-lg-3">
                    <div class="col-4 col-lg-5">
                        <figure>
                            <img src="{{asset('storage/'.$orders->product_img)}}" alt="">
                        </figure>
                    </div>
                    <div class="col-8 col-lg-7">
                        <h4 class="order-item-name">{{$orders->product_name}}</h4>
                        <div class="deal-info-row"><span class="product-list-label">Varient</span> : <span
                                class="product-list-info">{{$orders->varient}}</span></div>
                        <div class="deal-info-row"><span class="product-list-label">Color</span> : <span
                                class="product-list-info">{{$orders->color}}</span></div>
                        <div class="deal-info-row"><span class="product-list-label">Fullfil By</span> : <span
                                class="product-list-info">{{date('d M Y', strtotime($orders->fulfil_date))}}</span>
                        </div>
                        <div class="deal-info-row"><span class="product-list-label">Expected Delivery Date</span> :
                            <span class="product-list-info">{{date('d M Y', strtotime($orders->delivery_date))}}</span>
                        </div>
                        <div class="deal-info-row"><span class="product-list-label">Price per unit</span> : <span
                                class="product-list-info">₹ {{$orders->product_price}}</span></div>
                    </div>
                    <div class="col-12 col-lg-12">
                        <div class="deal-bank-merchant">
                            <div>
                                <span>Bank</span>
                                <figure>
                                    <img src="{{asset('storage/'.$bank->image)}}" alt="">
                                </figure>
                            </div>
                            <div>
                                <span>Store</span>
                                <figure>
                                    <img src="{{asset('storage/'.$store->image)}}" alt="">
                                </figure>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-lg-3 order-user-update">
                <h4 class="single-order-titles">Customer Update</h4>
                <form action="{{route('single_order_update.order')}}" method="POST">
                    @csrf
                    <div class="orrder-c-details">
                        <h5>Tracking ID</h5>
                        <p><input name="tracking_id" type="text" value="{{$orders->tracking_id}}"></p>

                    </div>
                    <div class="orrder-c-details">
                        <h5>Notes | OTP</h5>
                        <p><input name="otp" type="text" placeholder="Enter Otp" value="{{$orders->otp}}"></p>
                    </div>
                    <div class="orrder-c-details">
                        <h5>Delivery Status</h5>
                        <div>
                            <p class="{{$orders->delivery_status==='delivered'?'text-success':'text-danger'}}">
                            {{$orders->delivery_status==='delivered'?'Delivered':'Not Delivered'}}</p>
                        </div>
                    </div>
                    <div class="orrder-c-details">
                        <h5>Screenshot</h5>
                        <div>
                            <input type="file">
                        </div>
                    </div>
                    <input type="hidden" name="orderid" value="{{$orders->id}}" required>
                    <input type="hidden" name="delivery_status" value="{{$orders->delivery_status}}" required>
                    <button class="site-btn">Update</button>
                </form>
            </div>
            <div class="col-6 col-lg-3 order-admin-update">
                <h4 class="single-order-titles">Admin Update</h4>
                <div class="orrder-c-details">
                    <h5>Delivery Verified</h5>
                    <p class="{{$orders->delivery_status==='delivered'?'text-success':'text-danger'}}">
                        {{$orders->delivery_status==='delivered'?'Yes':'No'}}</p>
                </div>
                <div class="orrder-c-details">
                    <h5>Payment Status</h5>
                    <p class="{{$orders->payment_status?'text-success':'text-danger'}}">
                        {{$orders->payment_status?Str::ucfirst($orders->payment_status):'Not Paid'}}</p>
                </div>

            </div>
            <div class="col-12 col-lg-3 g-2 g-lg-3">
                <div class="order-list-calc">
                    <div class="order-calc-box deal-spend">
                        <span class="box-tile">You spent</span>
                        <span class="box-amount">₹ {{$orders->product_price}}</span>

                    </div>
                    <div class="order-calc-box deal-earn mx-1">
                        <span class="box-tile">Your commision <span
                                class="commsion-status">({{$orders->payment_status?Str::ucfirst($orders->payment_status):'Pending'}})</span></span>
                        <span class="box-amount">₹ {{$orders->commission}}</span>

                    </div>
                    <div class="order-calc-box deal-receive">
                        <span class="box-tile">You will receive</span>
                        <span class="box-amount">₹ {{$orders->product_price + $orders->commission}}</span>
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
</section>
@include('common.footer')