<template>
    <CentralLayout>
        <div class="p-6">

            <h1 class="text-3xl font-bold mb-4">Academias</h1>

            <a href="/tenants/create" class="bg-blue-600 text-white px-3 py-2 rounded">
            + Nova Academia
            </a>

            <table class="mt-6 w-full border">
                <thead class="bg-gray-100">
                    <tr>
                    <th class="p-2 border">ID</th>
                    <th class="p-2 border">Domínio</th>
                    <th class="p-2 border">Criado em</th>
                    <th class="p-2 border">Visualizar</th>
                    <th class="p-2 border">Editar</th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="t in tenants" :key="t.id">
                        <td class="p-2 border">{{ t.id }}</td>
                        <td class="p-2 border">{{ t.domain }}</td>
                        <td class="p-2 border">{{ t.created_at }}</td>
                        <td class="p-2 border">
                            <!-- Adiciono dois pontos no href pois aí posso passar variável dinaâmica -->
                            <a :href="`http://${t.domain}`" target="_blank" class="text-blue-600">Acessar</a>
                        </td>
                        <td class="p-2 border">
                            <a :href="`/tenants/${t.id}`" class="text-blue-600">Visualizar</a>
                        </td>                        
                    </tr>
                </tbody>
            </table>

        </div>
    </CentralLayout>
</template>

<script setup>
import CentralLayout from '@/Layouts/CentralLayout.vue';

// Defini a variável que recebe o array que vem do backend
// precisa ser o mesmo nome que vem do backend

defineProps({
  tenants: Array
})
</script>
