<?php
abstract class Product {
    protected string $name;
    protected float $purchasePrice;
    protected int $tax;
    protected string $description;
    protected float $profit;
    protected string $category;

    public function __construct($name, $purchasePrice, $tax, $profit, $description) {
        $this->name = $name;
        $this->purchasePrice = $purchasePrice;
        $this->tax = $tax;
        $this->profit = $profit;
        $this->description = $description;
    }

    public function getName() { return $this->name; }
    public function getCategory() { return $this->category; }
    public function getSalesPrice() {
        return round($this->purchasePrice + $this->profit + ($this->purchasePrice * $this->tax / 100), 2);
    }

    abstract public function getInfo();
}

/* ===== MUSIC ===== */
class Music extends Product {
    private string $artist;
    private array $numbers = [];

    public function __construct($name, $purchasePrice, $tax, $profit, $description) {
        parent::__construct($name, $purchasePrice, $tax, $profit, $description);
        $this->category = "Music";
    }

    public function setArtist($artist) { $this->artist = $artist; }
    public function addNumber($number) { $this->numbers[] = $number; }

    public function getInfo() {
        $html = "<b>Artiest:</b> {$this->artist}<br><b>Extra info</b><ul>";
        foreach ($this->numbers as $num) $html .= "<li>$num</li>";
        $html .= "</ul>";
        return $html;
    }
}

/* ===== MOVIE ===== */
class Movie extends Product {
    private string $quality;

    public function __construct($name, $purchasePrice, $tax, $profit, $description) {
        parent::__construct($name, $purchasePrice, $tax, $profit, $description);
        $this->category = "Movie";
    }

    public function setQuality($quality) { $this->quality = $quality; }

    public function getInfo() {
        return "<b>{$this->quality}</b>";
    }
}

/* ===== GAME ===== */
class Game extends Product {
    private string $genre;
    private array $requirements = [];

    public function __construct($name, $purchasePrice, $tax, $profit, $description) {
        parent::__construct($name, $purchasePrice, $tax, $profit, $description);
        $this->category = "Game";
    }

    public function setGenre($genre) { $this->genre = $genre; }
    public function addRequirement($req) { $this->requirements[] = $req; }

    public function getInfo() {
        $html = "<b>{$this->genre}</b><br><b>Extra info</b><ul>";
        foreach ($this->requirements as $req) $html .= "<li>$req</li>";
        $html .= "</ul>";
        return $html;
    }
}

/* ===== PRODUCTLIST ===== */
class ProductList {
    private array $products = [];

    public function addProduct(Product $p) { $this->products[] = $p; }

    public function getProducts() { return $this->products; }
}
?>
