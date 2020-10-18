<footer id="footer" class="footer wow fadeIn">
    <div class="top-arrow">
        <a href="#header" class="btn"><i class="fa fa-angle-up"></i></a>
    </div>
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-widget about">
                        <h2><span>Our</span> company</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        <ul class="list">
                            <li><i class="fa fa-envelope footer-icon"></i><a href="mailto:{{  $option->email  }}">{{  $option->email  }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-widget links">
                        <h2><span>Business</span> Hours</h2>
                        <ul class="list">
                            <li><a>Monday - Friday 9am - 5pm</a></li>
                            <li><a>Saturday 9am - 1pm</a></li>
                            <li><a>Sunday - Closed</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-12">
                    <div class="single-widget links">
                        <h2><span>Quick</span> Links</h2>
                        <ul class="list">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ url('login') }}">Login</a></li>
                            <li><a href="#">Get In Touch</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="single-widget newsletter">
                        <h2>Subscribe <span>Now</span></h2>
                        <form>
                            <input placeholder="your email" type="text" type="email" required>
                            <button type="submit" class="btn text-uppercase">Subscribe Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bottom-top">
                        <div class="copyright">
                            <p>Copyright &copy; <script>document.write(new Date().getFullYear());</script> All Right Reserved. Solution By <a target="_blank" href="{!! url($option->company_web_url) !!}">{!! $option->company_name !!}</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
