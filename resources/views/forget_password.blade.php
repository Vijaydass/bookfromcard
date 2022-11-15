@include('common.header')
<section class="mt-150 mb-20">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        @if(Session::has('success'))
                        <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show"
                            role="alert">
                            <i class="fa fa-check"></i><strong>Success!</strong> {{ Session::get('success') }}
                            <button type="button" class="btn-close btn-close-white close" data-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                        @endif
                        @if(Session::has('error'))
                        <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show"
                            role="alert">
                            <i class="fa fa-check"></i><strong>Error!</strong> {{ Session::get('error') }}
                            <button type="button" class="btn-close btn-close-white close" data-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                        @endif
                        <div class="alert alert-danger" id="error-message" style="display: none;"></div>
                        <div class="alert alert-success" id="sent-message" style="display: none;"></div>
                        <form>
                            <div class="mb-4 rtl-flex-d-row-r" id="sendotp">
                                <input class="form-control" id="email" type="email" placeholder="Enter email">
                            </div>
                            <div class="mb-4 rtl-flex-d-row-r" id="successAuth" style="display: none;">
                                <input class="form-control" id="otp-code" type="text" placeholder="Enter OTP">
                            </div>
                            <div class="mb-4 rtl-flex-d-row-r" id="successAuthpassword" style="display: none;">
                                <input class="form-control" id="password" type="text" placeholder="Enter Your New Password">
                            </div>
                            <button class="btn btn-warning btn-lg w-100" id="sendotpbutton" type="button"
                                onclick="otpSend();">Send
                                Otp</button>
                            <button class="btn btn-success btn-lg w-100" style="display: none;" id="verifyotpbutton"
                                type="button" onclick="otpVerify();">Password Reset</button>
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
    $("#successAuth").show();
    $("#successAuthpassword").show();
    $("#verifyotpbutton").show();
    $("#sendotp").hide();
    $("#sendotpbutton").hide();
    $.ajax({
        url: '{{ route("password.otp_send") }}',
        type: 'POST',
        data: {
            "_token": "{{ csrf_token() }}",
            email: email
        },
        // dataType: 'JSON',
        success: function(response) {
            document.getElementById("sent-message").innerHTML = "Otp sent succesfully.";
            document.getElementById("sent-message").classList.add("d-block");
            // alert('Token saved successfully.');
        }        
    });
}

function otpVerify() {
    var code = document.getElementById('otp-code').value;
    var password = document.getElementById('password').value;
    $.ajax({
        url: '{{ route("password.reset") }}',
        type: 'POST',
        data: {
            "_token": "{{ csrf_token() }}",
            code: code,
            password: password
        },
        // dataType: 'JSON',
        success: function(response) {
            document.getElementById("sent-message").innerHTML = "Your password has been changed successfully";
            document.getElementById("sent-message").classList.add("d-block");
        }
    });
}
</script>