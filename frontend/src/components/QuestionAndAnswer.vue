<template>
  <div class="flex flex-col items-center justify-center p-4 w-screen">
    <!-- Loader while fetching data -->
    <div v-if="isLoading" class="w-10 h-10 animate-spin mb-4"></div>
    <p v-if="isLoading" class="text-lg font-medium text-gray-500">Loading Data, Please Wait...</p>

    <!-- Table to display the questions and answers -->
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
                <button class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition duration-300" title="Delete">
                <button @click="editItem(item)" class="text-blue-600 hover:text-blue-800 p-2 rounded-full bg-blue-100">
                  <i class="mdi mdi-pencil"></i>
                </button>
                <button @click="deleteItem(item.id)" class="text-red-600 hover:text-red-800 p-2 rounded-full bg-red-100">
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
import { ref, onMounted } from 'vue';
import axios from 'axios';
import ExportCSV from '@/components/ExportCSV.vue';
import '@mdi/font/css/materialdesignicons.css';

const isLoading = ref(true);
const questions = ref([]);

const fetchData = async () => {
  try {
    const response = await axios.get('/api/unanswered-questions');
    questions.value = response.data;
  } catch (error) {
    console.error('Error fetching data:', error);
  } finally {
    isLoading.value = false;
  }
};

onMounted(() => {
  fetchData();
});

const editItem = async (item) => {
  try {
    const response = await axios.put(`/api/unanswered-questions/${item.id}`, item);
    console.log(response.data);
    fetchData(); // Refresh the questions list after editing
  } catch (error) {
    console.error('Error editing item:', error);
  }
};

const deleteItem = async (id) => {
  try {
    await axios.delete(`/api/unanswered-questions/${id}`);
    fetchData();
  } catch (error) {
    console.error('Error deleting item:', error);
  }
};
</script>

<style scoped>
</style>
