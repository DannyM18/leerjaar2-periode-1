<?php
require_once 'Patient.php';
require_once 'Doctor.php';
require_once 'Nurse.php';
require_once 'Appointment.php';

$patient1 = new Patient("Jan Jansen", 75.00);
$doctor1 = new Doctor("Dr. de Vries", 120.00);
$nurse1 = new Nurse("Lisa", 2000.00, 15.00);

$begin1 = new DateTime("2025-10-16 09:00");
$end1 = new DateTime("2025-10-16 11:00");
$appointment1 = new Appointment($patient1, $doctor1, [$nurse1], $begin1, $end1);

echo "<h3>Afspraakinformatie</h3>";
echo "Patiënt: " . $appointment1->getPatient()->getName() . "<br>";
echo "Dokter: " . $appointment1->getDoctor()->getName() . "<br>";
echo "Begin: " . $appointment1->getBeginTime() . "<br>";
echo "Einde: " . $appointment1->getEndTime() . "<br>";
echo "Duur (in uren): " . $appointment1->getTimeDifference() . "<br><br>";

echo "<h3>Salarissen en kosten</h3>";
echo $doctor1->getName() . " salaris: €" . $doctor1->calculateSalary(Appointment::$appointments) . "<br>";
echo $nurse1->getName() . " salaris: €" . $nurse1->calculateSalary(Appointment::$appointments) . "<br>";
echo $patient1->getName() . " betaalt: €" . $patient1->getPayment() . "<br>";
?>