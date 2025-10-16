<?php
// ---------------------------
// Parent class: Figure
// ---------------------------
class Figure {
    protected string $color;

    public function __construct(string $color) {
        $this->color = $color;
    }

    public function getColor(): string {
        return $this->color;
    }

    public function draw(): string {
        return ""; // abstract idea, override in subclasses
    }
}

// ---------------------------
// Child classes
// ---------------------------

// Circle
class Circle extends Figure {
    private int $length;

    public function __construct(string $color, int $length) {
        parent::__construct($color);
        $this->length = $length;
    }

    public function draw(): string {
        $radius = $this->length / 2;
        return "<circle cx='{$radius}' cy='{$radius}' r='{$radius}' fill='{$this->color}' />";
    }
}

// Square
class Square extends Figure {
    private int $length;

    public function __construct(string $color, int $length) {
        parent::__construct($color);
        $this->length = $length;
    }

    public function draw(): string {
        return "<rect width='{$this->length}' height='{$this->length}' fill='{$this->color}' />";
    }
}

// Rectangle
class Rectangle extends Figure {
    private int $height;
    private int $width;

    public function __construct(string $color, int $height, int $width) {
        parent::__construct($color);
        $this->height = $height;
        $this->width = $width;
    }

    public function draw(): string {
        return "<rect width='{$this->width}' height='{$this->height}' fill='{$this->color}' />";
    }
}

// Triangle
class Triangle extends Figure {
    private int $height;
    private int $width;

    public function __construct(string $color, int $height, int $width) {
        parent::__construct($color);
        $this->height = $height;
        $this->width = $width;
    }

    public function draw(): string {
        $p1 = "0,{$this->height}";
        $p2 = "{$this->width}/2,0";
        $p3 = "{$this->width},{$this->height}";
        return "<polygon points='0,{$this->height} " . ($this->width/2) . ",0 {$this->width},{$this->height}' fill='{$this->color}' />";
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Drie op een rij - Figuren</title>
    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
            text-align: center;
        }
        svg {
            margin: 20px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <h1>Drie op een rij - Figuren</h1>
    <div>
        <?php
        // Maak figuren aan
        $circle = new Circle("red", 100);
        $square = new Square("blue", 100);
        $rectangle = new Rectangle("green", 80, 150);
        $triangle = new Triangle("orange", 100, 100);

        // Toon elk figuur in een eigen SVG
        echo "<svg width='120' height='120'>{$circle->draw()}</svg>";
        echo "<svg width='120' height='120'>{$square->draw()}</svg>";
        echo "<svg width='160' height='120'>{$rectangle->draw()}</svg>";
        echo "<svg width='120' height='120'>{$triangle->draw()}</svg>";
        ?>
    </div>
</body>
</html>
