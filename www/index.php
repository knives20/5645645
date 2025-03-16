<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plantilla Web PHP</title>
    <!-- Tailwind CSS desde CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-gray-100 min-h-screen">
    <header class="bg-blue-600 text-white shadow-lg">
        <div class="container mx-auto px-4 py-6">
            <h1 class="text-3xl font-bold">Plantilla Web PHP</h1>
            <p class="mt-2">Contenedor optimizado para desarrollo web con PHP, HTML, Tailwind CSS y JS</p>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-4">Información del Servidor</h2>
            
            <div class="mb-6">
                <h3 class="text-xl font-medium mb-2">PHP Version</h3>
                <div class="bg-gray-100 p-3 rounded">
                    <?php echo 'PHP ' . phpversion(); ?>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="text-xl font-medium mb-2">Extensiones PHP Instaladas</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <?php
                    $extensions = [
                        'curl' => 'Necesario para peticiones HTTP',
                        'json' => 'Necesario para API y procesamiento JSON',
                        'mysqli' => 'Necesario para conexión a base de datos',
                        'gd' => 'Necesario para procesamiento de imágenes',
                        'mbstring' => 'Necesario para manejo de caracteres multibyte',
                        'xml' => 'Necesario para procesamiento XML',
                        'openssl' => 'Necesario para conexiones seguras',
                        'session' => 'Necesario para manejo de sesiones'
                    ];

                    foreach ($extensions as $ext => $description) {
                        $installed = extension_loaded($ext);
                        $color = $installed ? 'green' : 'red';
                        $icon = $installed ? '✅' : '❌';
                        echo "<div class='p-3 border rounded bg-gray-50'>";
                        echo "<span class='text-{$color}-600'>{$icon} {$ext}</span>: {$description}";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="text-xl font-medium mb-2">Límites PHP</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="py-2 px-4 text-left">Configuración</th>
                                <th class="py-2 px-4 text-left">Valor Actual</th>
                                <th class="py-2 px-4 text-left">Recomendado</th>
                                <th class="py-2 px-4 text-left">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $limits = [
                                'memory_limit' => ['actual' => ini_get('memory_limit'), 'recommended' => '256M'],
                                'post_max_size' => ['actual' => ini_get('post_max_size'), 'recommended' => '64M'],
                                'upload_max_filesize' => ['actual' => ini_get('upload_max_filesize'), 'recommended' => '32M'],
                                'max_execution_time' => ['actual' => ini_get('max_execution_time'), 'recommended' => '120'],
                                'max_input_time' => ['actual' => ini_get('max_input_time'), 'recommended' => '120']
                            ];

                            foreach ($limits as $name => $values) {
                                $actual = $values['actual'];
                                $recommended = $values['recommended'];
                                
                                // Conversión simple para comparar valores
                                $actualValue = (int)$actual;
                                $recommendedValue = (int)$recommended;
                                
                                if (strpos($actual, 'M') !== false) {
                                    $actualValue = (int)$actual * 1;
                                }
                                if (strpos($recommended, 'M') !== false) {
                                    $recommendedValue = (int)$recommended * 1;
                                }
                                
                                $status = $actualValue >= $recommendedValue ? '✅' : '❌';
                                $color = $actualValue >= $recommendedValue ? 'green' : 'red';
                                
                                echo "<tr class='border-b hover:bg-gray-50'>";
                                echo "<td class='py-2 px-4'>{$name}</td>";
                                echo "<td class='py-2 px-4'>{$actual}</td>";
                                echo "<td class='py-2 px-4'>{$recommended}</td>";
                                echo "<td class='py-2 px-4 text-{$color}-600'>{$status}</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="mt-6">
                <h3 class="text-xl font-medium mb-2">Test de MIME Types</h3>
                <div id="mime-types-container" class="grid grid-cols-1 gap-2">
                    <!-- Los resultados del test de MIME types se cargarán aquí mediante JavaScript -->
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-gray-800 text-white py-6 mt-8">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; <?php echo date('Y'); ?> Plantilla Web PHP. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Script para testear MIME types -->
    <script src="js/mime-test.js"></script>
</body>
</html>
