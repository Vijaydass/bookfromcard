@include('common.header')
<!-- Hero Slider Begin -->
<section class="hero-slider">
    <div class="hero-items owl-carousel">
        @foreach($slider as $item)
        <!-- <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                <img class="d-block w-100" src="">
            </div> -->
            <a href="{{ $loop->last ? 'https://bookfromcard.com/refer_earn' : '#' }}" class="single-slider-item">
        <div class="single-slider-item set-bg" data-setbg="{{asset('storage/'.$item->image)}}">
        </div>
        </a>
        @endforeach
    </div>
</section>
<!-- Hero Slider End -->

<!-- Latest Product Begin -->
<section class="latest-products pb-5 pt-5">
    <div class="container">
        <div class="product-filter">
            <div class="row">
                <div class="col-12 text-left">
                    @if(Session::has('message'))
                    <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                        <i class="fa fa-check"></i><strong>Success!</strong> {{ Session::get('message') }}
                        <button type="button" class="btn-close btn-close-white close" data-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                    @endif
                    @if(Session::has('error'))
                    <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                        <i class="fa fa-check"></i><strong>Error!</strong> {{ Session::get('error') }}
                        <button type="button" class="btn-close btn-close-white close" data-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                    @endif                    
                    <div class="section-title">
                        @if(count($product) > 0)
                        <h2 class="text-sm-center">Current Requirements</h2>
                        @else
                        <h4 class="text-sm-center text-warning no-deal">You have not started any deals yet</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="product-list">
            
            @if(count($product) > 0)
            @foreach($product as $item)
            @if(Str::lower($item->store->name) === 'amazon')
            <?php 
              $url = amazon_url($item->url, 'dp/'); 
              $full_url = 'https://www.amazon.in/dp/'.$url.'?tag=amazon03b0e6-21&linkCode=ogi&th=1&psc=1';
            ?>
            @else
            <?php 
              $full_url = $item->url;
            ?>
            @endif
            <div class="col-6 col-lg-4 g-2 g-lg-3">
                <div class="deal-design">
                    <div class="row">
                        <div class="col-12">
                            <h4>{{$item->name}}</h4>
                            <div class="qty-stock"><span>{{$item->quantity}} Pcs</span></div>
                        </div>
                    </div>
                    <div class="row deal-row align-items-center g-2 g-lg-3">
                        <div class="col-3 col-lg-5">
                            <figure>
                                <a href="#"><img src="{{asset('storage/'.$item->image)}}" alt=""></a>
                            </figure>
                        </div>
                        <div class="col-9 col-lg-7">
                            <div class="deal-info-row"><span class="product-list-label">Varient</span> : <span
                                    class="product-list-info">{{$item->varient}}</span></div>
                            <div class="deal-info-row"><span class="product-list-label">Color</span> : <span
                                    class="product-list-info">{{$item->color}}</span></div>
                            <div class="deal-info-row"><span class="product-list-label">Fulfill By</span> : <span
                                    class="product-list-info">{{date('d M Y', strtotime($item->fulfil_date))}}</span></div>
                            <hr>
                            <div class="deal-info-row"><span class="product-list-label">Price per unit</span> : <span
                                    class="product-list-info">{{$item->price}}</span></div>
                            <div class="deal-info-row"><span class="product-list-label">Commision</span> : <span
                                    class="product-list-info">{{$item->commission}}</span></div>
                        </div>
                    </div>
                    <div class="row deal-footer g-2">
                        <div class="col-12 col-lg-8">
                            <div class="deal-bank-merchant">
                                <figure>
                                    <img src="{{asset('storage/'.$item->store->image)}}" alt="">
                                </figure>
                                <figure>
                                    <img src="{{asset('storage/'.$item->bank->image)}}" alt="">
                                </figure>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                        @if(Auth::check())
                        <a href="{{url('fullfill-order/'.$item->id)}}" class="site-btn w-100 text-center" >See
                            More Details</a>
                        @else
                        <a href="#" class="site-btn w-100 text-center" onClick="loginModal()">Fulfill Order</a>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</section>
<!-- Latest Product End -->

<!-- <section id="services" class="features-area">
    <div class="container">        

        <div class="row justify-content-center">

            <div class="col-lg-4 col-md-7 col-sm-9">
                <div class="single-features mt-30 pb-0 pt-2">
                    <div class="row">
                        <div class="col-6">
                            <p class="product-title"></p>
                        </div>
                        <div class="col-6">
                            <button class="features-btn">Quantity <span class="feat-span">
                                    Peice</span></button>
                        </div>
                    </div>
                    <div class="features-title-icon row">
                        <div class="col-6">
                            <img class="shape" src="" alt="Shape"
                                style="width: 150px;">
                        </div>
                        <div class="features-icon col-6">
                            <p class="feat-p">Varient : <span class="feat-span"></span></p>
                            <p class="feat-p">Color : <span class="feat-span"></span></p>
                            <p class="feat-p">Fulfil By : <span
                                    class="feat-span"></span></p>
                            <hr style="margin: 5px!important;">
                            <p class="feat-p">Price Per Unit : <span class="feat-span"></span></p>
                            <p class="feat-p">Commission : <span class="feat-span"></span></p>
                        </div>
                    </div>
                    <div class="features-content flex row">
                        <div class="feature-image col-6 my-2">
                            <img src="" height="50">
                        </div>
                        <div class="feature-second-image flex col-6 my-2" style="margin: auto;">
                            <img src="" height="50">
                        </div>
                        
                    </div>
                </div>
            </div>

        </div>

    </div>
</section> -->
@include('common.footer')