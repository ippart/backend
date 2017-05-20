<section class="banner line-top">
    <div class="orbit" role="region" aria-label="Information" data-orbit
         data-options="animInFromRight: fade-in; animInFromLeft: fade-in; animOutToRight: fade-out; animOutToLeft: fade-out">
        <ul class="orbit-container">
            <button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;
            </button>
            <button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>
            <?php foreach ($banners as $banner) { ?>
                <li class="is-active orbit-slide">
                    <a href="<?php echo $banner['link']; ?>">
                    <img class="orbit-image" src="<?php echo $banner['image']; ?>"
                         alt="<?php echo $banner['title']; ?>">
                    <figcaption class="orbit-caption"><?php echo $banner['title']; ?></figcaption>
                    </a>
                </li>
            <?php } else { ?>
                <li class="is-active orbit-slide">
                    <img class="orbit-image" src="<?php echo $banner['image']; ?>"
                         alt="<?php echo $banner['title']; ?>">
                    <figcaption class="orbit-caption"><?php echo $banner['title']; ?></figcaption>
                </li>
            <?php } ?>
        </ul>
        <nav class="orbit-bullets">
            <button class="is-active" data-slide="0"><span
                        class="show-for-sr">First slide details.</span><span
                        class="show-for-sr">Current Slide</span></button>
            <button data-slide="1"><span class="show-for-sr">Second slide details.</span></button>
            <button data-slide="2"><span class="show-for-sr">Third slide details.</span></button>
            <button data-slide="3"><span class="show-for-sr">Fourth slide details.</span></button>
        </nav>
    </div>
</section>
