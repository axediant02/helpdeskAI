<template>
    <div class="flex flex-col items-center justify-center p-4 bg-gray-100 rounded-lg shadow mx-auto">
    <div class="flex flex-row items-center justify-between w-full mb-4">
        <h1 class="text-4xl font-bold text-gray-800">Admin Panel</h1>
        <ExportCSV />
    </div>
    <div class="flex flex-col items-center justify-center">
        <QuestionAndAnswer />
    </div>
    
</div>
</template>

<script setup>
import QuestionAndAnswer from '@/components/QuestionAndAnswer.vue';
import ExportCSV from '@/components/ExportCSV.vue';
</script>

<style scoped>
</style>
