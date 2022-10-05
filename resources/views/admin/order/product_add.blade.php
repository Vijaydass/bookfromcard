@include('admin.common.header')
@include('admin.common.sidebar')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Product</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Top Selling -->
            <div class="col-12">
                <div class="card top-selling overflow-auto">

                    <div class="filter">
                        <a href="{{url('own-cms/products')}}" class="btn btn-primary btn-sm">Products</a>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Product add</h5>
                        @if ($errors->any())
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show"
                            role="alert">
                            <i class="fa fa-close"></i><strong>Error!</strong> {{ $error }}
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                        @endforeach
                        @endif
                        <!-- Custom Styled Validation -->
                        <form class="row g-3" action="{{route('product.insert')}}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-12">
                                <label>Product Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Product Name">
                            </div>
                            
                            <div class="form-group">
                                <label>Select Store</label>
                                <select class="form-control" name="store_id" required>
                                    <option value="">Select Store</option>
                                    @foreach ($store as $value) 
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>                            
                            <div class="form-group">
                                <label>Select Bank</label>
                                <select class="form-control" name="bank_id" required>
                                    <option value="">Select Bank</option>
                                    @foreach ($banks as $value) 
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Product Quantity</label>
                                <input type="number" name="quantity" class="form-control" placeholder="10">
                            </div>
                            <div class="col-md-6">
                                <label>Product Price</label>
                                <input type="number" name="price" class="form-control" placeholder="10,000">
                            </div>
                            <div class="col-md-6">
                                <label>Product Commission</label>
                                <input type="number" name="commission" class="form-control" placeholder="100">
                            </div>
                            <div class="col-md-6">
                                <label>Product fulfil date</label>
                                <input type="date" name="fulfil_date" class="form-control" placeholder="100">
                            </div>
                            <div class="col-md-6">
                                <label>Product varient</label>
                                <input type="text" name="varient" class="form-control" placeholder="4 Ram/64 Rom">
                            </div>
                            <div class="col-md-6">
                                <label>Product color</label>
                                <input type="text" name="color" class="form-control" placeholder="blue,white,etc">
                            </div>                            
                            <div class="col-md-12">
                                <label>Product description</label>
                                <textarea rows="3" cols="" name="description"
                                        class="form-control" placeholder="Enter  Description"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label>Product Url</label>
                                <input type="url" name="url" class="form-control" />
                            </div>
                            <div class="col-md-6">
                                <label>Product Image</label>
                                <input type="file" name="image" class="form-control btn-primary" id="uploadImage"
                                    onchange="PreviewImage();" accept="image/gif, image/jpeg, image/png" />
                            </div>
                            <div class="form-group">
                                <label>Select Address</label>
                                <select class="form-control" name="address_id" required>
                                    <option value="">Select Address</option>
                                    @foreach ($address as $value) 
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Custom Address</label>
                                <textarea rows="3" cols="" name="custom_address"
                                        class="form-control" placeholder="Enter Custom Address"></textarea>
                            </div>


                            <div class="col-md-6">
                                <img id="uploadPreview" style="width: 80px; display: none;" />
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn-success">Save</button>
                                <a href="#" class="btn btn-warning">Reset</a>
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