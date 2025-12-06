<?php
declare(strict_types=1);

if (!empty($_SESSION['visited_pages']) && is_array($_SESSION['visited_pages'])) {
    echo 'Посещенные страницы: ';
    echo '<ul>';
    foreach ($_SESSION['visited_pages'] as $page) {
        echo '<li>' . $page . '</li>';
    }
    echo '</ul>';
} else {
    echo 'Вы еще не посещали никакие страницы';
}
?>