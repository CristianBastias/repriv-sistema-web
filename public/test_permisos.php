<?php
$tmp_dir = ini_get('upload_tmp_dir');
if (empty($tmp_dir)) {
    $tmp_dir = sys_get_temp_dir();
}
echo "Carpeta temporal de PHP: " . $tmp_dir . "<br>";

$test_file = $tmp_dir . '/test.txt';
if (file_put_contents($test_file, 'Hola Mundo')) {
    echo "¡ÉXITO! PHP puede escribir en la carpeta temporal.";
    unlink($test_file); // Borramos el archivo de prueba
} else {
    echo "ERROR: PHP no puede escribir en la carpeta temporal.";
}
?>
