<!-- Jquery -->
<script src="{{ asset('assets/js/lib/jquery-3.4.1.min.js') }}"></script>
<!-- Bootstrap-->
<script src="{{ asset('assets/js/lib/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/lib/bootstrap.min.js') }}"></script>
<!-- Ionicons -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<!-- Splide -->
<script src="{{ asset('assets/js/plugins/splide/splide.min.js') }}"></script>
<!-- ProgressBar js -->
<script src="{{ asset('assets/js/plugins/progressbar-js/progressbar.min.js') }}"></script>
<!-- Owl Carousel -->
<script src="{{ asset('assets/js/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
<!-- jQuery Circle Progress -->
{{-- <script src="{{ asset('assets/js/plugins/jquery-circle-progress/circle-progress.min.js') }}"></script>
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script> --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- Camera Capture --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
<!-- Base Js File -->
<script src="{{ asset('assets/js/base.js') }}"></script>

@stack('myscript')
