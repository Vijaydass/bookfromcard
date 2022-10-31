 <!-- Footer Section Begin -->
 <footer class="footer-section">
        <div class="social-links-warp">
			<div class="container">
				<div class="social-links text-center">
					<a href="https://t.me/bookfromcards" class="telegram"><i class="fa fa-telegram"></i><span>telegram</span></a>
					<a href="http://wa.me/+918386801119" class="pinterest"><i class="fa fa-whatsapp"></i><span>whatsapp</span></a>
				</div>
			</div>

<div class="container text-center pt-5">
                <p>
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved</p>
            </div>


		</div>
    </footer>
    <!-- Footer Section End -->

<!-- Login Form Modal -->
<div class="modal fade show" id="submitModal" style="background: rgba(0, 0, 0, 0.48);" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center" id="modelHeading">Login</h4>
            </div>
            <div class="modal-body">
                <div class="model-logo">
                 <img src="{{asset('assets/img/logo-book.png')}}" alt="">
             </div>
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
                        <input type="email" name="email" class="form-control" placeholder="Email" autocomplete="off" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAkCAYAAADo6zjiAAAAAXNSR0IArs4c6QAAAbNJREFUWAntV8FqwkAQnaymUkpChB7tKSfxWCie/Yb+gbdeCqGf0YsQ+hU95QNyDoWCF/HkqdeiIaEUqyZ1ArvodrOHxanQOiCzO28y781skKwFW3scPV1/febP69XqarNeNTB2KGs07U3Ttt/Ozp3bh/u7V7muheQf6ftLUWyYDB5yz1ijuPAub2QRDDunJsdGkAO55KYYjl0OUu1VXOzQZ64Tr+IiPXedGI79bQHdbheCIAD0dUY6gV6vB67rAvo6IxVgWVbFy71KBKkAFaEc2xPQarXA931ot9tyHphiPwpJgSbfe54Hw+EQHMfZ/msVEEURjMfjCjbFeG2dFxPo9/sVOSYzxmAwGIjnTDFRQLMQAjQ5pJAQkCQJ5HlekeERxHEsiE0xUUCzEO9AmqYQhiF0Oh2Yz+ewWCzEY6aYKKBZCAGYs1wuYTabKdNNMWWxnaA4gp3Yry5JBZRlWTXDvaozUgGTyQSyLAP0dbb3DtQlmcan0yngT2ekE9ARc+z4AvC7nauh9iouhpcGamJeX8XF8MaClwaeROWRA7nk+tUnyzGvZrKg0/40gdME/t8EvgG0/NOS6v9NHQAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;">
                                            </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Password" class="form-control" required="" autocomplete="off" style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAkCAYAAADo6zjiAAAAAXNSR0IArs4c6QAAAbNJREFUWAntV8FqwkAQnaymUkpChB7tKSfxWCie/Yb+gbdeCqGf0YsQ+hU95QNyDoWCF/HkqdeiIaEUqyZ1ArvodrOHxanQOiCzO28y781skKwFW3scPV1/febP69XqarNeNTB2KGs07U3Ttt/Ozp3bh/u7V7muheQf6ftLUWyYDB5yz1ijuPAub2QRDDunJsdGkAO55KYYjl0OUu1VXOzQZ64Tr+IiPXedGI79bQHdbheCIAD0dUY6gV6vB67rAvo6IxVgWVbFy71KBKkAFaEc2xPQarXA931ot9tyHphiPwpJgSbfe54Hw+EQHMfZ/msVEEURjMfjCjbFeG2dFxPo9/sVOSYzxmAwGIjnTDFRQLMQAjQ5pJAQkCQJ5HlekeERxHEsiE0xUUCzEO9AmqYQhiF0Oh2Yz+ewWCzEY6aYKKBZCAGYs1wuYTabKdNNMWWxnaA4gp3Yry5JBZRlWTXDvaozUgGTyQSyLAP0dbb3DtQlmcan0yngT2ekE9ARc+z4AvC7nauh9iouhpcGamJeX8XF8MaClwaeROWRA7nk+tUnyzGvZrKg0/40gdME/t8EvgG0/NOS6v9NHQAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;">
                                            </div>
                    <button type="submit" class="site-btn mt-3 btn-block">Login</button> 
                    <div class="login-form-footer">                   
                    <a type="submit" href="{{url('forget-password')}}" class="mt-1">Forget Password</a>

                    <a type="submit" href="{{url('/register')}}" class="mt-1">Sign up</a>
                </div>
                </form>
            </div>
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