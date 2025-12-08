<template>
    <CentralLayout>
        <div class="p-6">

            <h1 class="text-2xl font-bold mb-4">Criar nova Academia</h1>

            <form @submit.prevent="submit" class="space-y-3 max-w-md">

            <div>
                <label>ID da academia</label>
                <input v-model="form.id" class="border p-2 w-full" placeholder="ex: academia2" />
            </div>

            <div>
                <label>Domínio</label>
                <input v-model="form.domain" class="border p-2 w-full" placeholder="ex: academia2.localhost" />
            </div>

            <button class="bg-green-600 text-white px-3 py-2 rounded" :disabled="form.processing">
                Criar
            </button>

            </form>

        </div>
    </CentralLayout>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import CentralLayout from "@/Layouts/CentralLayout.vue";

const form = useForm({
  id: "",
  domain: "",
});

function submit() {
  form.post("/central/tenants");
}
</script>
