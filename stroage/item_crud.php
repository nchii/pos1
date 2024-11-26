<?php


function save_item($mysqli, $itemName, $price, $category_id, $itemImg)
{
    $sql = "INSERT INTO `item` (`name`,`price`,`category_id`,`itemImg`) VALUE ('$itemName',$price,$category_id,'$itemImg')";
    return $mysqli->query($sql);
}

function get_item_pag_count($mysqli)
{
    $sql = "SELECT COUNT(`id`) AS total FROM `item`";
    $count = $mysqli->query($sql);
    $total = $count->fetch_assoc();
    $page = ceil($total['total'] / 5) ;
    return $page;
}



function get_item_filter($mysqli, $key)
{
    $sql = "SELECT t1.*,t2.categoryName
  FROM `item` t1 INNER JOIN `category` t2 ON t1.category_id=t2.id 
  WHERE t1.name LIKE '%$key%'";
    return $mysqli->query($sql);
}

function get_all_items($mysqli, )
{
    $sql = "SELECT * FROM `item` ";
    return $mysqli->query($sql);
}

function get_all_item_join($mysqli,$currentPage){
  $sql=" SELECT t1.*,t2.categoryName
  FROM `item` t1
  INNER JOIN `category` t2 ON t1.category_id=t2.id ORDER BY `id` LIMIT 5 OFFSET $currentPage";
  return $mysqli->query($sql);
}

