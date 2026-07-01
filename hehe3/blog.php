<?php
require_once 'includes/auth.php';
require_once 'includes/header.php';
require_once 'includes/navbar.php';
?>

<section class="py-5">
    <div class="container">
        <h1 class="fw-bold mb-5">Blog</h1>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card shadow-lg">
                    <img src="https://coresg-normal.trae.ai/api/ide/v1/text_to_image?prompt=jewelry%20fashion%20blog%20post%20image&image_size=landscape_16_9" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="fw-bold">Jewelry Trends 2026</h5>
                        <p class="text-muted">Discover the latest trends in fine jewelry...</p>
                        <a href="#" class="btn btn-outline-primary">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-lg">
                    <img src="https://coresg-normal.trae.ai/api/ide/v1/text_to_image?prompt=jewelry%20care%20tips%20blog%20image&image_size=landscape_16_9" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="fw-bold">Caring for Your Jewelry</h5>
                        <p class="text-muted">Learn how to keep your jewelry sparkling...</p>
                        <a href="#" class="btn btn-outline-primary">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-lg">
                    <img src="https://coresg-normal.trae.ai/api/ide/v1/text_to_image?prompt=gift%20guide%20jewelry%20blog%20image&image_size=landscape_16_9" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="fw-bold">Perfect Gift Guide</h5>
                        <p class="text-muted">Find the perfect jewelry gift for any occasion...</p>
                        <a href="#" class="btn btn-outline-primary">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
require_once 'includes/footer.php';
?>