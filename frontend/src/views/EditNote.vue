<template>
    <div class="max-w-3xl mx-auto py-10 px-4">
      <h1 class="text-2xl font-bold mb-6">Editar Nota</h1>
  
      <form @submit.prevent="updateNote" class="space-y-4">
        <div>
          <label class="block text-sm font-medium">Título</label>
          <input v-model="title" class="w-full border p-2 rounded" />
          <p v-if="errors.title" class="text-red-500 text-sm">{{ errors.title }}</p>
        </div>
  
        <div>
          <label class="block text-sm font-medium">Contenido</label>
          <textarea v-model="content" rows="6" class="w-full border p-2 rounded"></textarea>
          <p v-if="errors.content" class="text-red-500 text-sm">{{ errors.content }}</p>
        </div>
  
        <div class="space-x-4">
          <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-500">
            Guardar cambios
          </button>
          <router-link
            :to="`/notes/${noteId}`"
            class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-200"
          >
            Cancelar
          </router-link>
        </div>
      </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios'
  
  export default {
    name: 'EditNote',
    data() {
      return {
        title: '',
        content: '',
        errors: {},
        noteId: this.$route.params.id
      }
    },
    mounted() {
      this.fetchNote()
    },
    methods: {
      fetchNote() {
        axios.get(`http://localhost:8000/api/notes/${this.noteId}`)
          .then(response => {
            this.title = response.data.title
            this.content = response.data.content
          })
          .catch(error => {
            console.error('Error al cargar la nota:', error)
          })
      },
      async updateNote() {
        this.errors = {}

        if (!this.title) this.errors.title = 'El título es obligatorio.'
        if (!this.content) this.errors.content = 'El contenido es obligatorio.'

        if (Object.keys(this.errors).length > 0) return

        try {
            await axios.put(`http://localhost:8000/api/notes/${this.noteId}`, {
            title: this.title,
            content: this.content
            })

            this.$router.push({
            path: `/notes/${this.noteId}`,
            query: { success: '1' }
            })
        } catch (error) {
            console.error('Error al actualizar la nota:', error)
        }
        }
    }
  }
  </script>
  