<?php
declare(strict_types=1);


$currentPage = $_SERVER['REQUEST_URI'];
if (!isset($_SESSION["visited_pages"])) {
    $_SESSION["visited_pages"] = [];
}

$_SESSION["visited_pages"][] = $currentPage;
?>