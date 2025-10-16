<?php
require_once 'Patient.php';
require_once 'Doctor.php';
require_once 'Nurse.php';

class Appointment
{
    private Patient $patient;
    private Doctor $doctor;
    private array $nurses;
    private DateTime $beginTime;
    private DateTime $endTime;

    public static array $appointments = [];

    public function __construct(Patient $patient, Doctor $doctor, array $nurses, DateTime $beginTime, DateTime $endTime)
    {
        $this->patient = $patient;
        $this->doctor = $doctor;
        $this->nurses = $nurses;
        $this->beginTime = $beginTime;
        $this->endTime = $endTime;

        self::$appointments[] = $this; // Static opslag
    }

    public function getPatient(): Patient
    {
        return $this->patient;
    }

    public function getDoctor(): Doctor
    {
        return $this->doctor;
    }

    public function getNurses(): array
    {
        return $this->nurses;
    }

    public function getBeginTime(): string
    {
        return $this->beginTime->format('Y-m-d H:i');
    }

    public function getEndTime(): string
    {
        return $this->endTime->format('Y-m-d H:i');
    }

    public function getTimeDifference(): float
    {
        $interval = $this->beginTime->diff($this->endTime);
        return $interval->h + ($interval->i / 60);
    }

    public function getCost(): float
    {
        // Totale kosten (alleen ter voorbeeld)
        $duration = $this->getTimeDifference();
        $doctorCost = $duration * $this->doctor->getHourlyRate();
        $nurseCost = 0;
        foreach ($this->nurses as $nurse) {
            $nurseCost += $duration * $nurse->getSalary();
        }
        return $doctorCost + $nurseCost + $this->patient->getPayment();
    }
}
?>
