<template>
    <TenantLayout>
        <div class="p-4">
            <h1 class="text-2xl mb-4">Alunos</h1>
            <!-- DEBUG -->
            <!-- <pre>{{ members}} </pre> -->
            <!-- Exibir mensagem de sucesso -->
            <div v-if="$page.props.flash?.success" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ $page.props.flash.success }}
            </div>

            <!-- Exibir mensagem de erro -->
            <div v-if="$page.props.flash?.error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ $page.props.flash.error }}
            </div>

            <a href="/members/create" class="bg-blue-600 text-white px-3 py-2 rounded">
                Novo aluno
            </a>

            <table class="mt-4 w-full border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-2 border">Nome</th>
                        <th class="p-2 border">Email</th>
                        <th class="p-2 border">Status</th>
                        <th class="p-2 border">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="m in members.data" :key="m.id">
                        <td class="p-2 border">{{ m.name }}</td>
                        <td class="p-2 border">{{ m.email }}</td>
                        <td class="p-2 border">
                            {{ m.status === 'active' ? 'Ativo' : 'Inativo' }}
                        </td>
                        <td class="p-2 border space-x-2">
                            <a :href="`/members/${m.id}/edit`" class="text-blue-600">Editar</a>
                        </td>
                    </tr>
                </tbody>
            </table>
           <div v-if="members.last_page > 1" class="mt-4 flex justify-center gap-2">
                <template v-for="link in members.links" :key="link.label">
                    <!-- Se tiver URL, usa Link -->
                    <Link
                        v-if="link.url"
                        :href="link.url"
                        :class="[
                            'px-3 py-1 border rounded',
                            link.active ? 'bg-blue-600 text-white' : 'bg-white hover:bg-gray-100'
                        ]"
                        v-html="link.label"
                    />
                    <!-- Se NÃO tiver URL, usa span desabilitado -->
                    <span
                        v-else
                        class="px-3 py-1 border rounded opacity-50 cursor-not-allowed bg-gray-100"
                        v-html="link.label"
                    />
                </template>
            </div>
        </div>
    </TenantLayout>
</template>

<script setup>
import { ref, watch } from 'vue'
// import { usePage } from '@inertiajs/vue3'
import TenantLayout from '@/Layouts/TenantLayout.vue'

import { Link } from '@inertiajs/vue3'

defineProps({
  members: Object
})

// const page = usePage()
// const showSuccess = ref(false)
// const showError = ref(false)

// // Observar mudanças nas flash messages
// watch(() => page.props.flash, (flash) => {
//   if (flash?.success) {
//     showSuccess.value = true
//     setTimeout(() => showSuccess.value = false, 5000) // Auto-hide após 5s
//   }
//   if (flash?.error) {
//     showError.value = true
//     setTimeout(() => showError.value = false, 5000)
//   }
// }, { immediate: true, deep: true })
</script>

<style scoped>

</style>