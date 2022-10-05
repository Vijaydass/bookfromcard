@include('admin.common.header')
@include('admin.common.sidebar')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Orders</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Top Selling -->
            <div class="col-12">
                <div class="card">

                    <div class="filter">
                        <a href="{{url('own-cms/orders')}}" class="btn btn-primary btn-sm">Orders</a>
                    </div>
                    
                    @if(Session::has('message'))
                        <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show"
                            role="alert">
                            <i class="fa fa-check"></i><strong>Success!</strong> {{ Session::get('message') }}
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                        @endif

                    <div class="card-body">
                        
                        <form class="row g-3" action="{{route('single_order_update.order')}}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <h5 class="card-title">Show</h5>
                            <!-- Custom Styled Validation -->
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" name="name" class="form-control" disabled value="{{$data[0]->name}}">
                            </div>
                            <div class="form-group">
                                <label>User phone</label>
                                <input type="text" name="name" class="form-control" disabled
                                    value="{{$data[0]->phone}}">
                            </div>
                            <div class="form-group">
                                <label>User email</label>
                                <input type="text" name="name" class="form-control" disabled
                                    value="{{$data[0]->email}}">
                            </div>
                            <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" name="name" class="form-control" disabled
                                    value="{{$data[0]->product_name}}">
                            </div>
                            <div class="form-group">
                                <label>Product Price</label>
                                <input type="number" name="price" class="form-control" disabled
                                    value="{{$data[0]->product_price}}">
                            </div>
                            <div class="form-group">
                                <label>Product Commission</label>
                                <input type="number" name="commission" class="form-control" disabled
                                    value="{{$data[0]->commission}}">
                            </div>
                            <div class="form-group">
                                <label>Product delivery date</label>
                                <input type="date" name="fulfil_date" class="form-control" disabled
                                    value="{{$data[0]->delivery_date}}">
                            </div>
                            <div class="form-group">
                                <label>order number</label>
                                <input type="text" name="varient" class="form-control" disabled
                                    value="{{$data[0]->order_number}}">
                            </div>
                            <div class="form-group">
                                <label>tracking id</label>
                                <input type="text" class="form-control" disabled
                                    value="{{$data[0]->tracking_id}}">
                            </div>

                            <div class="form-group">
                                <label>notes</label>
                                <textarea rows="3" cols="" name="custom_address" class="form-control" disabled
                                    placeholder="Enter Custom Address">{{$data[0]->notes}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>OTP</label>
                                <input type="text" class="form-control" disabled value="{{$data[0]->otp}}">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Delivery Status</label>
                                    <select class="form-control" name="delivery_status" required>
                                        <option value="pending"
                                            <?php if($data[0]->delivery_status==='pending'){ echo 'selected'; }?>>
                                            Pending
                                        </option>
                                        <option value="delivered"
                                            <?php if($data[0]->delivery_status==='delivered'){ echo 'selected'; }?>>
                                            Delivered
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Payment Status</label>
                                    <select class="form-control" name="payment_status" required>
                                        <option value="pending"
                                            <?php if($data[0]->payment_status==='pending'){ echo 'selected'; }?>>
                                            Pending
                                        </option>
                                        <option value="paid"
                                            <?php if($data[0]->payment_status==='paid'){ echo 'selected'; }?>>
                                            Paid
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label>Product Image</label>
                                <img id="uploadPreview" src="{{asset('storage/'.$data[0]->product_img)}}"
                                    style="width: 200px;" />
                            </div>

                            <h2>Order Screenshot</h2>
                            <div class="row">
                                @foreach($photos as $image)
                                <div class="col-md">
                                    <img id="uploadPreview" src="{{asset('storage/'.$image->image)}}"
                                        style="width: 200px;" />
                                </div>
                                @endforeach
                            </div>
                            <input type="hidden" name="orderid" value="{{$data[0]->order_id}}" class="form-control"
                                required>
                            <input type="hidden" name="otp" value="{{$data[0]->otp}}" class="form-control"
                                required>
                            <input type="hidden" name="tracking_id" value="{{$data[0]->tracking_id}}" class="form-control"
                                required>
                            <div class="col-md-12">
                                <button class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div><!-- End Top Selling -->
        </div>
    </section>

</main><!-- End #main -->
@include('admin.common.footerscript')
<script type="text/javascript">
function PreviewImage() {
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);
    oFReader.onload = function(oFREvent) {
        $('#uploadPreview').show();
        document.getElementById("uploadPreview").src = oFREvent.target.result;
    };
};
</script>
@include('admin.common.footer')