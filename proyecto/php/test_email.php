<?php
require_once 'enviar_email.php';

echo "<h2>🧪 Probando Mailtrap...</h2>";

$resultado = enviarEmail(
    'test@example.com',
    'Prueba BiblioManager - Mailtrap',
    '
    <html>
    <body style="font-family: Arial; padding: 20px;">
        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; border-radius: 10px; text-align: center;">
            <h1>🎉 ¡Mailtrap funciona!</h1>
            <p>El sistema está listo.</p>
        </div>
        <p style="margin-top: 20px;">
            <strong>Fecha:</strong> ' . date('Y-m-d H:i:s') . '
        </p>
    </body>
    </html>
    '
);

if ($resultado) {
    echo "<div style='background: #d4edda; color: #155724; padding: 20px; margin: 20px 0;'>";
    echo "✅ <strong>Correo enviado</strong><br>Ve a Mailtrap → My Inbox";
    echo "</div>";
} else {
    echo "<div style='background: #f8d7da; color: #721c24; padding: 20px; margin: 20px 0;'>";
    echo "❌ <strong>Error</strong><br>Verifica config_email.php";
    echo "</div>";
}
?>
