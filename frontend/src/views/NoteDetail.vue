<template>
<div v-if="$route.query.success" class="mb-4 p-4 bg-green-100 text-green-800 rounded">
  Nota guardada con éxito.
</div>
    <div class="max-w-3xl mx-auto py-10 px-4">
      <div v-if="note">
        <h1 class="text-2xl font-bold text-indigo-600 mb-4">{{ note.title }}</h1>
        <p class="text-gray-800 whitespace-pre-line">{{ note.content }}</p>
  
        <div class="mt-6 space-x-4">
          <router-link
            :to="`/notes/${note.id}/edit`"
            class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-400"
          >
            Editar
          </router-link>
  
          <button @click="deleteNote" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-500">
            Eliminar
          </button>
        </div>
      </div>
  
      <div v-else>
        <p>Cargando nota...</p>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios'
  
  export default {
    name: 'NoteDetail',
    data() {
      return {
        note: null
      }
    },
    mounted() {
        this.fetchNote()

        if (this.$route.query.success) {
            setTimeout(() => {
            this.$router.replace({ path: this.$route.path })
            }, 3000)
        }
    },
    methods: {
      fetchNote() {
        const noteId = this.$route.params.id
        axios.get(`http://localhost:8000/api/notes/${noteId}`)
          .then(response => {
            this.note = response.data
          })
          .catch(error => {
            console.error('Error al cargar la nota:', error)
          })
      },
      deleteNote() {
        if (!confirm('¿Seguro que quieres eliminar esta nota?')) return
  
        axios.delete(`http://localhost:8000/api/notes/${this.note.id}`)
          .then(() => {
            this.$router.push('/')
          })
          .catch(error => {
            console.error('Error al eliminar la nota:', error)
          })
      }
    },
    watch: {
    '$route.params.id'(newId, oldId) {
        if (newId !== oldId) {
        this.note = null
        this.fetchNote()
        }
    }
    }
  }
  </script>
  