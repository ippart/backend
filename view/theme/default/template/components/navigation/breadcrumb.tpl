<ul class="breadcrumbs">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb->getUrl(); ?>"><?php echo $breadcrumb->getTitle(); ?></a></li>
    <?php } ?>
</ul>
