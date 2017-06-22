<div class="column column-block">
    <div class="card card-product">
        <div class="card-product-img-wrapper">
            <a class="button expanded">Добавить в корзину</a>
            <a href="<?php echo $product->getHref(); ?>">
<?php
    $thumb = $resizer->resize(
        $product->getImage(),
        200,
        200
    );
?>
                <img src="<?php echo $thumb ?>"
                     title="<?php echo $product->getName(); ?>">
            </a>
        </div>
        <div class="card-section">
            <a href="<?php echo $product->getHref(); ?>"><h3 class="card-product-name"><?php echo $product->getName(); ?></h3></a>
            <?php if ($product->getPrice()) { ?>
            <h5 class="card-product-price"><?php echo $product->getPrice(); ?></h5>
            <?php } ?>
            <p class="card-product-description"><?php echo $product->getDescriptionShort($descriptionLength); ?></p>
        </div>
    </div>
</div>
