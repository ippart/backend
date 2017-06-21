<ul class="vertical menu accordion-menu" data-accordion-menu>
    <?php foreach ($categories as $category) { ?>

    <?php if ($category['children']) { ?>

    <li>
        <a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
        <ul class="menu vertical nested <?php if ($category['category_id'] == $category_id) { echo 'is-active'; } ?>">
            <?php foreach ($category['children'] as $child) { ?>
            <li><a href="<?php echo $child['href']; ?>"><?php echo $child['name']; ?></a></li>
            <?php } ?>
        </ul>
    </li>
    <?php } else { ?>
    <li>
        <a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
    </li>
    <?php } ?>

    <?php } ?>
</ul>
