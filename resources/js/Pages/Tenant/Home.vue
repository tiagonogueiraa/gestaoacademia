<template>
  <TenantLayout>
    <div class="p-6">

      <h1 class="text-3xl font-bold mb-4">
        Bem-vindo, {{ user?.name }}
      </h1>

      <p class="text-gray-600 mb-6">
        Você está acessando a academia <strong>{{ tenant }}</strong>.
      </p>

      <div class="space-y-3">
        <a href="/members" class="block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
          📋 Gerenciar Alunos
        </a>

        <a href="/dashboard" class="block bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded">
          📊 Ver Dashboard Breeze
        </a>
      </div>

    </div>
  </TenantLayout>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3'
import TenantLayout from '@/Layouts/TenantLayout.vue'

const page = usePage()

// props automáticos do Inertia
const user = page.props.auth.user
const tenant = page.props.tenant?.id ?? 'Tenant não definido'
</script>
