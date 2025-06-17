#!/bin/sh

# Colores para mejorar la visualización
GREEN='\033[0;32m'
YELLOW='\033[0;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color
BLUE='\033[0;34m'

# Función para mostrar mensajes con formato
log_info() {
    echo "${BLUE}[INFO]${NC} $1"
}

log_process() {
    echo "${YELLOW}[PROCESO]${NC} $1"
}

log_success() {
    echo "${GREEN}[ÉXITO]${NC} $1"
}

log_error() {
    echo "${RED}[ERROR]${NC} $1"
}

# Función para ejecutar comandos con manejo de errores
execute_command() {
    log_process "$1"
    eval "$2"

    if [ $? -ne 0 ]; then
        log_error "Error al ejecutar: $2"
        return 1
    fi

    log_success "$3"
    return 0
}

PROJECT_NAME="SISTEMA_AL_V2"
if [ -f .env ]; then
    APP_NAME_LINE=$(grep "^APP_NAME=" .env)
    if [ $? -eq 0 ]; then
        PROJECT_NAME=$(echo "$APP_NAME_LINE" | cut -d '=' -f 2)
        # Eliminar comillas si están presentes
        PROJECT_NAME=$(echo "$PROJECT_NAME" | sed 's/"//g')
    fi
else
    PROJECT_NAME="SISTEMA_AL_V2"
fi

# Encabezado principal
echo "\n${BLUE}============================================${NC}"
echo "${BLUE}      INICIALIZACIÓN DE ${PROJECT_NAME}        ${NC}"
echo "${BLUE}============================================${NC}\n"

# Actualizar e instalar dependencias de Composer
execute_command "Actualizando dependencias con Composer..." \
                "composer update" \
                "Dependencias actualizadas correctamente"

echo "\n${BLUE}--------------------------------------------${NC}"

# Verificar si DB_LOCAL es false para ejecutar migraciones
DB_LOCAL_VALUE=$(grep "^DB_LOCAL=" .env | cut -d '=' -f 2 | tr -d '[:space:]')

if [ "$DB_LOCAL_VALUE" = "true" ]; then
    # Ejecutar migraciones y seeders
    execute_command "Ejecutando migraciones y seeders..." \
                    "php artisan migrate:fresh --seed" \
                    "Base de datos migrada y semillas aplicadas correctamente"
else
    log_info "DB_LOCAL está configurado como '$DB_LOCAL_VALUE'. No se ejecutarán migraciones."
fi

echo "\n${BLUE}--------------------------------------------${NC}"

log_process "Limpiando caché de configuración y aplicación..."
php artisan config:clear
if [ $? -ne 0 ]; then
    log_warn "Advertencia: No se pudo limpiar toda la caché, pero se continuará."
    # Opcionalmente, puedes hacerlo un error fatal:
    # log_error "Error al limpiar la caché"
    # exit 1
fi
log_success "Caché limpiada correctamente"

log_process "Generando clave de aplicación..."
php artisan key:generate
if [ $? -ne 0 ]; then
    log_error "Error al generar la clave de aplicación"
    exit 1
fi
log_success "Clave de aplicación generada correctamente"

log_process "Cacheando la configuración..."
(unset APP_KEY && php artisan config:cache)
if [ $? -ne 0 ]; then
    log_error "Error al cachear la configuración"
    exit 1
fi
log_success "Configuración cacheada correctamente"

echo "\n${BLUE}--------------------------------------------${NC}"

# Iniciar PHP-FPM
log_process "Iniciando PHP-FPM..."
exec php-fpm

# Esta parte solo se ejecutará si php-fpm falla
log_error "PHP-FPM se ha detenido inesperadamente"
exit 1
