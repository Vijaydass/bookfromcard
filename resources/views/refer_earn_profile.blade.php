@include('common.header')
<section class="section profile mt-120">
    <div class="row m-5">

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
            <div class="card">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">

                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Refer and
                                Earn</a>
                        </li>

                    </ul>
                    <div class="tab-content pt-2">
                        <div class="tab-pane fade show active profile-overview pt-3" id="profile-overview">

                            <!-- Profile Edit Form -->
                            <form>
                                <div class="row mb-3">
                                    <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Referal Url</label>
                                    <div class="col-md-8 col-lg-9">
                                    <input type="text" class="form-control" id="myInput"
                                                value="{{url('register/'.$user->referral_token)}}">
                                    </div>
                                </div>       
                                <div class="text-center">
                                    <button  onclick="myFunction()" class="btn btn-primary">Copy Referal Url</button>
                                </div>
                            </form><!-- End Profile Edit Form -->

                        </div>

                    </div><!-- End Bordered Tabs -->

                </div>
            </div>

        </div>
    </div>
</section>
@include('common.footer')
<script>
function myFunction() {
    /* Get the text field */
    var copyText = document.getElementById("myInput");

    /* Select the text field */
    copyText.select();
    copyText.setSelectionRange(0, 99999); /* For mobile devices */

    /* Copy the text inside the text field */
    navigator.clipboard.writeText(copyText.value);

    /* Alert the copied text */
    alert("Copied the text: " + copyText.value);
}
</script>