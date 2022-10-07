@include('common.header')
@if(Str::lower($product->store->name) === 'amazon')
<?php 
    $url = amazon_url($product->url, 'dp/', '/'); 
    $full_url = 'https://www.amazon.in/dp/'.$url.'?tag=amazon03b0e6-21&linkCode=ogi&th=1&psc=1';
?>
@else
<?php 
    $full_url = $product->url;
?>
@endif

<section class="latest-products spad">
    <div class="container">
        <div class="row justify-content-md-center gy-3" id="single-deal">
            <div class="col-12 col-lg-9 single-deal-details">
                <div class="row gy-3">
                    <div class="col-12 col-lg-5">
                        <div class="single-deal-img">
                            <h4 class="deal-title">{{$product->name}}</h4>
                            <hr>
                            <div class="row gy-sm-0">
                                <div class="col-6 col-lg-12">
                                    <figure class="deal-image">
                                        <img src="{{asset('storage/'.$product->image)}}" alt="">
                                    </figure>
                                </div>
                                <div class="col-6 col-lg-12">
                                    <hr class="d-none d-lg-block">
                                    <div class="deal-bank-merchant">
                                        <div>
                                            <span>Bank</span>
                                            <figure>
                                                <img src="{{asset('storage/'.$product->bank->image)}}" alt="">
                                            </figure>
                                        </div>
                                        <div>
                                            <span>Store</span>
                                            <figure>
                                                <img src="{{asset('storage/'.$product->store->image)}}" alt="">
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-7">
                        <div class="single-deal-info">
                            <h4>My Orders / Tracking <a href="{{$full_url}}" class="site-btn">View Product</a></h4>
                            <div class="deal-info-row"><span class="product-list-label">Varient</span> : <span
                                    class="product-list-info">{{$product->varient}}</span></div>
                            <div class="deal-info-row"><span class="product-list-label">Color</span> : <span
                                    class="product-list-info">{{$product->color}}</span></div>
                            <div class="deal-info-row"><span class="product-list-label">Fullfil By</span> : <span
                                    class="product-list-info">{{date('d M Y', strtotime($product->fulfil_date))}}</span>
                            </div>
                            <div class="deal-info-row"><span class="product-list-label">Price per unit</span> : <span
                                    class="product-list-info">{{$product->price}}</span></div>
                            <div class="deal-info-row"><span class="product-list-label">Commision</span> : <span
                                    class="product-list-info">{{$product->commission}}</span></div>
                            <div class="deal-info-row"><span class="product-list-label">Address</span> : <span
                                    class="product-list-info">
                                    @if($product->address->address)
                                    {{$product->address->address}}
                                    @else
                                    {{$product->custom_address}}
                                    @endif</span></div>
                                    <form class="form-card" action="{{route('fullfill_order.store')}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <article class="card" style="padding: 10px; margin-top: 5px;">
                                    <div class="form-card">
                                        <div class="row justify-content-between text-left">
                                            <div class="form-group col-sm-6 flex-column d-flex"> <label
                                                    class="form-control-label">Name<span class="text-danger">
                                                        *</span></label> <input type="text" name="name" required> </div>
                                            <div class="form-group col-sm-6 flex-column d-flex"> <label
                                                    class="form-control-label">Phone Number<span class="text-danger">
                                                        *</span></label> <input type="text" name="phone_number"
                                                    required> </div>
                                            <div class="form-group col-sm-6 flex-column d-flex"> <label
                                                    class="form-control-label">Order Number<span class="text-danger">
                                                        *</span></label> <input type="text" id="ordernumber"
                                                    name="ordernumber"> </div>
                                            <div class="form-group col-sm-6 flex-column d-flex"> <label
                                                    class="form-control-label">Tracking ID</label> <input type="text"
                                                    id="lname" name="tracking_id"> </div>
                                        </div>
                                        <div class="row justify-content-between text-left">
                                            <div class="form-group col-sm-6 flex-column d-flex"> <label
                                                    class="form-control-label">Expected Date of
                                                    Delivery</label> <input type="date" id="date" name="expected_date"
                                                    required>
                                            </div>

                                            <div class="form-group col-sm-6 flex-column d-flex">
                                                <label class="form-control-label">Order Screenshot</label>
                                                <input class="box__file" type="file" name="files[]" id="file"
                                                    data-multiple-caption="{count} files selected" multiple required />
                                            </div>

                                        </div>
                                    </div>
                                </article>
                                <input type="hidden" name="user_id" value="{{Auth::id()}}" required>
                                <input type="hidden" name="product_id" value="{{$product->id}}" required>
                                <input type="hidden" name="commission" value="{{$product->commission}}" required>
                                <a href="{{url('/')}}" class="btn btn-warning submit mt-2" data-abc="true"> <i
                                        class="fa fa-chevron-left"></i> Back to Deals</a>

                                <button type="submit" class="btn btn-warning submit mt-2" data-abc="true">
                                    <i class="fa fa-chevron-right"></i>Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="deal-calc">
                    <div class="single-deal-box deal-spend">
                        <span class="box-amount">₹ {{$product->price}}</span>
                        <span class="box-tile">You will spend</span>
                    </div>
                    <div class="single-deal-box deal-receive">
                        <span class="box-amount">₹ {{$product->price + $product->commission}}</span>
                        <span class="box-tile">You will receive</span>
                    </div>
                    <div class="single-deal-box deal-earn">
                        <span class="box-amount">₹ {{$product->commission}}</span>
                        <span class="box-tile">You will earn</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('common.footer')