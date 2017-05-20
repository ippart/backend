<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="description" content="<?php echo $description; ?>">
    <meta name="keywords" content= "<?php echo $keywords; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?></title>
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="stylesheet" href="http://ip.imega.club/styles/main.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400,700&amp;subset=cyrillic" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
</head>
<body>
<header class="header">
    <div class="row">
        <div class="large-3 small-12 columns">
            <div class="logo">LOGO</div>
            <div class="description-small">desc</div>
        </div>
        <div class="large-7 small-12 columns">
            <div class="description text-center">
                <p>Электронные компоненты и расходные материалы</p>
            </div>
            <div class="row">
                <div class="large-4 columns">
                    <span class="phone">8-800-100-90-86</span>
                    <p><span class="phone-desc">Звонок по России бесплатный</span></p>
                </div>
                <div class="large-4 columns">
                    <span class="email">info@ippart.com</span>
                    <p><span class="email-desc">Все контакты</span></p>
                </div>
                <div class="large-4 columns">
                    <span class="email">9:00 - 17:00</span>
                    <p><span class="email-desc">Отдел заказов</span></p>
                </div>
            </div>
        </div>
        <div class="large-2 columns">
            right
        </div>
    </div>
</header>
<section class="find">
    <div class="row">
        <div class="large-3 columns">
            <div class="catalog">
                <a href=""><i class="fa fa-bars" aria-hidden="true"></i>
                    Категории каталога</a>
            </div>
        </div>
        <div class="large-7 columns">
            <header class="hero-search-filter">
                <div class="hero-search-filter-content">
                    <form class="hero-search-filter-form" action="">
                        <label for="findtext">Искать</label>
                        <input id="findtext" class="hero-search-filter-form-find" type="text"/>
                        <div class="divider">&nbsp;</div>
                        <label for="findlocate">Группа</label>
                        <input id="findlocate" class="hero-search-filter-form-near" type="text"/>
                        <button class="button secondary"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </header>
        </div>
        <div class="large-2 columns">
            <div class="cart">
                <a href="#" class="button-badge">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="badge">3</span>
                </a>
                Корзина
            </div>
        </div>
    </div>
</section>
