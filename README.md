# Plantilla Docker para Desarrollo Web PHP

Esta plantilla proporciona un entorno Docker optimizado para desarrollo web con PHP 8.3.19, HTML, Tailwind CSS y JavaScript. Incluye tanto OpenLiteSpeed como Nginx como servidores web, configurados correctamente para soportar todos los requisitos y tests necesarios.

## Características

- **PHP 8.3.19** con todas las extensiones requeridas:
  - curl, json, mysqli, gd, mbstring, xml, openssl, session
- **Límites PHP optimizados**:
  - memory_limit: 256M
  - post_max_size: 128M
  - upload_max_filesize: 128M
  - max_execution_time: 120
  - max_input_time: 120
- **Servidores Web**:
  - OpenLiteSpeed
  - Nginx
- **MIME Types correctamente configurados** para:
  - JavaScript, CSS, JSON, XML, SVG, TTF, WOFF, WOFF2, EOT, ICO
- **Tailwind CSS** para el diseño web
- **Docker Compose** para fácil configuración y despliegue

## Índice

- [Requisitos Previos](#requisitos-previos)
- [Estructura del Proyecto](#estructura-del-proyecto)
- [Guía Paso a Paso para Subir a GitHub desde VS Code](#guía-paso-a-paso-para-subir-a-github-desde-vs-code)
- [Guía Paso a Paso para Desplegar en Easypanel](#guía-paso-a-paso-para-desplegar-en-easypanel)
- [Configuración Adicional](#configuración-adicional)
- [Solución de Problemas](#solución-de-problemas)

## Requisitos Previos

Para utilizar esta plantilla, necesitarás:

- [Git](https://git-scm.com/downloads)
- [Visual Studio Code](https://code.visualstudio.com/)
- Extensión de [GitHub](https://marketplace.visualstudio.com/items?itemName=GitHub.vscode-pull-request-github) para VS Code
- [Docker](https://www.docker.com/products/docker-desktop/)
- Cuenta en [GitHub](https://github.com/)
- Acceso a [Easypanel](https://easypanel.io/)

## Estructura del Proyecto

```
web-plantilla/
│
├── Dockerfile                # Configuración del contenedor Docker
├── docker-compose.yml       # Configuración de Docker Compose
├── php.ini                  # Configuración personalizada de PHP
├── nginx.conf               # Configuración principal de Nginx
├── default.conf             # Configuración del sitio en Nginx
├── httpd_config.conf        # Configuración de OpenLiteSpeed
├── vhost.conf               # Configuración del host virtual en OpenLiteSpeed
├── mime.types               # Tipos MIME para corregir errores
├── entrypoint.sh            # Script de entrada para el contenedor
│
└── www/                     # Directorio raíz de la aplicación web
    ├── index.php            # Página principal de la aplicación
    ├── css/                 # Estilos CSS
    │   └── styles.css       # Estilos personalizados
    ├── js/                  # Scripts JavaScript
    │   └── mime-test.js     # Script para test de MIME types
    ├── images/              # Imágenes del sitio
    ├── fonts/               # Fuentes para el sitio
    └── test-files/          # Archivos para pruebas MIME
```

## Guía Paso a Paso para Subir a GitHub desde VS Code

### 1. Preparar el Repositorio Local

1. **Abre VS Code**:
   - Abre VS Code y selecciona "Abrir Carpeta".
   - Navega hasta tu carpeta `web-plantilla` y ábrela.

2. **Inicializa Git**:
   - Abre una terminal en VS Code (Terminal -> Nuevo Terminal).
   - Ejecuta el siguiente comando para inicializar un repositorio Git:
   ```powershell
   git init
   ```

3. **Crea un Archivo .gitignore**:
   - Es recomendable crear un archivo `.gitignore` para excluir archivos temporales:
   ```powershell
   New-Item -Path .gitignore -ItemType File
   ```
   - Añade el siguiente contenido al archivo `.gitignore`:
   ```
   .DS_Store
   .env
   node_modules/
   vendor/
   logs/
   *.log
   ```

4. **Agrega los Archivos al Repositorio**:
   ```powershell
   git add .
   ```

5. **Realiza el Primer Commit**:
   ```powershell
   git commit -m "Primer commit: Plantilla Docker para desarrollo web con PHP"
   ```

### 2. Conectar con GitHub

1. **Crea un Nuevo Repositorio en GitHub**:
   - Ve a [GitHub](https://github.com/) y accede a tu cuenta.
   - Haz clic en el botón "+" en la esquina superior derecha y selecciona "Nuevo repositorio".
   - Asigna un nombre (por ejemplo, `web-plantilla`) y una descripción opcional.
   - Deja el repositorio como público o privado según tus preferencias.
   - No inicialices el repositorio con ningún archivo.
   - Haz clic en "Crear repositorio".

2. **Conecta tu Repositorio Local con GitHub**:
   - GitHub mostrará instrucciones después de crear el repositorio. Usa los comandos para un repositorio existente:
   ```powershell
   git remote add origin https://github.com/TU_USUARIO/web-plantilla.git
   git branch -M main
   git push -u origin main
   ```

### 3. Uso de la Extensión de GitHub en VS Code

Si prefieres usar la interfaz gráfica:

1. **Instala la Extensión de GitHub**:
   - Ve a la pestaña de extensiones en VS Code (o presiona Ctrl+Shift+X).
   - Busca "GitHub Pull Requests and Issues" e instálala.

2. **Inicia Sesión en GitHub**:
   - Haz clic en el icono de GitHub en la barra lateral.
   - Sigue las instrucciones para iniciar sesión en tu cuenta de GitHub.

3. **Publica el Repositorio**:
   - Después de iniciar sesión, verás una opción para publicar tu rama.
   - Haz clic en "Publicar rama" para subir tu código a GitHub.

## Guía Paso a Paso para Desplegar en Easypanel

### 1. Preparación para Easypanel

1. **Asegúrate de que Easypanel esté instalado y funcionando**:
   - Verifica que tu servidor tenga Easypanel correctamente instalado y puedas acceder a su panel de control.

2. **Clona el Repositorio en Easypanel**:
   - En el panel de control de Easypanel, ve a la sección "Proyectos" o similar.
   - Selecciona "Crear nuevo proyecto" o "Añadir proyecto".
   - Elige la opción para clonar desde GitHub.
   - Introduce la URL de tu repositorio GitHub: `https://github.com/TU_USUARIO/web-plantilla.git`

### 2. Configuración del Proyecto en Easypanel

1. **Configura el Proyecto**:
   - Nombre del proyecto: `web-plantilla` (o el nombre que prefieras)
   - Tipo de proyecto: Selecciona "Docker Compose" o "Proyecto personalizado"
   - Puertos: Asegúrate de que los puertos 80, 443 y 8088 estén disponibles y mapeados correctamente

2. **Variables de Entorno (Opcional)**:
   - Si necesitas definir variables de entorno específicas, puedes hacerlo en esta sección.
   - Por defecto, el proyecto ya tiene definidas las variables necesarias en el archivo `docker-compose.yml`.

3. **Configuración de Dominio**:
   - Si deseas asignar un dominio personalizado a tu proyecto, configúralo en esta sección.
   - Puedes usar un subdominio de Easypanel o configurar un dominio personalizado con DNS.

### 3. Despliegue del Proyecto

1. **Inicia el Despliegue**:
   - Una vez configurado todo, haz clic en "Crear" o "Desplegar".
   - Easypanel comenzará a clonar tu repositorio y construir la imagen Docker.

2. **Monitoreo del Despliegue**:
   - Sigue el progreso del despliegue en la interfaz de Easypanel.
   - El proceso puede tardar varios minutos, dependiendo de la velocidad de tu servidor.

3. **Verificación del Despliegue**:
   - Una vez completado el despliegue, deberías ver un mensaje de éxito.
   - Haz clic en la URL proporcionada para acceder a tu aplicación web.
   - Verifica que la página de inicio se cargue correctamente y que todas las funcionalidades estén operativas.

## Configuración Adicional

### Personalización de PHP

Si necesitas modificar la configuración de PHP, puedes editar el archivo `php.ini` y reconstruir la imagen Docker:

```bash
# Después de modificar php.ini
docker-compose down
docker-compose build --no-cache
docker-compose up -d
```

### Cambio de Servidor Web

Por defecto, tanto OpenLiteSpeed como Nginx están configurados. Si prefieres usar solo uno:

1. **Para usar solo Nginx**:
   - Edita el archivo `entrypoint.sh` y comenta las líneas relacionadas con OpenLiteSpeed.
   - Reconstruye la imagen Docker.

2. **Para usar solo OpenLiteSpeed**:
   - Edita el archivo `entrypoint.sh` y comenta las líneas relacionadas con Nginx.
   - Reconstruye la imagen Docker.

## Solución de Problemas

### Errores Comunes en Docker

1. **Error de puertos en uso**:
   - Si los puertos 80, 443 o 8088 ya están en uso, modifica el mapeo de puertos en `docker-compose.yml`.

2. **Problemas de permisos**:
   - Asegúrate de que los archivos tengan los permisos adecuados:
   ```bash
   chmod +x entrypoint.sh
   ```

### Errores en Easypanel

1. **Fallo al clonar repositorio**:
   - Verifica que la URL del repositorio sea correcta y que sea público o tengas acceso a él.

2. **Error en la construcción de la imagen**:
   - Consulta los logs de Easypanel para identificar el problema específico.
   - Corrige el problema en tu repositorio, haz commit y push, luego intenta el despliegue nuevamente.

3. **La aplicación no funciona correctamente**:
   - Verifica los logs de la aplicación en Easypanel.
   - Comprueba que todas las extensiones PHP requeridas estén instaladas.

---

## Notas Adicionales

- Esta plantilla está optimizada para cumplir con requisitos específicos de extensiones PHP y MIME types.
- Para personalizar aún más la plantilla, puedes modificar los archivos de configuración según tus necesidades.
- Recuerda mantener actualizados los archivos de seguridad y las dependencias de PHP.

Si encuentras algún problema o tienes sugerencias, no dudes en crear un issue en el repositorio de GitHub.

---

**¡Feliz desarrollo!**
