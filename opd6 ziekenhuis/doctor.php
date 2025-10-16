<?php
require_once 'Staff.php';
require_once 'Appointment.php';

class Doctor extends Staff
{
    private float $hourlyRate;

    public function __construct(string $name, float $hourlyRate)
    {
        parent::__construct($name, "Doctor");
        $this->hourlyRate = $hourlyRate;
    }

    public function getHourlyRate(): float
    {
        return $this->hourlyRate;
    }

    public function setHourlyRate(float $rate): void
    {
        $this->hourlyRate = $rate;
    }

    public function defineRole(): string
    {
        return "Ik ben een dokter met een uurtarief van €{$this->hourlyRate}.";
    }

    // Bereken salaris op basis van alle afspraken
    public function calculateSalary(array $appointments): float
    {
        $totalHours = 0;
        foreach ($appointments as $appt) {
            if ($appt->getDoctor() === $this) {
                $totalHours += $appt->getTimeDifference();
            }
        }
        $this->salary = $totalHours * $this->hourlyRate;
        return $this->salary;
    }
}
?>
