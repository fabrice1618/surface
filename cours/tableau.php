<?php

$a = array(1,13,17,5);
//$b = [1,13,17,5];


echo "acces direct 2eme element:" . $a[1] . "\n";

echo "Nombre elements:" . count($a) . "\n";
$a[] = 28;
$a[5] = 32;
$a[7] = 30;
$a[3] = 80;
$a[] = 90;

unset($a[7]);

print_r($a);

// foreach for while

echo "Boucle while\n";
$i = 0;
while ($i < count($a) ) {
  echo "acces direct ".$i." element:" . $a[$i] . "\n";
  $i = $i + 1; // $i += 1; $i++;
}

echo "Boucle For\n";
for ($i=0;$i<count($a);$i++) {
  echo "acces direct ".$i." element:" . $a[$i] . "\n";
}

echo "Boucle Foreach\n";
foreach ($a as $key => $value) {
  echo "acces direct ".$key." element:" . $value . "\n";
}

$b = array();
$b['nom'] = 'Dupont';
$b['prenom'] = 'Jean';
$b['age'] = 20;

print_r($b);
echo "Boucle Foreach\n";
foreach ($b as $key => $value) {
  echo "acces direct ".$key." element:" . $value . "\n";
}


//print_r($b);
