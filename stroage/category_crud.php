<?php


function save_category($mysqli, $categoryName, $categoryImg)
{
    $sql = "INSERT INTO `category` (`categoryName`,`categoryImg`) VALUE ('$categoryName','$categoryImg')";
    return $mysqli->query($sql);
}

function get_category_pag_count($mysqli)
{
    $sql = "SELECT COUNT(`id`) AS total FROM `category`";
    $count = $mysqli->query($sql);
    $total = $count->fetch_assoc();
    $page = ceil($total['total'] / 5) ;
    return $page;
}


function get_category($mysqli, $currentPage)
{
    $sql = "SELECT * FROM `category` ORDER BY `id` LIMIT 5 OFFSET $currentPage";
    return $mysqli->query($sql);
}

function get_category_filter($mysqli, $key)
{
    $sql = "SELECT * FROM `cateory` WHERE `categoryName` LIKE '%$key%'";
    return $mysqli->query($sql);
}

function get_all_categories($mysqli, )
{
    $sql = "SELECT * FROM `category` ";
    return $mysqli->query($sql);
}
