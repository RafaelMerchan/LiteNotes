<template>
    <div class="py-12">
      <div class="max-w-md mx-auto sm:px-6 lg:px-8 space-y-6 bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Crear cuenta</h2>
        <form @submit.prevent="register">
          <div class="mb-4">
            <label for="name" class="block text-gray-700 mb-1">Nombre</label>
            <input
              v-model="name"
              id="name"
              type="text"
              required
              class="w-full px-4 py-2 border rounded"
            />
          </div>
  
          <div class="mb-4">
            <label for="email" class="block text-gray-700 mb-1">Correo electrónico</label>
            <input
              v-model="email"
              id="email"
              type="email"
              required
              class="w-full px-4 py-2 border rounded"
            />
          </div>
  
          <div class="mb-4">
            <label for="password" class="block text-gray-700 mb-1">Contraseña</label>
            <input
              v-model="password"
              id="password"
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
            Registrarse
          </button>
        </form>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios'
  
  export default {
    name: 'RegisterView',
    data() {
      return {
        name: '',
        email: '',
        password: '',
        error: ''
      }
    },
    methods: {
      async register() {
        try {
          const response = await axios.post('/register', {
            name: this.name,
            email: this.email,
            password: this.password
          })
          const tokenResponse = await axios.post('/login', {
            email: this.email,
            password: this.password
          })
          const token = tokenResponse.data.token
          localStorage.setItem('token', token)
          this.$router.push('/')
        } catch (e) {
          if (e.response?.data?.errors?.email?.[0]) {
            this.error = e.response.data.errors.email[0]
          } else if (e.response?.data?.message) {
            this.error = e.response.data.message
          } else {
            this.error = 'Hubo un error al registrarse'
          }
        }
      }
    }
  }
  </script>
  