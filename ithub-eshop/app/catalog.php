<?php
function build_catalog(Book $book)
{
	$tpl = file_get_contents(APP_DIR . "catalog.tpl");
	$tpl = str_replace("{{TITLE}}", $book->title, $tpl);
	$tpl = str_replace("{{AUTHOR}}", $book->author, $tpl);
	$tpl = str_replace("{{PRICE}}", $book->price, $tpl);
	$tpl = str_replace("{{PUBYEAR}}", $book->pubyear, $tpl);
	$tpl = str_replace("{{ID}}", $book->id, $tpl);
	return $tpl;
}
?>


<h1>Каталог товаров</h1>
<p class="admin"><a href="admin">админка</a></p>
<p>Товаров в <a href="basket">корзине</a>: <?php echo count($basket) - 1 ?></p>
<table>
	<tr>
		<th>Название</th>
		<th>Автор</th>
		<th>Год издания</th>
		<th>Цена, руб.</th>
		<th>В корзину</th>
	</tr>
	<?php
	$data = Eshop::getItemsFromCatalog($db);
	foreach ($data as $book) {
		echo build_catalog($book);
	}
	?>
</table>