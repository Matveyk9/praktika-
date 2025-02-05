<?php

$id = Cleaner::uint($_GET["id"]);
Eshop::removeItemFromBasket($id, $basket);

header("Location: /basket");
exit();