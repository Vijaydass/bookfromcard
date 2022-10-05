@include('admin.common.header')
@include('admin.common.sidebar')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Banks</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Top Selling -->
            <div class="col-12">
                <div class="card top-selling overflow-auto">

                    <div class="filter">
                        <a href="{{url('own-cms/banks')}}" class="btn btn-primary btn-sm">Bank list</a>
                    </div>

                    <div class="card-body mt-2">
                        @if (Session::has('error'))
                        <p class="text-danger">{{ Session::get('error') }}</p>
                        @endif
                        @if (Session::has('success'))
                        <p class="text-success">{{ Session::get('success') }}</p>
                        @endif
                        <!-- Custom Styled Validation -->
                        <form class="row g-3 needs-validation" action="{{route('upadte_bank.update')}}"  method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-4">
                                <label for="validationCustom01" class="form-label">Bank name</label>
                                <input type="text" class="form-control" name="bank_name" value="<?php echo $data[0]->name;?>" id="validationCustom01"
                                    required>
                                @if ($errors->has('bank_name'))
                                <div class="valid-feedback">
                                    {{ $errors->first('bank_name') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <label for="bank_img" class="form-label">Bank Image</label>
                                <input type="file" class="form-control" name="bank_img" id="bank_img" onchange="PreviewImage();">
                                @if ($errors->has('bank_img'))
                                <div class="valid-feedback">
                                    {{ $errors->first('bank_img') }}
                                </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <img id="uploadPreview" src="{{asset('storage/'.$data[0]->image)}}" style="width: 200px;" />
                             </div>
                             <input type="hidden" name="hiddenid" value="<?php echo $data[0]->id;?>" class="form-control" required >
                             <input type="hidden" name="hiddenfile" value="<?php echo $data[0]->image;?>" class="form-control" required >
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </form><!-- End Custom Styled Validation -->

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
         oFReader.readAsDataURL(document.getElementById("bank_img").files[0]);
         oFReader.onload = function (oFREvent) {
           $('#uploadPreview').show();
             document.getElementById("uploadPreview").src = oFREvent.target.result;
         };
    };
 </script>
@include('admin.common.footer')