<?php
require("../init.php");
@$area = $_REQUEST['area'];//地区
if(!$area){
    $area ="";
}
@$pricelow = $_REQUEST['pricelow'];//价格下限
if(!$pricelow){
    $pricelow = 0;
}
@$pricehigh = $_REQUEST['pricehigh '];//价格上限
if(!$pricehigh ){
    $pricehigh  = 999999;
}
@$sizelow = $_REQUEST['sizelow'];//面积下限
if(!$sizelow){
    $sizelow = 0;
}
@$sizehigh = $_REQUEST['sizehigh'];//面积上限
if(!$sizehigh){
    $sizehigh = 99999;
}
@$house_room = $_REQUEST['house_room'];//房型
if(!$house_room){
    $house_room = 99999;
}

@$side=$_REQUEST["side"]; //朝向 东 南 西 北
if(!$side){
		$side="";
}

@$floor=$_REQUEST["floor"];//楼层 低楼层/中楼层/高楼层
if(!$floor){
		$floor="";
}

@$input=$_REQUEST["input"];// 1 代表价格由低到高 2 代表价格由高到低 3 代表价格由低到高

$sql = " SELECT * FROM re_zufang WHERE area like '%$area%' AND  price >= $pricelow AND price <= $pricehigh ";
$sql .= " AND  size >= $sizelow AND size <= $sizehigh AND house_room <= $house_room";
$sql .=" AND side like '%$side%' AND floor like '%$floor%'";
if($input==1){
	$sql.=" group by price asc";
}else if($input==2){
	$sql.=" group by size";
}else if($input==3){
	$sql.=" group by size asc";
}

$result = mysqli_query($conn,$sql);
$rows = mysqli_fetch_all($result,MYSQLI_ASSOC);
echo json_encode($rows);