<template>
    <div class="py-12">
      <div class="max-w-md mx-auto sm:px-6 lg:px-8 space-y-6 bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Iniciar sesión</h2>
        <form @submit.prevent="login">
          <div class="mb-4">
            <label class="block text-gray-700 mb-1" for="email">Correo electrónico</label>
            <input
              id="email"
              v-model="email"
              type="email"
              required
              class="w-full px-4 py-2 border rounded"
            />
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 mb-1" for="password">Contraseña</label>
            <input
              id="password"
              v-model="password"
              type="password"
              required
              class="w-full px-4 py-2 border rounded"
            />
          </div>
          <div v-if="error" class="text-red-500 text-sm mb-2">
            {{ error }}
          </div>
          <button
            type="submit"
            class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-500 w-full"
          >
            Ingresar
          </button>
          <p class="mt-4 text-center text-sm">
            ¿No tienes cuenta?
            <router-link to="/register" class="text-indigo-600 hover:underline">
                Regístrate aquí
            </router-link>
          </p>
        </form>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios'
  
  export default {
    name: 'LoginView',
    data() {
      return {
        email: '',
        password: '',
        error: ''
      }
    },
    methods: {
      async login() {
        try {
          const response = await axios.post('http://localhost:8000/api/login', {
            email: this.email,
            password: this.password
          })
          const token = response.data.token
          localStorage.setItem('token', token)
          this.$router.push('/') // redirige a Home
        } catch (err) {
          this.error = 'Correo o contraseña incorrectos'
        }
      }
    }
  }
  </script>
  