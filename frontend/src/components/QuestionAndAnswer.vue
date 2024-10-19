<template>
  <div class="flex flex-col items-center justify-center p-4 w-screen">
    <div v-if="isLoading" class="w-10 h-10 animate-spin mb-4"></div>
    <p v-if="isLoading" class="text-lg font-medium text-gray-500">Loading Data, Please Wait...</p>

    <div v-else class="min-w-full divide-y divide-gray-200 shadow-md rounded-lg overflow-hidden mt-4">
      <div class="flex flex-row items-center justify-end w-full mb-4">
        <ExportCSV />
      </div>
      <table class="min-w-full divide-y divide-gray-200 shadow-md rounded-lg overflow-hidden mt-4">
        <thead class="bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">Question</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">Answer</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="(item, index) in mockQnA" :key="index" class="hover:bg-gray-50" :class="{'bg-gray-100': index % 2 === 0}">
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ item.question }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ item.answer }}</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex space-x-2">
                <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-300" title="Edit">
                  <i class="mdi mdi-pencil"></i>
                </button>
                <button class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition duration-300" title="Delete">
                  <i class="mdi mdi-delete"></i>
                </button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import ExportCSV from '@/components/ExportCSV.vue';
import '@mdi/font/css/materialdesignicons.css';


const isLoading = ref(true);
const mockQnA = ref([]);

setTimeout(() => {
  mockQnA.value = [
    { question: 'Sample Question 1', answer: 'Sample Answer 1' },
    { question: 'Sample Question 2', answer: 'Sample Answer 2' },
    { question: 'Sample Question 3', answer: 'Sample Answer 3' },
  ];
  isLoading.value = false;
}, 2000);
</script>

<style scoped>
</style>
