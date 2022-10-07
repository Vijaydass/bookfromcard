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

<!-- Latest Product Begin -->
<section class="single-order">
        <div class="container">
            <h2 class="Page-title text-center">Order Details - <span>123456</span></h2>
            <div class="row order-item">
                <div class="col-12 col-lg-3 order-item-design">
                        <h4 class="single-order-titles">Item Detail</h4>
                        <div class="row g-2 g-lg-3">
                            <div class="col-4 col-lg-5">
                                <figure>
                                    <img src="img/products/phone.jpeg" alt="">
                                </figure>
                            </div>
                            <div class="col-8 col-lg-7">
                                <h4 class="order-item-name">SAMSUNG Galaxy F23</h4>
                                <div class="deal-info-row"><span class="product-list-label">Varient</span> : <span class="product-list-info">4-128</span></div>
                                <div class="deal-info-row"><span class="product-list-label">Color</span> : <span class="product-list-info">Blue</span></div>
                                <div class="deal-info-row"><span class="product-list-label">Fullfil By</span> : <span class="product-list-info">30 Oct 2022</span></div>
                                <div class="deal-info-row"><span class="product-list-label">Expected Delivery Date</span> : <span class="product-list-info">12000</span></div>
                                <div class="deal-info-row"><span class="product-list-label">Price per unit</span> : <span class="product-list-info">12000</span></div>
                            </div>
                            <div class="col-12 col-lg-12">
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
                        </div>
                </div>
                
                <div class="col-6 col-lg-3 order-user-update">
                    <h4 class="single-order-titles">Customer Update</h4>
                    <form>
                        <div class="orrder-c-details">
                            <h5>Tracking ID</h5>
                            <p><input type="text"></p>
                        </div>
                        <div class="orrder-c-details">
                            <h5>Notes | OTP</h5>
                            <p><input type="text"></p>
                        </div>
                        <div class="orrder-c-details">
                            <h5>Delivery Status</h5>
                            <div>
                                <select class="cart-select">
                                    <option>Pending</option>
                                    <option>Deliverd</option>
                                </select>
                            </div>
                        </div>
                        <div class="orrder-c-details">
                            <h5>Screenshot</h5>
                            <div>
                                <input type="file">
                                <a href="#" class="view-image">View image</a>
                            </div>
                        </div>
                        <button class="site-btn">Update</button>
                    </form>
                </div>
                <div class="col-6 col-lg-3 order-admin-update">
                    <h4 class="single-order-titles">Admin Update</h4>
                    <div class="orrder-c-details">
                        <h5>Delivery Verified</h5>
                        <p>No</p>
                    </div>
                    <div class="orrder-c-details">
                        <h5>Payment Status</h5>
                        <p>Not Paid</p>
                    </div>
                    
                </div>
                <div class="col-12 col-lg-3 g-2 g-lg-3">
                    <div class="order-list-calc">
                        <div class="order-calc-box deal-spend">
                            <span class="box-tile">You spent</span>
                            <span class="box-amount">₹ {{$product->price}}</span>
                            
                        </div>
                        <div class="order-calc-box deal-earn">
                            <span class="box-tile">Your commision <span class="commsion-status">(pending)</span></span>
                            <span class="box-amount">₹ {{$product->commission}}</span>
                            
                        </div>
                        <div class="order-calc-box deal-receive">
                            <span class="box-tile">You will receive</span>
                            <span class="box-amount">₹ {{$product->price + $product->commission}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Product End -->

<section class="pricing-area mt-100 mb-20">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-10">
                <div class="section-title text-center pb-25">
                    <h3 class="title">Full Fill Order</h3>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            

            <div class="col-lg-4 col-md-6 mt-2">
                <div class="small-box p-3 bg-warning" style="border-radius: 6px;">
                    <div class="inner">
                        <h3></h3>
                        <p>You will receive</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mt-2">
                <div class="small-box p-3" style="border-radius: 6px;background: #2bcf50!important;">
                    <div class="inner">
                        <h3></h3>
                        <p>You will earn</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column">
                        <img src="{{asset('storage/'.$product->image)}}" alt="Profile">
                        <h5><a href="{{$full_url}}" target="_blank"
                                style="text-decoration: none;">{{$product->name}}</a></h5>
                        <div class="social-links mt-2 row">
                            <div class="col-6">
                                Store
                                <img src="{{asset('storage/'.$product->store->image)}}" style="height: 50px;">
                            </div>
                            <div class="col-6">
                                Bank
                                <img src="{{asset('storage/'.$product->bank->image)}}" style="height: 50px;">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <!-- Bordered Tabs -->
                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            <h5 class="card-title"> <a href="{{$full_url}}" class="btn btn-primary"
                                    target="_blank">Fulfil Order</a></h5>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Varient :</div>
                                <div class="col-lg-9 col-md-8">
                                    <p>{{$product->varient}}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Color :</div>
                                <div class="col-lg-9 col-md-8">
                                    <p>{{$product->color}}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Fulfil By :</div>
                                <div class="col-lg-9 col-md-8">
                                    <p>{{date('d M Y', strtotime($product->fulfil_date))}}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Price Per Unit -</div>
                                <div class="col-lg-9 col-md-8">
                                    <p>{{$product->price}}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Commission -</div>
                                <div class="col-lg-9 col-md-8">
                                    <p>{{$product->commission}}</p>
                                </div>
                            </div>

                            <!--<div class="row">-->
                            <!--    <div class="col-lg-3 col-md-4 label">Description -</div>-->
                            <!--    <div class="col-lg-9 col-md-8">-->
                            <!--        <p><?php //echo $product->description?></p>-->
                            <!--    </div>-->
                            <!--</div>-->

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Address :</div>
                                <div class="col-lg-9 col-md-8">
                                    <p>@if($product->address->address)
                                        {{$product->address->address}}
                                        @else
                                        {{$product->custom_address}}
                                        @endif
                                    </p>
                                </div>
                            </div>
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
                                                        *</span></label> <input type="text" name="phone_number" required> </div>
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
                                                    Delivery</label> <input type="date" id="date" name="expected_date" required>
                                            </div>

                                            <div class="form-group col-sm-6 flex-column d-flex">
                                                <label class="form-control-label">Order Screenshot</label>
                                                <input class="box__file" type="file" name="files[]" id="file"
                                                    data-multiple-caption="{count} files selected" multiple required/>
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
                    </div><!-- End Bordered Tabs -->
                </div>
            </div>
        </div>
    </div>
</section>
@include('common.footer')