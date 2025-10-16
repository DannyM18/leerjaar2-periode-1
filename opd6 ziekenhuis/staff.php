<?php
require_once 'Person.php';

abstract class Staff extends Person
{
    protected float $salary;

    public function __construct(string $name, string $role)
    {
        parent::__construct($name, $role);
        $this->salary = 0.0;
    }

    public function getSalary(): float
    {
        return $this->salary;
    }

    public function setSalary(float $amount): void
    {
        $this->salary = $amount;
    }

    // Elke staff moet zelf salarisberekening implementeren
    abstract public function calculateSalary(array $appointments): float;
}
?>
