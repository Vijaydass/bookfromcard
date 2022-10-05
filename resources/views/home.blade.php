@include('common.header')
<section class="slider_area mt-96">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            @foreach($slider as $item)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                <img class="d-block w-100" src="{{asset('storage/'.$item->image)}}">
            </div>
            @endforeach            
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>


<section id="services" class="features-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-10">
                <div class="section-title text-center pb-10">
                @if(Session::has('message'))
                <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                    <i class="fa fa-check"></i><strong>Success!</strong> {{ Session::get('message') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
                @endif
                @if(Session::has('error'))
                <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                    <i class="fa fa-check"></i><strong>Error!</strong> {{ Session::get('error') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
                @endif
                @if(count($product) > 0)
                    <h3 class="title">Current Requirements</h3>
                @else
                    <h4 class="title text-warning">Sorry no deal is available right now</h4>
                @endif
                </div>
            </div>
        </div>
        @if(count($product) > 0)
        <div class="row justify-content-center">
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
            <div class="col-lg-4 col-md-7 col-sm-9">
                <div class="single-features mt-30 pb-0 pt-2">
                    <div class="row">
                        <div class="col-6">
                            <p class="product-title">{{$item->name}}</p>
                        </div>
                        <div class="col-6">
                            <button class="features-btn">Quantity <span class="feat-span">{{$item->quantity}}
                                    Peice</span></button>
                        </div>
                    </div>
                    <div class="features-title-icon row">
                        <div class="col-6">
                            <img class="shape" src="{{asset('storage/'.$item->image)}}" alt="Shape"
                                style="width: 150px;">
                        </div>
                        <div class="features-icon col-6">
                            <p class="feat-p">Varient : <span class="feat-span">{{$item->varient}}</span></p>
                            <p class="feat-p">Color : <span class="feat-span">{{$item->color}}</span></p>
                            <p class="feat-p">Fulfil By : <span class="feat-span">{{date('d M Y', strtotime($item->fulfil_date))}}</span></p>
                            <hr style="margin: 5px!important;">
                            <p class="feat-p">Price Per Unit : <span class="feat-span">{{$item->price}}</span></p>
                            <p class="feat-p">Commission : <span class="feat-span">{{$item->commission}}</span></p>
                        </div>
                    </div>
                    <div class="features-content flex row">
                        <div class="feature-image col-6 my-2">
                            <img src="{{asset('storage/'.$item->store->image)}}" height="50">
                        </div>
                        <div class="feature-second-image flex col-6 my-2" style="margin: auto;">
                            <img src="{{asset('storage/'.$item->bank->image)}}" height="50">
                        </div>
                        @if(Auth::check())
                        <a href="{{url('fullfill-order/'.$item->id)}}" class="features-btn" style="width: 100%;padding: 2px 9px;font-size: 14px;font-weight: 500;">See
                            More Details</a>
                        @else
                        <a href="#" class="features-btn" style="width: 100%;padding: 2px 9px;font-size: 14px;font-weight: 500;" onClick="loginModal()">See More
                            Details</a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
@include('common.footer')