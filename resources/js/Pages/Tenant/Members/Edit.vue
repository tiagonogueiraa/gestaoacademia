<template>
  <TenantLayout>
    <div class="p-4">
      <h1 class="text-2xl mb-4">Editar aluno</h1>

      <div class="bg-white shadow-md rounded-lg p-6 max-w-4xl">
        <form @submit.prevent="submit" class="space-y-2 max-w-full">
          
          <div>
            <label class="block mb-1">Nome</label>
            <input v-model="form.name" placeholder="Nome" class="border p-2 w-full" />
          </div>

          <div>
            <label class="block mb-1">Email</label>
            <input v-model="form.email" placeholder="Email" class="border p-2 w-full" />
          </div>

          <div>
            <label class="block mb-1">Telefone</label>
            <input v-model="form.phone" placeholder="Telefone" class="border p-2 w-full" />
          </div>

          <div class="grid grid-cols-1 md:grid-cols-6 gap-6">
            <div class="md:col-span-4">
              <label class="block mb-1">Rua</label>
              <input v-model="form.street" class="border p-2 w-full" placeholder="Rua" />
            </div>

            <div class="md:col-span-2">
              <label class="block mb-1">Número</label>
              <input v-model="form.number" class="border p-2 w-full" placeholder="Número" />
            </div>

            <div class="md:col-span-2">
              <label class="block mb-1">Bairro</label>
              <input v-model="form.district" class="border p-2 w-full" placeholder="Bairro" />
            </div>

            <div class="md:col-span-4">
              <label class="block mb-1">Cidade</label>
              <input v-model="form.city" class="border p-2 w-full" placeholder="Cidade" />
            </div>

            <div class="md:col-span-2">
              <label class="block mb-1">UF</label>
              <input v-model="form.state" class="border p-2 w-full" placeholder="UF" />
            </div>

            <div class="md:col-span-3">
              <label class="block mb-1">CEP</label>
              <input v-model="form.zip_code" class="border p-2 w-full" placeholder="CEP" />
            </div>
          </div>

          <div>
            <label class="block mb-1">Valor do plano</label>
            <input v-model="form.plan_value" class="border p-2 w-full" placeholder="Valor do plano" />
          </div>

          <div>
            <label class="block mb-1">Status</label>
            <select v-model="form.status" class="border p-2 w-full">
              <option value="active">Ativo</option>
              <option value="inactive">Inativo</option>
            </select>
          </div>

          <div class="flex justify-between items-center mt-4">         
            <button type="button" @click="$inertia.visit('/members')" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
              Voltar
            </button>

            <div class="flex gap-2">
              <button type="button" @click="deleteUser" :disabled="form.processing" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                {{ form.processing ? 'Deletando...' : 'Deletar' }}
              </button>
              <button type="submit" :disabled="form.processing" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                {{ form.processing ? 'Salvando...' : 'Atualizar' }}
              </button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </TenantLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import TenantLayout from '@/Layouts/TenantLayout.vue'  // ← Adicionar


const props = defineProps({
  member: Object
})

const form = useForm({
  name: props.member.name,
  email: props.member.email,
  phone: props.member.phone,
  status: props.member.status,
  street: props.member.street,
  number: props.member.number,
  district: props.member.district,
  city: props.member.city,
  state: props.member.state,
  zip_code: props.member.zip_code,
  plan_value: props.member.plan_value,
})

function submit() {
  form.put(`/members/${props.member.id}`)
}

function deleteUser() {
  if (confirm(`Tem certeza que deseja deletar o aluno ${props.member.name}?`)) {
    form.delete(`/members/${props.member.id}`)
  }
}
</script>
