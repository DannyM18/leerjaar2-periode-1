<?php
require_once 'Person.php';

class Patient extends Person
{
    private float $payment;

    public function __construct(string $name, float $payment)
    {
        parent::__construct($name, "Patient");
        $this->payment = $payment;
    }

    public function getPayment(): float
    {
        return $this->payment;
    }

    public function setPayment(float $payment): void
    {
        $this->payment = $payment;
    }

    public function defineRole(): string
    {
        return "Ik ben een patiënt die €{$this->payment} per behandeling betaalt.";
    }
}
?>
