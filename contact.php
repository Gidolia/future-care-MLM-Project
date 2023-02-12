<?php
include('database_connect.php');
?>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Contact us</title>
    <!-- google-fonts -->
    <link href="//fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- //google-fonts -->
    <!-- Font-Awesome-Icons-CSS -->
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <!-- Template CSS Style link -->
    <link rel="stylesheet" href="assets/css/style-starter.css">
</head>

<body>
    <!--header-->
    <?php include "include/header.php";?>
    <!--//header-->

    <!-- inner banner -->
    <section class="inner-banner">
        <div class="w3l-breadcrumb py-5">
            <div class="container py-xl-5 py-md-4 mt-5">
                <h4 class="inner-text-title font-weight-bold mb-sm-2">Contact Us</h4>
                <ul class="breadcrumbs-custom-path">
                    <li><a href="index.php">Home</a></li>
                    <li class="active"><span class="fa fa-chevron-right mx-2" aria-hidden="true"></span>Contact Us</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- //inner banner -->

    <!-- contact -->
    <section class="w3l-contact-info-main py-5" id="contact">
        <div class="container py-md-5 py-4">
            <div class="row align-items-center mb-5">
                <div class="col-md-6 section-heading">
                    <h5 class="small-title-2">Write Message</h5>
                    <h3 class="title-style-2">Get in Touch</h3>
                </div>
                <!--<div class="col-md-6 section-heading mt-md-0 mt-2">-->
                <!--    <p>-->
                <!--        Sed ut perspiciatis unde omnis iste natus error sit accusantium doloremque,-->
                <!--        eaque ipsa quae ab illo inventore.Sed ut perspiciatis unde omnis iste natus error sit.-->
                <!--    </p>-->
                <!--</div>-->
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="contact-address p-4">
                        <div class="contact-icon d-flex align-items-center">
                            <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                            <!--<div class="ml-3">-->
                            <!--    <h5 class="contact-text">Visit Us:</h5>-->
                            <!--    <p>Gwalior , Madhya Pradesh ,India </p>-->
                            <!--</div>-->
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt-md-0 mt-4">
                    <div class="contact-address p-4">
                        <div class="contact-icon d-flex align-items-center">
                            <i class="fas fa-phone-alt" aria-hidden="true"></i>
                            <div class="ml-3">
                                <h5 class="contact-text">Call Us:</h5>
                                <a href="tel:+12 23456790">+91-XX-XXXX-XXXX</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mt-lg-0 mt-4">
                    <div class="contact-address p-4">
                        <div class="contact-icon d-flex align-items-center">
                            <i class="fas fa-envelope-open-text" aria-hidden="true"></i>
                            <div class="ml-3">
                                <h5 class="contact-text">Mail Us:</h5>
                                <a href="mailto:info@example.com"> futurecare@gmail.com</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contact-w3pvt-form mt-5 pt-lg-4">
                <form method="post" >
                    <div class="row main-cont-sec">
                        <div class="col-md-6 left-cont-contact">
                            <div class="form-group mb-3">
                                <label for="w3lName">Your Name</label>
                                <input class="form-control" type="text" name="name" id="w3lName" placeholder=""
                                    required="">
                            </div>
                            <div class="form-group mb-3">
                                <label for="w3lSender">Your Email</label>
                                <input class="form-control" type="email" name="email" id="w3lSender" placeholder=""
                                    required="">
                            </div>
                            <div class="form-group mb-3">
                                <label for="w3lSubject">Subject</label>
                                <input class="form-control" type="text" name="subject" id="w3lSubject" required="">
                            </div>
                        </div>
                        <div class="col-md-6 right-cont-contact">
                            <div class="form-group">
                                <label for="w3lSubject">Write Message</label>
                                <textarea class="form-control" name="w3lMessage" id="message" placeholder=""
                                    required=""></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group-2 mt-3 text-right">
                        <button type="submit" class="btn btn-style" name="btn">Submit Form</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <?php
    if(isset($_POST[btn])){
        // $qry="INSERT INTO `contact`(`contact_id`, `name`, `email`, `subject`, `message`, `date`, `time`) VALUES ('NULL','$_POST[name]','$_POST[email]','$_POST[subject]','$_POST[message]','$date','$time')";
       
       
    //   print_r($qry);
    //     die;
        $rr=$con->query("INSERT INTO `contact`(`contact_id`, `name`, `email`, `subject`, `message`, `date`, `time`) VALUES ('NULL','$_POST[name]','$_POST[email]','$_POST[subject]','$_POST[message]','$date','$time')");
        
         
    if($rr==TRUE){
        echo "<script>alert('Thanks for Contact! Our Team Will let you soon.');</script>";
    }else{
        echo "<script>alert('Query Failed');</script>";
    }    
    }
    
    
    ?>

    <!--<div class="map-contact">-->
    <!--    <iframe class="map-w3layouts"-->
    <!--        src="https://goo.gl/maps/bC119JM31WMdWpmCA"-->
    <!--        width="100%" height="400" frameborder="0" style="border: 0px;" allowfullscreen=""></iframe>-->
    <!--</div>-->
    <!-- //contact -->

    <!-- footer -->
    <?php
    include('include/footer.php');
    ?>
    <!-- //footer -->

    <!-- Js scripts -->
    <!-- move top -->
    <button onclick="topFunction()" id="movetop" title="Go to top">
        <span class="fas fa-level-up-alt" aria-hidden="true"></span>
    </button>
    <script>
        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function () {
            scrollFunction()
        };

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                document.getElementById("movetop").style.display = "block";
            } else {
                document.getElementById("movetop").style.display = "none";
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
    </script>
    <!-- //move top -->

    <!-- common jquery plugin -->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <!-- //common jquery plugin -->

    <!-- theme switch js (light and dark)-->
    <script src="assets/js/theme-change.js"></script>
    <script>
        function autoType(elementClass, typingSpeed) {
            var thhis = $(elementClass);
            thhis.css({
                "position": "relative",
                "display": "inline-block"
            });
            thhis.prepend('<div class="cursor" style="right: initial; left:0;"></div>');
            thhis = thhis.find(".text-js");
            var text = thhis.text().trim().split('');
            var amntOfChars = text.length;
            var newString = "";
            thhis.text("|");
            setTimeout(function () {
                thhis.css("opacity", 1);
                thhis.prev().removeAttr("style");
                thhis.text("");
                for (var i = 0; i < amntOfChars; i++) {
                    (function (i, char) {
                        setTimeout(function () {
                            newString += char;
                            thhis.text(newString);
                        }, i * typingSpeed);
                    })(i + 1, text[i]);
                }
            }, 1500);
        }

        $(document).ready(function () {
            // Now to start autoTyping just call the autoType function with the 
            // class of outer div
            // The second paramter is the speed between each letter is typed.   
            autoType(".type-js", 200);
        });
    </script>
    <!-- //theme switch js (light and dark)-->

    <!-- MENU-JS -->
    <script>
        $(window).on("scroll", function () {
            var scroll = $(window).scrollTop();

            if (scroll >= 80) {
                $("#site-header").addClass("nav-fixed");
            } else {
                $("#site-header").removeClass("nav-fixed");
            }
        });

        //Main navigation Active Class Add Remove
        $(".navbar-toggler").on("click", function () {
            $("header").toggleClass("active");
        });
        $(document).on("ready", function () {
            if ($(window).width() > 991) {
                $("header").removeClass("active");
            }
            $(window).on("resize", function () {
                if ($(window).width() > 991) {
                    $("header").removeClass("active");
                }
            });
        });
    </script>
    <!-- //MENU-JS -->

    <!-- disable body scroll which navbar is in active -->
    <script>
        $(function () {
            $('.navbar-toggler').click(function () {
                $('body').toggleClass('noscroll');
            })
        });
    </script>
    <!-- //disable body scroll which navbar is in active -->

    <!--bootstrap-->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- //bootstrap-->
    <!-- //Js scripts -->
</body>

</html>