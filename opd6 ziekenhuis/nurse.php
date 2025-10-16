<?php
require_once 'Staff.php';
require_once 'Appointment.php';

class Nurse extends Staff
{
    private float $fixedSalary;
    private float $bonusPerHour;

    public function __construct(string $name, float $fixedSalary, float $bonusPerHour)
    {
        parent::__construct($name, "Nurse");
        $this->fixedSalary = $fixedSalary;
        $this->bonusPerHour = $bonusPerHour;
    }

    public function defineRole(): string
    {
        return "Ik ben een assistente met een vast loon van €{$this->fixedSalary} en bonus van €{$this->bonusPerHour}/uur.";
    }

    // Bereken salaris: vast loon + bonus voor afspraken
    public function calculateSalary(array $appointments): float
    {
        $bonusHours = 0;
        foreach ($appointments as $appt) {
            $nurses = $appt->getNurses();
            foreach ($nurses as $nurse) {
                if ($nurse === $this) {
                    $bonusHours += $appt->getTimeDifference();
                }
            }
        }
        $this->salary = $this->fixedSalary + ($bonusHours * $this->bonusPerHour);
        return $this->salary;
    }
}
?>
