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
          <tr v-for="(item, index) in questions" :key="index" class="hover:bg-gray-50" :class="{'bg-gray-100': index % 2 === 0}">
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
const currentItemId = ref(null);
const editQuestion = ref('');
const editAnswer = ref('');
const editing = ref(false);

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

const updateItem = async () => {
  if (editQuestion.value && editAnswer.value) { // Check if fields are not empty
    try {
      await axios.put(`/api/unanswered-questions/${currentItemId.value}`, {
        question: editQuestion.value,
        answer: editAnswer.value,
      });
      editing.value = false;
      await fetchData(); // Refresh the data after update
    } catch (error) {
      console.error('Error updating item:', error);
    }
  } else {
    console.error('Question and answer cannot be empty'); // Handle empty fields
  }
};

// Function to cancel editing
const cancelEdit = () => {
  editing.value = false;
};

// Function to delete an item
const deleteItem = async (id) => {
  try {
    await axios.delete(`/api/unanswered-questions/${id}`);
    await fetchData(); // Refresh the data after deletion
  } catch (error) {
    console.error('Error deleting item:', error);
  }
};

// Function to edit an item
const editItem = (item) => {
  currentItemId.value = item.id;
  editQuestion.value = item.question;
  editAnswer.value = item.answer;
  editing.value = true; // Set editing to true to enable edit mode
};
</script>

<style scoped>

</style>
