<h1>NotasApp 🎓</h1>

<p><strong>NotasApp</strong> es una plataforma construida con Laravel para gestionar el registro de notas académicas. Incluye diferentes roles (Administrador, Profesor, Estudiante) con accesos y funcionalidades personalizadas para cada uno.</p>

<h2>🚀 Características</h2>
<ul>
  <li><strong>Administrador</strong>
    <ul>
      <li>Crear, editar y eliminar materias.</li>
      <li>Asignar profesores.</li>
      <li>Gestionar usuarios.</li>
    </ul>
  </li>
  <li><strong>Profesor</strong>
    <ul>
      <li>Registrar materias.</li>
      <li>Asignar y editar notas del primer y segundo corte.</li>
      <li>Ver nota definitiva calculada automáticamente.</li>
    </ul>
  </li>
  <li><strong>Estudiante</strong>
    <ul>
      <li>Matricular materias disponibles.</li>
      <li>Ver sus materias inscritas y sus respectivas notas.</li>
      <li>Cancelar materias.</li>
    </ul>
  </li>
</ul>

<h2>🛠 Tecnologías</h2>
<ul>
  <li>PHP 8+</li>
  <li>Laravel 10+</li>
  <li>Tailwind CSS</li>
  <li>Laravel Breeze (autenticación)</li>
  <li>MySQL / MariaDB</li>
  <li>XAMPP / Laravel Sail / Valet</li>
</ul>

<h2>⚙️ Instalación</h2>
<ol>
  <li>Clona el repositorio:
    <pre><code>git clone https://github.com/TU_USUARIO/notasapp.git
cd notasapp</code></pre>
  </li>
  <li>Instala dependencias:
    <pre><code>composer install
npm install &amp;&amp; npm run dev</code></pre>
  </li>
  <li>Copia el archivo de entorno y configura tu base de datos:
    <pre><code>cp .env.example .env
php artisan key:generate</code></pre>
    <p>Edita <code>.env</code> y configura:</p>
    <pre><code>DB_DATABASE=notasapp
DB_USERNAME=root
DB_PASSWORD=</code></pre>
  </li>
  <li>Ejecuta las migraciones y seeders:
    <pre><code>php artisan migrate --seed</code></pre>
  </li>
  <li>Inicia el servidor local:
    <pre><code>php artisan serve</code></pre>
  </li>
  <li>Abre en el navegador: <a href="http://localhost:8000">http://localhost:8000</a></li>
</ol>

<h2>🔑 Credenciales por defecto</h2>
<pre><code>Admin:
  email: admin@notasapp.com
  password: password

Profesor:
  email: profesor@notasapp.com
  password: password

Estudiante:
  email: estudiante@notasapp.com
  password: password
</code></pre>
<p><em>Puedes modificar o crear más usuarios desde la base de datos o el panel de administrador.</em></p>

<h2>🧩 Estructura de roles</h2>
<pre><code>User (rol)
├── Admin     → Control total
├── Profesor  → Registra materias y notas
└── Estudiante→ Matricula materias y ve notas
</code></pre>


