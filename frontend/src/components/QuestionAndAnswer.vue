<template>
  <div class="flex flex-col items-center justify-center p-4 w-full h-full">
    <div v-if="isLoading" class="w-10 h-10 animate-spin mb-4"></div>
    <p v-if="isLoading" class="text-lg font-medium text-gray-500">Loading Data, Please Wait...</p>
    <div v-else class="min-w-full divide-y divide-gray-200 shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full h-full divide-y divide-gray-200 shadow-md rounded-lg overflow-hidden mt-4">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">ID</th>
              <th class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">Question</th>
              <th class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">Answer</th>
              <!-- Add responsive classes here -->
              <th class="px-4 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase w-28 sm:w-20">Actions</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="(item, index) in questions" :key="item.id" class="hover:bg-gray-50" :class="{'bg-gray-100': index % 2 === 0}">
              <td class="px-4 py-4 text-sm font-medium text-gray-900">{{ item.id }}</td>
              <td class="px-4 py-4 text-sm font-medium text-gray-900">
                <template v-if="isEditing(item.id)">
                  <textarea v-model="editQuestion" class="border rounded w-full p-2" rows="3"></textarea>
                </template>
                <template v-else>{{ item.question }}</template>
              </td>
              <td class="px-4 py-4 text-sm font-medium text-gray-900">
                <template v-if="isEditing(item.id)">
                  <textarea v-model="editAnswer" class="border rounded w-full p-2" rows="3"></textarea>
                </template>
                <template v-else>{{ item.answer }}</template>
              </td>
              <!-- Responsive Actions Column -->
              <td class="px-2 py-4 text-sm w-auto sm:w-16">
                <div class="flex flex-col sm:flex-row sm:space-x-2 space-y-2 sm:space-y-0">
                  <template v-if="isEditing(item.id)">
                    <button @click="saveEdit" class="text-green-600 hover:text-green-800 p-2 rounded-full bg-green-100 tooltip" title="Save Changes">
                      <i class="mdi mdi-check"></i>
                    </button>
                    <button @click="cancelEdit" class="text-gray-600 hover:text-gray-800 p-2 rounded-full bg-gray-100 tooltip" title="Cancel Edit">
                      <i class="mdi mdi-close"></i>
                    </button>
                  </template>
                  <template v-else>
                    <EditButton :item="item" @click.native="startEdit(item)" :onEdit="saveEdit" />
                    <DeleteButton :itemId="item.id" :onDelete="deleteItem" />
                  </template>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      <Pagination :currentPage="currentPage" :totalPages="totalPages" @updatePage="currentPage = $event" />
    </div>
  </div>
</template>


<script setup>
import { ref, onMounted, computed, watch } from 'vue';
import axios from 'axios';
import Pagination from '@/components/Pagination.vue';
import EditButton from '@/components/buttons/EditButton.vue';
import DeleteButton from '@/components/buttons/DeleteButton.vue';
import '@mdi/font/css/materialdesignicons.css';
import { useAddAdminStore } from '@/store/addAdminStore';
import { useToast } from 'vue-toast-notification';

const addAdminStore = useAddAdminStore();

const openAddAdminModal = () => {
  addAdminStore.openAddAdminModal();
};

const isLoading = ref(true);
const questions = ref([]);
const currentItemId = ref(null);
const editQuestion = ref('');
const editAnswer = ref('');
const editing = ref(false);
const toast = useToast();

const currentPage = ref(1);
const itemsPerPage = ref(5);
const totalItems = ref(0);

const fetchData = async () => {
  isLoading.value = true;
  try {
    const response = await axios.get('/api/unanswered-questions', {
      params: { page: currentPage.value, limit: itemsPerPage.value },
    });
    questions.value = response.data.data;
    totalItems.value = response.data.total;
  } catch (error) {
    console.error('Error fetching data:', error);
  } finally {
    isLoading.value = false;
  }
};

const totalPages = computed(() => Math.ceil(totalItems.value / itemsPerPage.value));

watch(currentPage, fetchData);

const isEditing = (id) => editing.value && currentItemId.value === id;

const startEdit = (item) => {
  currentItemId.value = item.id;
  editQuestion.value = item.question;
  editAnswer.value = item.answer;
  editing.value = true;
};

const saveEdit = async () => {
  if (!editQuestion.value || !editAnswer.value) {
    return;
  }
  try {
    await axios.put(`/api/unanswered-questions/${currentItemId.value}`, {
      question: editQuestion.value,
      answer: editAnswer.value,
    });
    resetEdit();
    await fetchData();
  } catch (error) {
    toast.error('Error updating item:', error);
  }
  toast.success('Item updated successfully');
};

const cancelEdit = resetEdit;

function resetEdit() {
  editing.value = false;
  editQuestion.value = '';
  editAnswer.value = '';
}

const deleteItem = async (id) => {
  try {
    await axios.delete(`/api/unanswered-questions/${id}`);
    await fetchData();
  } catch (error) {
    console.error('Error deleting item:', error);
  }
};

onMounted(fetchData);
</script>

<style scoped>
.tooltip {
  position: relative;
}

.tooltip::after {
  content: attr(title);
  position: absolute;
  bottom: 100%;
  left: 50%;
  transform: translateX(-50%);
  background-color: black;
  color: white;
  text-align: center;
  padding: 5px 10px;
  border-radius: 20px;
  margin-bottom: 10px;
  opacity: 0;
  transition: opacity 0.3s;
}

.tooltip:hover::after {
  opacity: 1;
}
</style>
