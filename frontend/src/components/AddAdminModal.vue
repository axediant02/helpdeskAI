<!-- src/components/AdminModal.vue -->
<template>
    <div v-if="addAdminStore.isAdminModalVisible" class="modal">
      <div class="modal-background" @click="closeModal"></div>
      <div class="modal-content">
        <h2 class="text-2xl font-bold mb-4">Add New Admin</h2>
        <form @submit.prevent="addAdmin" class="space-y-4">
          <div class="flex flex-col">
            <label for="username" class="text-sm font-medium text-gray-700">Username:</label>
            <input id="username" type="text" v-model="addAdminStore.adminAccountData.username" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
          </div>
          <div class="flex flex-col">
            <label for="email" class="text-sm font-medium text-gray-700">Email:</label>
            <input id="email" type="email" v-model="addAdminStore.adminAccountData.email" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
          </div>
          <div class="flex justify-end space-x-4">
            <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-blue-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Create Admin</button>
            <button type="button" @click="closeModal" class="inline-flex justify-center rounded-md border border-transparent bg-red-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </template>
  
  <script setup>
  import { useAddAdminStore } from '@/store/addAdminStore';
  
  const addAdminStore = useAddAdminStore();
  
  const closeModal = () => {
    addAdminStore.closeAddAdminModal();
  };
  
  const addAdmin = async () => {
    await axios.post('/api/')
  
  };
  </script>
  
  <style scoped>

  .modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
  }
  .modal-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
  }
  .modal-content {
    position: relative;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  </style>