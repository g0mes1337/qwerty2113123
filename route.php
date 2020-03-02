<?php
include_once "application/config/route_pages.php";
include_once "application/core/database/connect.php";


$current = $pages[$routes[1]];
include __DIR__ . "/application/template/".$current['link'];
