        <!-- Start Footer End -->
            <footer class="footer-area">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-sm-6 col-md-6">
                        <p>Copyright <i class='bx bx-copyright'></i> 2023 <a href="#">MASU</a>. All rights reserved</p>
                    </div>
                </div>
            </footer>
            <!-- End Footer End -->

        </div>
        <!-- End Main Content Wrapper Area -->
        <!-- Vendors Min JS -->
        <!-- Custom JS -->
        <!-- Vendors Min JS -->
        <script src="assets/js/vendors.min.js"></script>      
       
        <!-- Custom JS -->
        
        <script src="assets/js/custom.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $("#profile-drop-down-trigger").click(function(){
                    $(".profile-drop-down").toggleClass("show");
                });
                $("#profile-drop-down-trigger").blur(function(){
                    $(".profile-drop-down").removeClass("show");
                });
            });
        </script>
        <script src="https://cdn.tiny.cloud/1/hckpipxf24vecn5lcc2nujkxwthg1o9ehnpv6b6yajid4w2b/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    </body>
</html>