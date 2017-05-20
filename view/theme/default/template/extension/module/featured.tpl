<section class="products">
    <header class="text-center">
        <h1 class="uppercase"><?php echo $heading_title; ?></h1>
    </header>
    <section class="row large-up-3">
        <?php foreach ($products as $product) { ?>
            <div class="column column-block">
                <div class="card card-product">
                    <div class="card-product-img-wrapper">
                        <a class="button expanded">Добавить в корзину</a>
                        <a href="<?php echo $product['href']; ?>">
                            <img src="<?php echo $product['thumb']; ?>"
                                 title="<?php echo $product['name']; ?>">
                        </a>
                    </div>
                    <div class="card-section">
                        <a href="<?php echo $product['href']; ?>"><h3 class="card-product-name"><?php echo $product['name']; ?></h3></a>
                        <?php if ($product['price']) { ?>
                            <h5 class="card-product-price"><?php echo $product['price']; ?></h5>
                        <?php } ?>
                        <p class="card-product-description"><?php echo $product['description']; ?></p>
                    </div>
                </div>
            </div>
        <?php } ?>
    </section>
</section>
