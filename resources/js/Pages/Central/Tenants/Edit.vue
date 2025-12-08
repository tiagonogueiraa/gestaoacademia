<template>
    <CentralLayout>
        <div class="p-4">
            <div class="bg-white shadow-md rounded-lg p-6 max-w-4xl">
                <h1 class="text-3xl font-bold mb-6">
                Visualizar Academia
                </h1>

                <div class="space-y-3 max-w-lg">
                <div>
                    <label>ID:</label>
                    <input v-model="form.id" class="border p-2 w-full" placeholder="ex: academia2" />
                </div>
                
                <div>
                    <label>Domínio:</label>
                    <input v-model="form.domain" class="border p-2 w-full" placeholder="ex: academia2.localhost" />
                </div>

                <div>
                    <label>Criado em:</label>
                    <span>{{ tenant.created_at }}</span>
                </div>
                </div>

                <div class="flex justify-between items-center mt-4">
                    <button type="button" @click="$inertia.visit('/tenants')" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Voltar
                    </button>
                    <button @click="deleteTenant" class="bg-red-600 text-white px-4 py-2 rounded" >
                        Excluir Academia
                    </button>
                </div>

            </div>
        </div>
    </CentralLayout>
</template>

<script setup>
import { router } from '@inertiajs/vue3'
import CentralLayout from '@/Layouts/CentralLayout.vue'

import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  tenant: Object
})

console.log('Tenant:', props.tenant)

// Criar formulário com os dados do tenant
const form = useForm({
  id: props.tenant.id,
  domain: props.tenant.domain  // Pega o primeiro domínio
})


function deleteTenant() {
  if (confirm("Tem certeza que deseja excluir esta academia? Esta ação não pode ser desfeita.")) {
    router.delete(`/tenants/${props.tenant.id}`)
  }
}
</script>
