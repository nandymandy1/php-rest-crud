<?php
$page = 'home';
include_once('./partials/head.php');
?>
<?php
include_once('./partials/navbar.php');
?>
<!-- PAGE CONTENT GOES HERE -->

<div id="carouselExampleIndicators" class="carousel slidept-5" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="./assets/images/banner-1.png" class="d-block w-100" alt="banner-1">
        </div>
        <div class="carousel-item">
            <img src="./assets/images/banner-2.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="./assets/images/banner-3.png" class="d-block w-100" alt="...">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </a>
</div>
<section class="bg-grey py-5">
    <div class="container">
        <h3 class="text-center mb-5">What do we have for you?</h3>
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore veniam quo sunt at ullam corporis, porro quia rerum atque commodi eos maxime ipsum blanditiis perferendis vero quidem, nobis reiciendis illo!</p>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Deserunt placeat sint sit excepturi aliquid temporibus.</p>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="text-center">
                    <img src="https://miro.medium.com/max/640/1*oUFe82URjWheBW7Ch0dVGw.jpeg" alt="" class="img-fluid home-img-what" />
                </div>
            </div>
        </div>
    </div>
</section>
<!-- PAGE CONTENT GOES HERE -->
<?php
include_once('./partials/footer.php');
?>
<?php
include_once('./partials/scripts.php');
?>
<!-- Custom Scripts Goes Here -->
<!-- Custom Scripts Goes Here -->
</body>

</html>