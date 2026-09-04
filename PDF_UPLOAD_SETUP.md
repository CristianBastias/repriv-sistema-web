# Configuración de carga de PDF — REPRIV

La aplicación acepta PDFs de hasta **10 MB**.

## XAMPP / Apache

1. Reemplazar el proyecto por esta versión.
2. Reiniciar Apache desde XAMPP.
3. Si Apache utiliza `mod_php`, `public/.htaccess` aplica automáticamente los límites necesarios.
4. Si PHP está configurado como CGI/FastCGI, PHP utilizará `.user.ini`.
5. Si el servidor ignora ambos archivos, editar el `php.ini` activo y configurar:

```ini
upload_max_filesize = 20M
post_max_size = 25M
max_file_uploads = 20
max_execution_time = 120
max_input_time = 120
memory_limit = 256M
```

Luego reiniciar Apache.

## Límite de la aplicación

Laravel mantiene el límite funcional en **10 MB** (`10240 KB`). Los límites de PHP se dejan por encima para evitar que PHP rechace la petición antes de que Laravel pueda validarla.
