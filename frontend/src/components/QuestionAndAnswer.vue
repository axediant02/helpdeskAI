<template>
  <div class="flex flex-col items-center justify-center p-4 w-screen">
    <div v-if="isLoading" class="w-10 h-10 animate-spin mb-4"></div>
    <p v-if="isLoading" class="text-lg font-medium text-gray-500">Loading Data, Please Wait...</p>

    <div v-else class="min-w-full divide-y divide-gray-200 shadow-md rounded-lg overflow-hidden">
      <div class="flex flex-row items-center justify-end w-full mb-4">
        <ExportCSV :questions="questions" />
      </div>
      <table class="min-w-full divide-y divide-gray-200 shadow-md rounded-lg overflow-hidden mt-4">
        <thead class="bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">ID</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">Question</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">Answer</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="(item, index) in questions" :key="index" class="hover:bg-gray-50" :class="{'bg-gray-100': index % 2 === 0}">
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
              {{ item.id }}
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
              <template v-if="editing && currentItemId === item.id">
                <textarea v-model="editQuestion" class="border rounded w-full p-2" rows="3"></textarea>
              </template>
              <template v-else>
                {{ item.question }}
              </template>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
              <template v-if="editing && currentItemId === item.id">
                <textarea v-model="editAnswer" class="border rounded w-full p-2" rows="3"></textarea>
              </template>
              <template v-else>
                {{ item.answer }}
              </template>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex space-x-2">
                <button @click="() => editItem(item)" class="text-blue-600 hover:text-blue-800 p-2 rounded-full bg-blue-100">
                  <i class="mdi mdi-pencil"></i>
                </button>
                <button @click="() => deleteItem(item.id)" class="text-red-600 hover:text-red-800 p-2 rounded-full bg-red-100">
                  <i class="mdi mdi-delete"></i>
                </button>
                <template v-if="editing && currentItemId === item.id">
                  <button @click="updateItem" class="text-green-600 hover:text-green-800 p-2 rounded-full bg-green-100">
                    <i class="mdi mdi-check"></i>
                  </button>
                  <button @click="cancelEdit" class="text-gray-600 hover:text-gray-800 p-2 rounded-full bg-gray-100">
                    <i class="mdi mdi-close"></i>
                  </button>
                </template>
              </div>
            </td>
          </tr>
        </tbody>
      </table>

      <!-- Pagination Component -->
      <Pagination :currentPage="currentPage" :totalPages="totalPages" @updatePage="handlePageChange" />
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import axios from 'axios';
import ExportCSV from '@/components/ExportCSV.vue';
import Pagination from '@/components/Pagination.vue';
import '@mdi/font/css/materialdesignicons.css';

const isLoading = ref(true);
const questions = ref([]);
const currentItemId = ref(null);
const editQuestion = ref('');
const editAnswer = ref('');
const editing = ref(false);

// Pagination variables
const currentPage = ref(1);
const itemsPerPage = ref(5); // Adjust this value based on how many items you want per page.
const totalItems = ref(0);

// Fetch questions with pagination
const fetchData = async () => {
  try {
    const response = await axios.get('/api/unanswered-questions', {
      params: {
        page: currentPage.value, // Ensure this is being sent correctly
        limit: itemsPerPage.value, // Ensure this is being sent correctly
      },
    });
    // Check the structure of the response
    console.log(response.data); // Debugging line
    questions.value = response.data.data; // Ensure this exists in the response
    totalItems.value = response.data.total; // Ensure this exists in the response
  } catch (error) {
    console.error('Error fetching data:', error);
  } finally {
    isLoading.value = false; // Ensure loading state is updated
  }
};

// Computed property to calculate total pages
const totalPages = computed(() => Math.ceil(totalItems.value / itemsPerPage.value));

// Handle page change event
const handlePageChange = (newPage) => {
  currentPage.value = newPage;
  fetchData();
};

// Update item
const updateItem = async () => {
  if (editQuestion.value && editAnswer.value) {
    try {
      await axios.put(`/api/unanswered-questions/${currentItemId.value}`, {
        question: editQuestion.value,
        answer: editAnswer.value,
      });
      editing.value = false;
      await fetchData();
    } catch (error) {
      console.error('Error updating item:', error);
    }
  } else {
    console.error('Question and answer cannot be empty');
  }
};

const cancelEdit = () => {
  editing.value = false;
};

const deleteItem = async (id) => {
  try {
    await axios.delete(`/api/unanswered-questions/${id}`);
    await fetchData();
  } catch (error) {
    console.error('Error deleting item:', error);
  }
};

const editItem = (item) => {
  currentItemId.value = item.id;
  editQuestion.value = item.question;
  editAnswer.value = item.answer;
  editing.value = true;
};

onMounted(() => {
  fetchData();
});
</script>

<style scoped>

</style>
