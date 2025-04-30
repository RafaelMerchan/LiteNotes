# LiteNotes

**LiteNotes** es una aplicación web para crear, editar, listar y eliminar notas, desarrollada con:

- **Laravel 12** (backend, API REST)
- **Vue.js 3** (frontend, SPA)
- **Docker** (contenedorización completa)

---

## 📦 Estructura del proyecto

```
litenotes/
├── backend/    # Proyecto Laravel + Docker
├── frontend/   # Proyecto Vue.js
└── README.md   # Este archivo
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
