<template>
    <div class="max-w-3xl mx-auto py-10 px-4">
      <h1 class="text-2xl font-bold mb-6">Nueva Nota</h1>
  
      <form @submit.prevent="submitNote" class="space-y-4">
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
  
        <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-500">
          Guardar nota
        </button>
      </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios'
  
  export default {
    name: 'NewNote',
    data() {
      return {
        title: '',
        content: '',
        errors: {}
      }
    },
    methods: {
      async submitNote() {
        this.errors = {}
  
        if (!this.title) this.errors.title = 'El título es obligatorio.'
        if (!this.content) this.errors.content = 'El contenido es obligatorio.'
  
        if (Object.keys(this.errors).length > 0) return
  
        try {
          const response = await axios.post('http://localhost:8000/api/notes', {
            title: this.title,
            content: this.content
          })

          const newNote = response.data
          this.$router.push({
            path: `/notes/${newNote.id}`, // o this.noteId si estás en Edit
            query: { success: '1' }
          })
        } catch (error) {
          if (error.response && error.response.status === 422) {
            this.errors = error.response.data.errors
          } else {
            console.error('Error inesperado:', error)
          }
        }
      }
    }
  }
  </script>
  