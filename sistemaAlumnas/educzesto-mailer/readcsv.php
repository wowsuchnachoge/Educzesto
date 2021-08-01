<?php
if(($handle = fopen('/home/wowsuchnachoge/Educzesto/Ejemplos.csv', 'r')) !== FALSE) {
    // Leer la primer linea y no hacer nada
    $row = fgetcsv($handle, 100);
    //
    while(($row = fgetcsv($handle, 100)) !== FALSE) {
        echo "Numero: $row[0] - Nombre: $row[1] - Correo: $row[2]<br>";
    }
    fclose($handle);
}
?>