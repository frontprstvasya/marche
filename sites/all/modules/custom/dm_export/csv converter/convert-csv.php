<?php
$assoc_array = [];
if (($handle = fopen("descriptoin.csv", "r")) !== false) {
    if (($data = fgetcsv($handle, 3274, ",")) !== false) {
        $keys = $data;
    }
    while (($data = fgetcsv($handle, 3274, ",")) !== false) {
        $assoc_array[] = array_combine($keys, $data);
    }
    fclose($handle);
}
echo "<pre>";
    var_export($assoc_array);
echo "</pre>";
