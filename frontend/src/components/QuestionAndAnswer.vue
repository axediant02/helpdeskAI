<template>
  <div class="flex flex-col items-center justify-center p-4 w-screen">
    <Loader v-if="isLoading" class="w-10 h-10 animate-spin mb-4" />
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
              <button @click="editItem(item)" class="text-blue-600 hover:text-blue-800 p-2 rounded-full bg-blue-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-1.414a1 1 0 01-1.414 0V10a1 1 0 011.414 0L13 14.586V17a1 1 0 01-1.414 1.414l-3 3a1 1 0 01-1.414-1.414l1-1a1 1 0 011.414 0z" />
                </svg>
              </button>
              <button @click="deleteItem(index)" class="text-red-600 hover:text-red-800 p-2 rounded-full bg-red-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-5 5m-5-5v-2a2 2 0 00-2 2H5a2 2 0 002 2v3a2 2 0 002 2h11a2 2 0 002-2v-3a2 2 0 00-2-2h-1" />
                </svg>
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

const editItem = (item) => {
  console.log('Edit item:', item);

};

const deleteItem = (index) => {
  mockQnA.value.splice(index, 1);
  console.log('Deleted item at index:', index);
};
</script>

<style scoped>

</style>
