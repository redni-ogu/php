<nav>
    <h2>Навигация по сайту</h2>
    <?php
    $leftMenu = [
            ['link' => 'Домой',             'href' => 'index.php'],
            ['link' => 'О нас',             'href' => 'index.php?id=about'],
            ['link' => 'Контакты',          'href' => 'index.php?id=contact'],
            ['link' => 'Таблица умножения', 'href' => 'index.php?id=table'],
            ['link' => 'Калькулятор',       'href' => 'index.php?id=calc'],
    ];
    getMenu($leftMenu, true); ?>
</nav>
