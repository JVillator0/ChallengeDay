1. La collection de postman cuenta con una feature para hacer login y que automaticamente se cambie la variable de entorno del Token para evitar cambiarla manualmente.
2. Para acceder a todas las rutas de la prueba se necesita hacer login primero, las unicas rutas no protegidas son `/api/login` y `/api/status`
3. Se peude ejecutar "php artisan migrate:refresh --seed" o tambien puede importar la base de datos usando el archivo .sql
