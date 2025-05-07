# LiteNotes

**LiteNotes** es una aplicación web CRUD de notas, desarrollada con:

- **Laravel 12** (API REST + autenticación Sanctum)
- **Vue.js 3** (SPA con rutas protegidas)
- **Docker** (backend dockerizado)
- **Tailwind CSS** (estilos)
- **Axios + Postman** (consumo y pruebas de la API)

---

## 📦 Estructura del proyecto

```
litenotes/
├── backend/            # Proyecto Laravel + Docker
├── frontend/           # Proyecto Vue.js
├── pruebas_Postman/    # Pruebas de Postman y carga CSV
└── README.md           # Este archivo
```

---

## 🚀 Requisitos

- Docker & Docker Compose
- Node.js (solo para frontend)

---

## 🐳 Cómo levantar el backend (Laravel + MySQL)

```bash
cd backend
docker compose up -d --build
docker exec -it litenotes_app php artisan migrate
```

El backend estará disponible en: [http://localhost:8000](http://localhost:8000)

---

## 🌐 Cómo levantar el frontend (Vue.js)

```bash
cd frontend
npm install
npm run serve
```

El frontend estará en: [http://localhost:8080](http://localhost:8080)

---

## 🧪 Características principales

- Login, registro y logout con Laravel Sanctum
- Token guardado en localStorage y enviado vía Axios
- Rutas protegidas por frontend y backend
- CRUD completo de notas (crear, ver, editar, eliminar)
- Validaciones frontend y backend
- Paginación de notas
- Estilos con Tailwind
- Carga opcional de notas desde CSV con DBeaver
- Scripts de arranque rápido para Windows y Linux/macOS

---


---

## 📚 Documentación de la API (Swagger)

La API REST de LiteNotes está documentada con **Swagger UI**, accesible en:

```
http://localhost:8000/api/documentation
```

### ¿Qué incluye?
- Endpoints documentados: `login`, `register`, `logout`, `GET/POST/PUT/DELETE /api/notes`
- Autenticación con token tipo **Bearer Sanctum**
- Posibilidad de probar cada endpoint con el botón **Try it out**

### ¿Cómo regenerar la documentación?

Si haces cambios en los controladores o anotaciones, ejecuta:

```bash
docker compose exec app php artisan l5-swagger:generate
```

### ¿Cómo autorizarme?

1. Ve al botón **Authorize** en Swagger UI.
2. Pega tu token Sanctum con formato:  
   `Bearer 1|xxxxxxxxxxxxxxxxxxxxxxxxx`
3. Ejecuta los endpoints protegidos sin errores 401.


## 📝 Licencia

Este proyecto fue desarrollado por Rafael Merchán como parte de sus prácticas y aprendizaje.