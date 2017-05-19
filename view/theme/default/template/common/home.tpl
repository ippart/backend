<?php echo $header;?>
<section class="main">
    <div class="row">
        <section class="large-3 columns">
            <ul class="vertical menu accordion-menu" data-accordion-menu>
                <?php foreach ($categories as $category) { ?>

                    <?php if ($category['children']) { ?>

                        <li>
                            <a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>

                            <?php foreach (array_chunk($category['children'], ceil(count($category['children']) / $category['column'])) as $children) { ?>
                            <ul class="menu vertical nested">
                                <?php foreach ($children as $child) { ?>
                                    <li><a href="#">Головки динамические (Громкоговорители)</a></li>
                                    <li><a href="#">Излучатели звука (Зуммер)</a></li>
                                    <li><a href="#">Клеммы акустические</a></li>
                                <?php } ?>
                            </ul>
                            <?php } ?>
                        </li>
                    <?php } else { ?>
                        <li>
                            <a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
                        </li>
                    <?php } ?>

                <?php } ?>
            </ul>
            <section class="line-top about">
                <div class="card">
                    <div class="card-section">
                        <h6><a href="#">Мы участники</a></h6>
                        <p>
                            <img src="http://ippart.com/image/data/efind.png">
                            <img src="http://ippart.com/image/data/einfo.png">
                            <img src="http://ippart.com/image/data/chipfind.png">
                        </p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-section">
                        <h6><a href="#">Мы партнеры</a></h6>
                        <p>
                            <img src="http://ippart.com/image/data/ruichi.png">
                            <img src="http://ippart.com/image/data/zip.png">
                            <img src="http://ippart.com/image/data/rexant.png">
                            <img src="http://ippart.com/image/data/proconnect.png">
                        </p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-section">
                        <h6><a href="#">Мы спонсоры</a></h6>
                        <p>
                            <img src="http://ippart.com/image/data/mehanika.png">
                        </p>
                    </div>
                </div>
            </section>
        </section>
        <section class="large-9 columns">
        </section>
    </div>
</section>
<div class="container">
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?><?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>
