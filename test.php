<?php
$prices = ['123876 akakask', 'jn 123', 'от 444 за п/м', 4000000];

foreach ($prices as $price) {
    $int_prices[] = preg_replace('/[^0-9]+/', '', $price);
}

$imploded_int_prices = implode(',', $int_prices);

$sql = 'INSERT INTO catalog SET price_int VALUES ('.$imploded_int_prices.')';

echo $sql;
