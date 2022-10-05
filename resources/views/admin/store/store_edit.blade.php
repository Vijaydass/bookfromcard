@include('admin.common.header')
@include('admin.common.sidebar')
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Store</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Top Selling -->
            <div class="col-12">
                <div class="card top-selling overflow-auto">

                    <div class="filter">
                        <a href="{{url('own-cms/stores')}}" class="btn btn-primary btn-sm">Stores</a>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Store</h5>
                        @if ($errors->any())                                                        
                            @foreach ($errors->all() as $error)
                            <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                                <i class="fa fa-close"></i><strong>Error!</strong> {{ $error }}
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            @endforeach                                
                        @endif
                        <!-- Custom Styled Validation -->
                        <form class="row g-3" action="{{route('upadte_store.update')}}"  method="POST" enctype="multipart/form-data">
                            @csrf 
                               <div class="col-md-6">
                                  <label>Store Name</label>
                                  <input type="text"  name="name" class="form-control" value="{{$data[0]->name}}" placeholder="Enter Store Name" >
                               </div>
 
                                <div class="col-md-6">
                                  <label>Select Image</label>
                                  <input type="file"  name="image" class="form-control btn-primary" id="uploadImage" onchange="PreviewImage();" accept="image/gif, image/jpeg, image/png" />
                               </div>
 
                               <div class="col-md-6">
                                <img id="uploadPreview" src="{{asset('storage/'.$data[0]->image)}}" style="width: 200px;" />
                               </div> 
                               <input type="hidden" name="hiddenid" value="<?php echo $data[0]->id;?>" class="form-control" required >
                               <input type="hidden" name="hiddenfile" value="<?php echo $data[0]->image;?>" class="form-control" required >
                               
                               <div class="col-md-12">
                                    <button  class="btn btn-success">Save</button>                              
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
        oFReader.onload = function (oFREvent) {
          $('#uploadPreview').show();
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
    };
</script>
@include('admin.common.footer')