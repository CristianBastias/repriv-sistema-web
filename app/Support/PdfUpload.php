<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Validator;

class PdfUpload
{
    public const MAX_KB = 10240; // 10 MB
    public const MAX_BYTES = 10485760;

    /**
     * Devuelve un mensaje amigable cuando PHP rechazó la subida antes
     * de que Laravel pudiera validarla.
     */
    public static function uploadError(?UploadedFile $file): ?string
    {
        if (!$file || $file->getError() === UPLOAD_ERR_OK) {
            return null;
        }

        return match ($file->getError()) {
            UPLOAD_ERR_INI_SIZE => 'El PDF supera el límite permitido por PHP. El máximo configurado es 10 MB.',
            UPLOAD_ERR_FORM_SIZE => 'El PDF supera el tamaño máximo permitido por el formulario (10 MB).',
            UPLOAD_ERR_PARTIAL => 'El PDF se recibió de forma incompleta. Verifique la conexión e inténtelo nuevamente.',
            UPLOAD_ERR_NO_FILE => 'Debe seleccionar un archivo PDF.',
            UPLOAD_ERR_NO_TMP_DIR => 'El servidor no tiene disponible el directorio temporal para recibir archivos.',
            UPLOAD_ERR_CANT_WRITE => 'El servidor no pudo escribir el archivo recibido. Verifique los permisos de almacenamiento.',
            UPLOAD_ERR_EXTENSION => 'Una extensión de PHP interrumpió la carga del archivo.',
            default => 'No fue posible cargar el PDF. Verifique el archivo e inténtelo nuevamente.',
        };
    }

    /**
     * Valida el PDF de forma uniforme en todo el sistema.
     */
    public static function rules(): array
    {
        return [
            'required',
            'file',
            'mimes:pdf',
            'max:' . self::MAX_KB,
        ];
    }

    /**
     * Detecta cuando PHP rechazó el cuerpo completo de la petición por
     * post_max_size y, por lo tanto, Laravel no recibió ningún archivo.
     */
    public static function postSizeError($request): ?string
    {
        if ($request->hasFile('archivo')) {
            return null;
        }

        $contentLength = (int) $request->server('CONTENT_LENGTH', 0);
        $postMaxSize = self::iniBytes('post_max_size');

        if ($contentLength > 0 && $postMaxSize > 0 && $contentLength > $postMaxSize) {
            return 'La solicitud supera el límite de carga configurado en PHP. El máximo permitido para los documentos es 10 MB.';
        }

        return null;
    }

    private static function iniBytes(string $value): int
    {
        $value = trim((string) ini_get($value));
        if ($value === '') {
            return 0;
        }

        $last = strtolower($value[strlen($value) - 1]);
        $number = (float) $value;

        return (int) match ($last) {
            'g' => $number * 1024 * 1024 * 1024,
            'm' => $number * 1024 * 1024,
            'k' => $number * 1024,
            default => $number,
        };
    }
}
