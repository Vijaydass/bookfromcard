<section class="footer-area footer-dark">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="footer-logo text-center">
                    <a class="mt-30" href="{{url('/')}}">
                        <img src="{{asset('/logo.png')}}" alt="Logo" width="150"></a>
                </div>
                <ul class="social text-center mt-20">
                    <li><a href="#"><i class="lni lni-facebook-oval"></i></a></li>
                    <li><a href="https://wa.me/918386801119"><i class="lni lni-whatsapp"></i></a></li>
                    <li><a href="#"><i class="lni lni-telegram-original"></i></a></li>
                </ul>
                <div class="footer-support text-center">
                    <span class="mail">Need help? Send us a mail at:<a href="bookfromcards@gmail.com"
                            class="__cf_email__">bookfromcards@gmail.com</a></span>
                </div>
                 <div class="copyright text-center mt-20">
                    <p class="text">Designed by <a href="https://atozdeal.in" rel="nofollow">Atozdeal.in</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Login Form Modal -->
<div class="modal fade" id="submitModal" aria-hidden="true" style="background: #0000007a;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">Login</h4>
            </div>
            <div class="modal-body">
                @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                    <i class="fa fa-close"></i><strong>Error!</strong> {{ $error }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
                @endforeach
                @endif
                @if (Session::has('error'))
                <p class="text-danger">{{ Session::get('error') }}</p>
                @endif
                @if (Session::has('success'))
                <p class="text-success">{{ Session::get('success') }}</p>
                @endif
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    @method('post')
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Email" />
                        @if ($errors->has('email'))
                        <p class="text-danger">{{ $errors->first('email') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Password" class="form-control" required="">
                        @if ($errors->has('password'))
                        <p class="text-danger">{{ $errors->first('password') }}</p>
                        @endif
                    </div>
                    <button type="submit" class="btn-sm mt-3 btn-block">Login</button>                    
                    <a type="submit" href="{{url('forget-password')}}" class="mt-1">Forget Password</a>
                </form>
            </div>
        </div>
    </div>
</div>
<a href="#" class="back-to-top"><i class="lni lni-chevron-up"></i></a>
@include('common.footerscript')
<script type="text/javascript">
function loginModal() {
    $('#submitModal').modal('show');
}
</script>
</body>

</html>