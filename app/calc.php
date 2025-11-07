<?php
require_once dirname(__FILE__) . '/../config.php';

// Pobranie danych
$amount = isset($_POST['amount']) ? $_POST['amount'] : null;
$years = isset($_POST['years']) ? $_POST['years'] : null;
$interest = isset($_POST['interest']) ? $_POST['interest'] : null;

$messages = [];
$result = null;

// Walidacja
if (!isset($amount) || !isset($years) || !isset($interest)) {
    $messages[] = 'Nie podano wszystkich danych.';
} else {
    if ($amount <= 0) {
        $messages[] = 'Kwota kredytu musi być dodatnia.';
    }
    if ($years <= 0) {
        $messages[] = 'Liczba lat musi być większa od zera.';
    }
    if ($interest < 0) {
        $messages[] = 'Oprocentowanie nie może być ujemne.';
    }
}

// Obliczenia
if (count($messages) == 0) {
    $months = $years * 12;
    $monthlyRate = ($interest / 100) / 12;

    if ($monthlyRate > 0) {
        $result = $amount * ($monthlyRate * pow(1 + $monthlyRate, $months)) / (pow(1 + $monthlyRate, $months) - 1);
    } else {
        $result = $amount / $months;
    }
}

// Wywołanie widoku
include _ROOT_PATH . '/app/calc_view.php';
