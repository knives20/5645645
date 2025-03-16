// Script para testear los MIME types
document.addEventListener('DOMContentLoaded', function() {
    const mimeTypesContainer = document.getElementById('mime-types-container');
    
    // Lista de extensiones a testear y sus MIME types correctos
    const mimeTests = [
        { extension: 'js', file: 'test.js', expectedMime: 'application/javascript' },
        { extension: 'css', file: 'test.css', expectedMime: 'text/css' },
        { extension: 'json', file: 'test.json', expectedMime: 'application/json' },
        { extension: 'xml', file: 'test.xml', expectedMime: 'text/xml' },
        { extension: 'svg', file: 'test.svg', expectedMime: 'image/svg+xml' },
        { extension: 'ttf', file: 'test.ttf', expectedMime: 'application/x-font-ttf' },
        { extension: 'woff', file: 'test.woff', expectedMime: 'application/x-font-woff' },
        { extension: 'woff2', file: 'test.woff2', expectedMime: 'application/font-woff2' },
        { extension: 'eot', file: 'test.eot', expectedMime: 'application/vnd.ms-fontobject' },
        { extension: 'ico', file: 'test.ico', expectedMime: 'image/x-icon' }
    ];
    
    // Crear archivos de prueba vacíos si no existen (se manejan en el servidor)
    
    // Función para verificar el MIME type
    function testMimeType(test) {
        fetch(`/test-files/${test.file}`)
            .then(response => {
                const contentType = response.headers.get('content-type');
                const isCorrect = contentType === test.expectedMime;
                
                // Crear elemento para mostrar el resultado
                const resultItem = document.createElement('div');
                resultItem.className = `p-3 border rounded ${isCorrect ? 'bg-green-50' : 'bg-red-50'}`;
                
                const icon = isCorrect ? '✅' : '❌';
                const textColor = isCorrect ? 'text-green-600' : 'text-red-600';
                
                resultItem.innerHTML = `
                    <span class="${textColor}">${icon} MIME ${test.extension}</span>: 
                    ${contentType || 'application/x-empty'} 
                    (debería ser ${test.expectedMime})
                `;
                
                mimeTypesContainer.appendChild(resultItem);
            })
            .catch(error => {
                console.error('Error al probar MIME type:', error);
                const resultItem = document.createElement('div');
                resultItem.className = 'p-3 border rounded bg-red-50';
                resultItem.innerHTML = `❌ Error al probar MIME ${test.extension}: ${error.message}`;
                mimeTypesContainer.appendChild(resultItem);
            });
    }
    
    // Realizar pruebas para cada tipo MIME
    mimeTests.forEach(test => testMimeType(test));
});
