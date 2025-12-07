<template>
  <div class="max-w-md mx-auto mt-20">
    <h1 class="text-2xl mb-4">Login Central</h1>

    <form @submit.prevent="submit">
      <input v-model="form.email" placeholder="Email" class="border p-2 w-full mb-2" />
      <input type="password" v-model="form.password" placeholder="Senha" class="border p-2 w-full mb-2" />

      <button class="bg-blue-600 text-white p-2 w-full">
        Entrar
      </button>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  email: '',
  password: ''
})

function submit() {
  form.post('/login')
}
</script>
