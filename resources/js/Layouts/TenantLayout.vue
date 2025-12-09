<!-- Criei um component menu para conseguir adicionar em todas as páginas -->
<template>
  <div>
    <!-- Menu -->
    <nav class="bg-gray-800 text-white p-4">
      <div class="flex space-x-4">
        <a href="/" class="hover:bg-gray-700 px-3 py-2 rounded">Home</a>
        <a href="/members" class="hover:bg-gray-700 px-3 py-2 rounded">Alunos</a>
        <a href="/tenants/dashboardGraficos" class="hover:bg-gray-700 px-3 py-2 rounded">Dashboard</a>
      </div>
    </nav>

    <!-- Conteúdo da página -->
    <main>
      <slot />
    </main>
  </div>
</template>

<script setup>
// Nada necessário aqui
</script>