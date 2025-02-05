<?php

$id = Cleaner::uint($_GET["id"]);
Eshop::addItemToBasket($id, $basket);

header("Location: /catalog");
exit();