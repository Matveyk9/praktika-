<?php
$orders = Eshop::getOrders($db);

function show_order(Order $order, int $num)
{
	$otpl = file_get_contents(ADMIN_DIR . "order.tpl");
	$otpl = str_replace("{{NUM}}", $num, $otpl);
	$otpl = str_replace("{{CUSTOMER}}", $order->customer, $otpl);
	$otpl = str_replace("{{EMAIL}}", $order->email, $otpl);
	$otpl = str_replace("{{PHONE}}", $order->phone, $otpl);
	$otpl = str_replace("{{ADDRESS}}", $order->address, $otpl);
	$otpl = str_replace("{{CREATED}}", $order->created, $otpl);
	$total = 0;
	$num = 0;

	echo $otpl;
	echo "<h3>Купленные товары:</h3>
		<table>
			<tr>
				<th>N п/п</th>
				<th>Название</th>
				<th>Автор</th>
				<th>Год издания</th>
				<th>Цена, руб.</th>
				<th>Количество</th>
			</tr>";
	foreach ($order->items as $book) {

		$itpl = file_get_contents(ADMIN_DIR . "order_item.tpl");
		$itpl = str_replace("{{NUM}}", ++$num, $itpl);
		$itpl = str_replace("{{TITLE}}", $book->title, $itpl);
		$itpl = str_replace("{{AUTHOR}}", $book->author, $itpl);
		$itpl = str_replace("{{PUBYEAR}}", $book->pubyear, $itpl);
		$itpl = str_replace("{{PRICE}}", $book->price, $itpl);
		$itpl = str_replace("{{QUANTITY}}", 1, $itpl);
		$total += $book->price;
		echo $itpl;
	}
	echo "</table>\n<p>Всего товаров в заказе на сумму: {$total} руб.</p> ";
}
?>

<h1>Поступившие заказы:</h1>
<a href="/admin">Назад в админку</a>
<?php
$num = 0;
foreach ($orders as $order) {
	show_order($order, ++$num);
}
?>
<!-- <hr>
<h2>Заказ номер: </h2>
<p><b>Заказчик</b>: </p>
<p><b>Email</b>: </p>
<p><b>Телефон</b>: </p>
<p><b>Адрес доставки</b>: </p>
<p><b>Дата размещения заказа</b>: </p>

<h3>Купленные товары:</h3>
<table>
	<tr>
		<th>N п/п</th>
		<th>Название</th>
		<th>Автор</th>
		<th>Год издания</th>
		<th>Цена, руб.</th>
		<th>Количество</th>
	</tr>
</table>
<p>Всего товаров в заказе на сумму: руб.</p> -->