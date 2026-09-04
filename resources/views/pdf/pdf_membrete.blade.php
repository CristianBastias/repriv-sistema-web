@if($position == 'header')
    <!-- ENCABEZADO INSTITUCIONAL CON IMAGEN -->
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 0px;">
        <tr>
            <td style="width: 100%; text-align: center;">
                <img src="{{ public_path('images/encabezado1.png') }}" style="width: 100%; max-height: 110px; object-fit: contain;" alt="Encabezado REPRIV">
            </td>
        </tr>
    </table>
@endif

@if($position == 'footer')
    <!-- CIERRE Y FIRMA INSTITUCIONAL -->
    <div style="font-family: 'Times New Roman', Times, serif; font-size: 11pt; line-height: 1.4; margin-top: 30px; text-align: justify;">
        <p style="margin-bottom: 15px;">
            A solicitud de parte interesada y a los fines de ser presentada ante las autoridades que así lo requieran, se expide el presente en la ciudad de La Rioja, capital de la provincia, a los {{ now()->format('d') }} días del mes de {{ ucfirst(now()->locale('es')->monthName) }} del Año {{ now()->year }}.
        </p>
    </div>

    <!-- Bloque de Sello y Firma -->
    <table style="width: 100%; border-collapse: collapse; margin-top: 40px;">
        <tr>
            <td style="width: 50%; text-align: center; vertical-align: bottom;">
                <!-- Espacio para sello -->
            </td>
            <td style="width: 50%; text-align: center; vertical-align: bottom; font-family: 'Times New Roman', Times, serif;">
                <div style="margin-bottom: 5px; font-weight: bold; font-size: 11pt;">
                    ________________________________________
                </div>
                <div style="font-size: 11pt;">
                    <strong><u>Jefe del Dpto. REPRIV</u></strong>
                </div>
            </td>
        </tr>
    </table>
@endif
