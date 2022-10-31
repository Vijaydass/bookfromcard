@include('common.header')
<section class="mt-150 mb-20">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        @if (Session::has('error'))
                        <p class="text-danger">{{ Session::get('error') }}</p>
                        @endif
                        <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" id="sent-message" style="display:none" role="alert">
                            <i class="fa fa-check"></i><strong>Success!</strong> Otp Successfully send
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                        <form action="{{ route('verifyemail') }}" method="post">
                            @csrf
                            @method('post')
                            <div class="form-group">
                                <label>Please enter 6 digit otp sent on your E-mail and start earning</label>
                                <input type="text" name="otp" class="form-control" placeholder="otp" />
                                @if ($errors->has('name'))
                                <p class="text-danger">{{ $errors->first('name') }}</p>
                                @endif
                            </div>
                            <input type="hidden" name="email" class="form-control" id="email" value="{{$email}}" />
                            <button class="btn btn-success btn-block mt-3">Verify</button>
                            <a class="btn btn-primary btn-block mt-3" onclick="otpSend();">Resend Otp</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@include('common.footer')
<script type="text/javascript">
    function otpSend() {
    var email = document.getElementById('email').value;
    $.ajax({
            url: '{{ route("otp_resend") }}',
            type: 'POST',
            data: {
                email: email,
                _token: '{{csrf_token()}}'
            },
            // dataType: 'JSON',
            success: function(response) {
                document.getElementById("sent-message").classList.add("d-block");
            },
            error: function(err) {
                console.log('User Register Error' + JSON.stringify(err));
            },
        });
    
}
</script>