<?php
require_once dirname(__FILE__) . '/../config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kalkulator kredytowy</title>
</head>
<body>

<h2>Kalkulator kredytowy</h2>

<form action="<?php print(_APP_URL); ?>/app/calc.php" method="post">
    Kwota kredytu (PLN): <br>
    <input type="number" name="amount" step="0.01"><br>

    Okres spłaty (lata): <br>
    <input type="number" name="years"><br>

    Oprocentowanie roczne (%): <br>
    <input type="number" name="interest" step="0.01"><br>

    <input type="submit" value="Oblicz ratę">
</form>

<?php
if (isset($messages) && count($messages) > 0) {
    echo '<p>Błędy:</p><ul>';
    foreach ($messages as $msg) {
        echo '<li>' . htmlspecialchars($msg) . '</li>';
    }
    echo '</ul>';
}

if (isset($result)) {
    echo "<p>Miesięczna rata: <strong>" . round($result, 2) . " PLN</strong></p>";
}
?>

</body>
</html>
