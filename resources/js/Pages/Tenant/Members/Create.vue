<template>
    <TenantLayout>
        <div class="p-4">
            <h1 class="text-2xl mb-4">Novo aluno</h1>
            <!-- DEBUG: Ver todos os erros -->
            <pre>{{ form.errors }}</pre>
            <pre>{{ JSON.stringify(form.errors, null, 2) }}</pre>

            <div class="bg-white shadow-md rounded-lg p-6 max-w-4xl">
                <form @submit.prevent="submit" class="space-y-2 max-w-md">                    
                    <div>
                        <label class="block mb-1">Nome</label>
                        <input v-model="form.name" placeholder="Nome" class="border p-2 w-full" />
                        <span v-if="form.errors.name" class="text-red-500">
                            {{ form.errors.name }}
                        </span>
                    </div>

                    <div>
                        <label class="block mb-1">Email</label>
                        <input v-model="form.email" placeholder="Email" class="border p-2 w-full" />
                        <span v-if="form.errors.email" class="text-red-500">
                            {{ form.errors.email }}
                        </span>
                    </div>

                    <div>
                        <label class="block mb-1">Telefone</label>
                        <input v-model="form.phone" placeholder="Telefone" class="border p-2 w-full" />
                        <span v-if="form.errors.phone" class="text-red-500">
                            {{ form.errors.phone }}
                        </span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-6 gap-6">
                        <div class="md:col-span-4">
                            <label class="block mb-1">Rua</label>
                            <input v-model="form.street" class="border p-2 w-full" placeholder="Rua" />
                            <span v-if="form.errors.street" class="text-red-500">
                                {{ form.errors.street }}
                            </span>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block mb-1">Número</label>
                            <input v-model="form.number" class="border p-2 w-full" placeholder="Número" />
                            <span v-if="form.errors.number" class="text-red-500">
                                {{ form.errors.number }}
                            </span>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block mb-1">Bairro</label>
                            <input v-model="form.district" class="border p-2 w-full" placeholder="Bairro" />
                            <span v-if="form.errors.district" class="text-red-500">
                                {{ form.errors.district }}
                            </span>
                        </div>

                        <div class="md:col-span-4">
                            <label class="block mb-1">Cidade</label>
                            <input v-model="form.city" class="border p-2 w-full" placeholder="Cidade" />
                            <span v-if="form.errors.city" class="text-red-500">
                                {{ form.errors.city }}
                            </span>
                        </div>

                        <div class="md:col-span-2">
                            <label class="block mb-1">UF</label>
                            <input v-model="form.state" class="border p-2 w-full" placeholder="UF" />
                            <span v-if="form.errors.state" class="text-red-500">
                                {{ form.errors.state }}
                            </span>
                        </div>

                        <div class="md:col-span-3">
                            <label class="block mb-1">CEP</label>
                            <input v-model="form.zip_code" class="border p-2 w-full" placeholder="CEP" />
                            <span v-if="form.errors.zip_code" class="text-red-500">
                                {{ form.errors.zip_code }}
                            </span>
                        </div>
                    </div>

                    <div>
                        <label class="block mb-1">Valor do plano</label>
                        <input v-model="form.plan_value" class="border p-2 w-full" placeholder="Valor do plano" />
                        <span v-if="form.errors.plan_value" class="text-red-500">
                            {{ form.errors.plan_value }}
                        </span>
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
                        
                        <button class="bg-green-600 text-white px-3 py-2 rounded">
                            Salvar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </TenantLayout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import TenantLayout from '@/Layouts/TenantLayout.vue'  // ← Adicionar

const form = useForm({
  name: '',
  email: '',
  phone: '',
  status: 'active',
  street: '',
  number: '',
  district: '',
  city: '',
  state: '',
  zip_code: '',
  plan_value: '',
})

// FUNÇÃO SUBMIT CHAMADO AO ENVIAR O FORMULARIO
function submit() {
  form.post(route('tenant.members.store'), {
    onSuccess: () => {
        // alert('Cadastrado com sucesso!')
        console.log(' executado com sucesso');
    },
    onError: (errors) => {
      // Executado quando dá erro de validação (status 422)
      console.log('Erros de validação:', errors)
    //   alert('Erro ao cadastrar!')
    },
    onFinish: () => {
      // Executado sempre no final (sucesso ou erro)
      console.log('Requisição finalizada')
    }
    
  })
}
</script>
