<template>
    <TenantLayout>
        <div class="p-6">

            <h1 class="text-2xl font-bold mb-6">Dashboard da Academia</h1>

            <!-- Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

            <div class="p-4 bg-white border shadow rounded">
                <h2 class="text-gray-500 text-sm">Total de Alunos</h2>
                <p class="text-3xl font-bold">{{ totalMembers }}</p>
            </div>

            <div class="p-4 bg-white border shadow rounded">
                <h2 class="text-gray-500 text-sm">Últimos 30 dias</h2>
                <p class="text-3xl font-bold">{{ recentMembers }}</p>
            </div>

            <div class="p-4 bg-white border shadow rounded">
                <h2 class="text-gray-500 text-sm">Últimos 6 Meses (R$)</h2>
                <p class="text-3xl font-bold">{{ valueTotal }}</p>
            </div>

            </div>

            <!-- Gráfico -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="p-4 bg-white border shadow rounded">
                    <h2 class="text-gray-700 mb-4 font-semibold">Crescimento Mensal (6 Meses)</h2>
                
                    <canvas id="membersChart"></canvas>
                </div>
                <div class="p-4 bg-white border shadow rounded">
                    <h2 class="text-gray-700 mb-4 font-semibold">Crescimento em Reais Mensal (6 Meses)</h2>
                
                    <canvas id="planValueChart"></canvas>
                </div>
            </div>

        </div>
    </TenantLayout>
</template>

<script setup>
// para executar o código do gráfico
import { onMounted } from 'vue'
import TenantLayout from '@/Layouts/TenantLayout.vue';

// Dados do controller
const props = defineProps({
  totalMembers: Number,
  recentMembers: Number,
  chartData: Array,
  chartDataReais: Array,
  valueTotal: Number
})

// Função do gráfico
onMounted(() => {
  
  const chartMonth = document.getElementById('membersChart')

  new Chart(chartMonth, {
    type: 'bar', 

    data: {    
      labels: props.chartData.map(i => i.month),     
      datasets: [{
        label: 'Alunos',
        data: props.chartData.map(i => i.total), 
        borderWidth: 2,
        borderColor: 'rgba(75, 192, 192, 1)',
        fill: false,
      }]
    },
    options: {
      responsive: true, 
      maintainAspectRatio: false, 
    }
  })
 
  const chartReal = document.getElementById('planValueChart')

  new Chart(chartReal, {
    type: 'bar', 

    data: {    
      labels: props.chartDataReais.map(i => i.month),     
      datasets: [{
        label: 'Matrículas (R$)',
        data: props.chartDataReais.map(i => i.total), 
        borderWidth: 2,
        borderColor: 'rgba(75, 192, 192, 1)',
        fill: false,
      }]
    },
    options: {
      responsive: true, 
      maintainAspectRatio: false, 
    }
  })
})
</script>

<style>
#membersChart {
  min-height: 300px;
  max-height: 450px;
  max-width: 100%;
}
#planValueChart {
  min-height: 300px;
  max-height: 450px;
  max-width: 100%;
}
</style>