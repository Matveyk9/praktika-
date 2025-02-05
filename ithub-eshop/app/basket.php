<?php
function build_basket(int $counter, Book $book)
{
	$tpl = file_get_contents(APP_DIR . "basket.tpl");
	$tpl = str_replace("{{COUNT}}", $counter, $tpl);
	$tpl = str_replace("{{TITLE}}", $book->title, $tpl);
	$tpl = str_replace("{{AUTHOR}}", $book->author, $tpl);
	$tpl = str_replace("{{PRICE}}", $book->price, $tpl);
	$tpl = str_replace("{{PUBYEAR}}", $book->pubyear, $tpl);
	$tpl = str_replace("{{QUANTITY}}", 1, $tpl);
	$tpl = str_replace("{{ID}}", $book->id, $tpl);
	return $tpl;
}

$basketData = Eshop::getItemsFromBasket($basket, $db);
$totalPrice = 0;
?>

<p>Вернуться в <a href="/catalog">каталог</a></p>
<h1>Ваша корзина</h1>
<table>
	<tr>
		<th>N п/п</th>
		<th>Название</th>
		<th>Автор</th>
		<th>Год издания</th>
		<th>Цена, руб.</th>
		<th>Количество</th>
		<th>Удалить</th>
	</tr>
	<?php
	$counter = 0;
	foreach ($basketData as $book) {
		$totalPrice += $book->price;
		echo build_basket(++$counter, $book);
	}
	?>

</table>

<p>Всего товаров в корзине на сумму: <?php echo $totalPrice ?> руб.</p>

<div style="text-align:center">
	<input type="button" value="Оформить заказ!" onclick="location.href='/create_order'" />
</div>