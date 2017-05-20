<footer class="footer">
    <section class="row">
        <div class="large-2 columns">
            <h6><?php echo $text_information; ?></h6>
            <ul class="vertical menu">
                <?php foreach ($informations as $information) { ?>
                    <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
        <div class="large-2 columns">
            <h6><?php echo $text_service; ?></h6>
            <ul class="vertical menu">
                <li><a href="<?php echo $manufacturer; ?>"><?php echo $text_manufacturer; ?></a></li>
                <li><a href="<?php echo $voucher; ?>"><?php echo $text_voucher; ?></a></li>
                <li><a href="<?php echo $affiliate; ?>"><?php echo $text_affiliate; ?></a></li>
                <li><a href="<?php echo $special; ?>"><?php echo $text_special; ?></a></li>
            </ul>
        </div>
        <div class="large-2 columns">
            <h6>Дополнительно</h6>
            <ul class="vertical menu">
                <li><a href="#">Производители (бренды)</a></li>
                <li><a href="#">Подарочные сертификаты</a></li>
                <li><a href="#">Партнёрская программа</a></li>
                <li><a href="#">Акции</a></li>
            </ul>
        </div>
        <div class="large-2 columns">
            <h6><?php echo $text_account; ?></h6>
            <ul class="vertical menu">
                <li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
                <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
                <li><a href="<?php echo $wishlist; ?>"><?php echo $text_wishlist; ?></a></li>
                <li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
            </ul>
        </div>
        <div class="large-4 columns text-center">
            <h6>Связаться с нами</h6>
            <span class="phone">8-800-100-90-86</span>
            <div>
                <a href="#">Форма обратной связи</a>
            </div>
        </div>
    </section>
    <hr>
    <section class="row">
        <div class="large-8 columns">
            <p>Принимаем к оплате:</p>
        </div>
        <div class="large-4 columns small-text text-right">
            <p>Приборы, Радиодетали и Электронные компоненты<br>© Ай-Пи Электроникс, 2002—2017</p>
        </div>
    </section>
</footer>
<script src="http://ip.imega.club/scripts/bundle.js"></script>
