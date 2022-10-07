@include('common.header')

<section class="orders-listing">
    <div class="container">
        <h2 class="Page-title text-center">Orders List</span></h2>
        @foreach($orders as $list)
        <a href="{{url('user-order/'.$list->id)}}" style="text-decoration: none;color: black;width: 100%;">
        <div class="row order-item mb-4">
            <div class="col-9 col-lg-3 g-3">
                <div class="order-design">
                    <div class="row g-2 g-lg-3">
                        <div class="col-4 col-lg-5">
                            <figure>
                                <img src="{{asset('storage/'.$list->product_img)}}" alt="">
                            </figure>
                        </div>
                        <div class="col-8 col-lg-7">
                            <h4>{{$list->product_name}}</h4>
                            <div class="deal-info-row"><span class="product-list-label">Varient</span> : <span
                                    class="product-list-info">{{$list->varient}}</span></div>
                            <div class="deal-info-row"><span class="product-list-label">Color</span> : <span
                                    class="product-list-info">{{$list->color}}</span></div>
                            <div class="deal-info-row"><span class="product-list-label">Fullfil By</span> : <span
                                    class="product-list-info">30 Oct 2022</span></div>
                            <div class="deal-info-row"><span class="product-list-label">Price per unit</span> : <span
                                    class="product-list-info">₹ {{$list->product_price}}</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3 col-lg-2 g-3">
                <div class="deal-bank-merchant">
                    <div>
                        <span>Bank</span>
                        <figure>
                            <img src="img/HDFC_Bank_Logo.svg.png" alt="">
                        </figure>
                    </div>
                    <div>
                        <span>Store</span>
                        <figure>
                            <img src="img/HDFC_Bank_Logo.svg.png" alt="">
                        </figure>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-2 g-3">
                <div class="orrder-c-details">
                    <h5>Order No</h5>
                    <p>{{$list->order_number}}</p>
                </div>
                <div class="orrder-c-details">
                    <h5>Tracking ID</h5>
                    <p>{{$list->tracking_id}}</p>
                </div>
            </div>
            <div class="col-6 col-lg-2 g-3">
                <div class="orrder-c-details">
                    <h5>Delivery Status</h5>
                    <p class="{{$list->delivery_status?$list->delivery_status==='delivered':'text-success'}}">{{$list->delivery_status}}</p>
                </div>
                <div class="orrder-c-details">
                    <h5>Delivery Verified</h5>
                    <p class="{{$list->delivery_status?'text-success':'text-danger'}}">{{$list->delivery_status==='delivered'?'Yes':'No'}}</p>
                </div>
                <div class="orrder-c-details">
                    <h5>Paid?</h5>
                    <p class="{{$list->payment_status?'text-success':'text-danger'}}">{{$list->payment_status?$list->payment_status:'No'}}</p>
                </div>
            </div>
            <div class="col-12 col-lg-2 g-3">
                <div class="order-list-calc">
                    <div class="order-calc-box deal-spend">
                        <span class="box-tile">You spent</span>
                        <span class="box-amount">₹ {{$list->product_price}}</span>

                    </div>
                    <div class="order-calc-box deal-earn">
                        <span class="box-tile">Your commision <span class="commsion-status">({{$list->payment_status?$list->payment_status:'Pending'}})</span></span>
                        <span class="box-amount">₹ {{$list->commission}}</span>

                    </div>
                    <div class="order-calc-box deal-receive">
                        <span class="box-tile">You will receive</span>
                        <span class="box-amount">₹ {{$list->product_price + $list->commission}}</span>
                    </div>
                </div>
            </div>
        </div>
        </a>
        @endforeach
    </div>
</section>
@include('common.footer')