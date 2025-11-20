<?php
echo "<h3>Tabel Perkalian 1–10</h3>";

echo "<table border='1' cellpadding='8' cellspacing='0' style='text-align:center; border-collapse:collapse;'>";
echo "<tr>";
echo "<td style='background:lime; font-weight:bold;'>Bilangan</td>";

for ($i = 1; $i <= 10; $i++) {
    echo "<td style='background:lime; font-weight:bold;'>$i</td>";
}
echo "</tr>";
for ($i = 1; $i <= 10; $i++) {
    echo "<tr>";
    echo "<td style='background:lime; font-weight:bold;'>$i</td>";

    for ($j = 1; $j <= 10; $j++) {
        $hasil = $i * $j;
        if ($hasil % 2 == 0) {
            $warna = "#00e6e6"; 
        } else {
            $warna = "yellow";
        }

        echo "<td style='background:$warna;'>$hasil</td>";
    }

    echo "</tr>";
}

echo "</table>";
?>