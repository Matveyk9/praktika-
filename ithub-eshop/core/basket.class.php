<?php

class Basket
{
  static function init()
  {
    if (isset($_COOKIE["eshop"]))
      return Basket::read();
    else {
      $basket = Basket::create();
      Basket::save($basket);
      return $basket;
    }
  }

  static function add(int $id, array $basket)
  {
    $basket[$id] = 1;
    return $basket;
  }

  static function remove(int $id, array $basket)
  {
    unset($basket[$id]);
    return $basket;
  }

  static function create()
  {
    return [
      "order-id" => gen_order_id()
    ];
  }

  static function save(array $basket)
  {
    setcookie("eshop", json_encode($basket), time() + 60 * 60 * 24 * 30);
  }

  static function read(): array
  {
    return json_decode($_COOKIE["eshop"], true);
  }
}

function gen_order_id()
{
  return uniqid(rand(5, 30));
}