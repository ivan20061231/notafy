# Notafy 📚

**Notafy** es una plataforma construida con Laravel para gestionar el registro de materias y notas académicas. Incluye roles con accesos diferenciados para Administradores, Profesores y Estudiantes.

## 🚀 Características

- **Administrador**
  - Gestiona usuarios (profesores y estudiantes).
  - Crea, edita y elimina materias.
  - Asigna profesores a materias.
- **Profesor**
  - Registra materias bajo su cargo.
  - Asigna y edita notas del primer y segundo corte.
  - Visualiza la nota definitiva (calculada automáticamente).
- **Estudiante**
  - Se matricula en materias con cupo disponible.
  - Visualiza sus materias inscritas y notas.
  - Cancela materias si lo desea.

## 🛠 Tecnologías

- PHP 8+
- Laravel 11+
- Tailwind CSS
- Laravel Breeze (autenticación)
- MySQL / MariaDB
- XAMPP / Laravel Sail / Valet

## ⚙️ Instalación

1. Clona el repositorio:
    ```bash
    git clone https://github.com/ivan20061231/notafy.git
    cd notafy
    ```

2. Instala las dependencias:
    ```bash
    composer install
    npm install && npm run dev
    ```

3. Copia el archivo de entorno y configura tu base de datos:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    Edita el archivo `.env`:
    ```env
    DB_DATABASE=notafy
    DB_USERNAME=root
    DB_PASSWORD=
    ```

4. Ejecuta las migraciones y seeders:
    ```bash
    php artisan migrate --seed
    ```

5. Inicia el servidor local:
    ```bash
    php artisan serve
    ```

6. Abre en el navegador: [http://localhost:8000](http://localhost:8000)

## 🔑 Credenciales por defecto

```txt
Admin:
  email: admin@notafy.com
  password: password

Profesor:
  email: profesor@notafy.com
  password: password

Estudiante:
  email: estudiante@notafy.com
  password: password
Puedes modificar o crear más usuarios desde la base de datos o el panel de administrador.

🧩 Estructura de roles
pgsql
Copiar
Editar
User (rol)
├── Admin     → Control total
├── Profesor  → Registra materias y notas
└── Estudiante→ Matricula materias y ve notas