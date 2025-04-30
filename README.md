# LiteNotes

**LiteNotes** es una aplicación web para crear, editar, listar y eliminar notas, desarrollada con:

- **Laravel 12** (backend, API REST)
- **Vue.js 3** (frontend, SPA)
- **Docker** (contenedorización completa)

---

## 📦 Estructura del proyecto

```
litenotes/
├── backend/            # Proyecto Laravel + Docker
├── frontend/           # Proyecto Vue.js
├── pruebas_Postman/    # Pruebas de Postman para cargar base de datos y probar APIs
└── README.md           # Este archivo
```

---

## 🚀 Requisitos

- Docker & Docker Compose
- Node.js (solo para frontend)

---

## 🐳 Cómo levantar el backend (Laravel + MySQL)

1. Ve a la carpeta del backend:

```bash
cd backend
```

2. Levanta los contenedores:

```bash
docker compose up -d --build
```

3. Ejecuta las migraciones:

```bash
docker exec -it litenotes_app bash
php artisan migrate
exit
```

El backend estará disponible en: [http://localhost:8000](http://localhost:8000)

---

## 🌐 Cómo levantar el frontend (Vue.js)

1. Ve a la carpeta del frontend:

```bash
cd frontend
```

2. Instala dependencias:

```bash
npm install
```

3. Ejecuta el servidor de desarrollo:

```bash
npm run serve
```

El frontend estará en: [http://localhost:8080](http://localhost:8080)

---

## (Opcional) Cómo cargar la base de datos con DBeaver

1. Abre DBeaver

2. Accede a la base de datos `litenotes` (localhost, puerto 3306, user: `user`, password: `password`)

3. Haz clic derecho sobre la tabla `notes` → **Import Data**

4. Selecciona **CSV** y escoger el archivo "personajes_para_cargar.csv" de la carpeta pruebas_Postman

5. Mapea las columnas `title` y `content`, y opcionalmente `created_at` / `updated_at` si tu CSV los tiene (formato: `YYYY-MM-DD HH:MM:SS`)

6. Ejecuta la importación y revisa que los datos se vean en la tabla `notes`.

> También puedes hacer inserciones manuales en la tabla desde DBeaver si solo necesitas cargar unos pocos registros de prueba.

---

## 🧪 Características

- CRUD completo de notas
- Validaciones frontend y backend
- Paginación (5 por página)
- Vistas: crear, editar, ver, eliminar
- Estilos con Tailwind CSS
- Manejo de errores y mensajes de éxito

---

## 📝 Licencia

Este proyecto fue desarrollado por Rafael Merchán como parte de sus prácticas y aprendizaje.
