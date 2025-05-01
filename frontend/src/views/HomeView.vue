<template>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
      <div class="flex justify-between items-center mb-4">
        <h2 class="font-semibold text-2xl text-gray-800">Notes</h2>
        <router-link
          to="/notes/new"
          class="inline-block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-500"
        >
          + New note
        </router-link>
        <div class="mb-4 text-right text-gray-700 text-sm">
          <span v-if="user">👋 Hola, {{ user.name }}</span>
        </div>
        <button
          @click="logout"
          class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-400"
        >
          Cerrar sesión
        </button>

      </div>

      <div v-if="notes.length === 0">
        <p>You have no notes yet.</p>
      </div>

      <div v-for="note in notes" :key="note.id" class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
        <h2 class="font-bold text-2xl text-indigo-600">
          <router-link :to="`/notes/${note.id}`" class="hover:underline text-indigo-600 font-semibold">
            {{ note.title }}
          </router-link>
        </h2>
        <p class="mt-2">{{ limitText(note.content, 200) }}</p>
        <span class="block mt-4 text-sm opacity-70">{{ formatDate(note.updated_at) }}</span>
      </div>

      <div v-if="lastPage > 1" class="flex justify-between mt-6">
        <button @click="goToPage(currentPage - 1)" :disabled="currentPage === 1"
          class="bg-gray-200 px-4 py-2 rounded disabled:opacity-50">Anterior</button>
        <span>Página {{ currentPage }} de {{ lastPage }}</span>
        <button @click="goToPage(currentPage + 1)" :disabled="currentPage === lastPage"
          class="bg-gray-200 px-4 py-2 rounded disabled:opacity-50">Siguiente</button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'HomeView',
  data() {
    return {
      notes: [],
      currentPage: 1,
      lastPage: 1,
      user: null
    }
  },
  methods: {
    async fetchUser() {
      try {
        const response = await axios.get('/user')
        this.user = response.data
      } catch (e) {
        console.error('No se pudo cargar el usuario')
      }
    },
    fetchNotes(page = 1) {
      axios.get(`http://localhost:8000/api/notes?page=${page}`)
        .then(response => {
          this.notes = response.data.data
          this.currentPage = response.data.current_page
          this.lastPage = response.data.last_page
        })
        .catch(error => {
          console.error('Error al cargar notas:', error)
        })
    },
    goToPage(page) {
      if (page >= 1 && page <= this.lastPage) {
        this.fetchNotes(page)
      }
    },
    limitText(text, max) {
      return text.length > max ? text.substring(0, max) + '...' : text
    },
    formatDate(dateString) {
      const date = new Date(dateString)
      return date.toLocaleDateString() + ' ' + date.toLocaleTimeString()
    },
    async logout() {
      try {
        await axios.post('/logout')
      } catch (e) {
        console.warn('Ya estabas desconectado o el token expiró')
      } finally {
        localStorage.removeItem('token')
        this.$router.push('/login')
      }
    }
  },
  mounted() {
    this.fetchUser()
    this.fetchNotes()
  }
}
</script>
