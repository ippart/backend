<section class="row line-bottom">
    <header class="text-center">
        <h3>Популярные бренды</h3>
    </header>
    <div class="ecommerce-hero-slider-small orbit" role="region" aria-label="Favorite Space Pictures" data-orbit>
        <ul class="orbit-container">
            <button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button>
            <button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>
            <?php foreach ($banners as $banner) { ?>
                <li class="is-active orbit-slide">
                    <div class="hero-slider-slide">
                        <div class="row">
                            <div class="small-12 medium-3 columns">
                                <img src="<?php echo $banner['image']; ?>"
                                     alt="<?php echo $banner['title']; ?>">
                            </div>
                            <div class="small-12 medium-9 columns">
                                <div class="hero-slider-slide-content">
                                    <h3><?php echo $banner['title']; ?></h3>
                                    <p>The sensors installed in forward-looking infrared cameras—as well as those of
                                        other thermal imaging cameras—use detection of infrared radiation, typically
                                        emitted from a heat source (thermal radiation), to create an image assembled for
                                        video output.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            <?php } ?>
        </ul>
        <nav class="orbit-bullets">
            <button class="is-active" data-slide="0">
                <span class="show-for-sr">First slide details.</span>
                <span class="show-for-sr">Current Slide</span>
            </button>
            <?php $i = 0; ?>
            <?php foreach ($banners as $banner) { ?>
                <button data-slide="<?php echo ++$i; ?>"><span class="show-for-sr"><?php echo $banner['title']; ?></span></button>
            <?php } ?>
        </nav>
    </div>
</section>
