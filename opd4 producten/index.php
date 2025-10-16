<?php
require_once "Product.php";

$list = new ProductList();

/* MUSIC */
$m1 = new Music("All eyez on me", 5.0, 21, 1.0, "Desc");
$m1->setArtist("Tupac");
$m1->addNumber("Ambitionz az a ridah");
$m1->addNumber("2 of Amerikaz most wanted");
$list->addProduct($m1);

/* MOVIES */
$mov1 = new Movie("Star Wars <br> revenge of the sith ", 10.0, 21, 2.5, "Desc");
$mov1->setQuality("DVD");
$list->addProduct($mov1);

/* GAMES */
$g1 = new Game("Grand theft auto VI", 5.0, 21, 1.5, "Desc");
$g1->setGenre("Action");
$g1->addRequirement("16gb geheugen");
$g1->addRequirement("3060 RTX");
$list->addProduct($g1);

/* OUTPUT TABLE */
echo "<table border='1' cellpadding='8' cellspacing='0'>
<tr><th>Category</th><th>Naam product</th><th>Verkoopprijs</th><th>Info</th></tr>";

foreach ($list->getProducts() as $p) {
    echo "<tr>
        <td>{$p->getCategory()}</td>
        <td>{$p->getName()}</td>
        <td>{$p->getSalesPrice()}</td>
        <td>{$p->getInfo()}</td>
    </tr>";
}
echo "</table>";
?>