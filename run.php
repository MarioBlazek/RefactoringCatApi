<?php

include "CatApi.php";

$cat = new CatApi();
$image = $cat->getRandomImage();

echo $image;