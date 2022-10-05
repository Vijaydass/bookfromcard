@include('common.header')
<section class="section mt-120">
    <div class="row m-3">
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
            @foreach($orders as $list)
            <div class="card my-2">
                <div class="card-body">
                    <a href="{{url('user-order/'.$list->id)}}" style="text-decoration: none;color: black;width: 100%;">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <img src="{{asset('storage/'.$list->product_img)}}" alt="" width="80">
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <h5 style="font-size: 14px;font-weight: bold;">{{$list->product_name}}</h5>
                                        <table width="100%">
                                            <tr>
                                                <td class="mr-2"><p class="my-0">{{$list->varient}} </p></td>
                                                <td><p class="my-0"> {{$list->color}} </p></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <table width="100%">
                                    <tr>
                                        <td class="py-1">
                                            <h6 class="p-0 mb-0">Order No :</h6>
                                        </td>
                                        <td>
                                            <p class="my-0" style="color:#006fbd;font-weight: 500;">
                                                {{$list->order_number}}
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-1">
                                            <h6 class="p-0 mb-0" style="color:#006fbd;font-weight: 500;">You Spent : </h6>
                                        </td>
                                        <td>
                                            <p class="my-0"> ₹ {{$list->product_price}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-1">
                                            <h6 class="p-0 mb-0">Tracking Id : </h6>
                                        </td>
                                        <td>
                                            <p class="my-0" style="color:#006fbd;font-weight: 500;">
                                                {{$list->tracking_id}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-1">
                                            <h6 class="p-0 mb-0" style="color:#006fbd;font-weight: 500;">Delivery Status
                                                : </h6>
                                        </td>
                                        <td>
                                            <p
                                                class="my-0 {{$list->delivery_status?$list->delivery_status==='delivered':'text-success'}}">
                                                {{$list->delivery_status}}</p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <table>
                                    <tr>
                                        <td class="py-1">
                                            <h6 class="p-0 mb-0" style="color:#006fbd;font-weight: 500;">
                                                Delivery Verified ? : </h6>
                                        </td>
                                        <td>
                                            <p class="my-0 {{$list->delivery_status?'text-success':'text-danger'}}">
                                                {{$list->delivery_status==='delivered'?'Yes':'No'}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-1">
                                            <h6 class="p-0 mb-0" style="color:#006fbd;font-weight: 500;">Paid ?
                                                : </h6>
                                        </td>
                                        <td>
                                            <p class="my-0 {{$list->payment_status?'text-success':'text-danger'}}"
                                                style="font-weight: 500;">
                                                {{$list->payment_status?$list->payment_status:'No'}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-1">
                                            <h6 class="p-0 mb-0" style="color:#006fbd;font-weight: 500;">Commission :
                                            </h6>
                                        </td>
                                        <td>
                                            <p class="my-0"> ₹ {{$list->commission}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="py-1">
                                            <h6 class="p-0 mb-0" style="color:#006fbd;font-weight: 500;">You'll Receive
                                                : </h6>
                                        </td>
                                        <td>
                                            <p class="my-0"> ₹ {{$list->product_price + $list->commission}}</p>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
</section>
@include('common.footer')