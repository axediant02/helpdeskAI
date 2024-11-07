<!-- src/components/AdminModal.vue -->
<template>
    <div v-if="addAdminStore.isAdminModalVisible" class="modal">
      <div class="modal-background" @click="closeModal"></div>
      <div class="modal-content flex flex-col items-center justify-center w-1/2 max-w-md">
        <h2 class="text-2xl font-bold mb-4">Add New Admin</h2>
        <form @submit.prevent="addAdmin" class="space-y-4 w-full">
          <div class="flex flex-col">
            <label for="name" class="text-sm font-medium text-gray-700">Name:</label>
            <input id="name" type="text" v-model="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
          </div>
          <div class="flex flex-col">
            <label for="email" class="text-sm font-medium text-gray-700">Email:</label>
            <input id="email" type="email" v-model="email" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
          </div>
          <div class="flex flex-col">
            <label for="password" class="text-sm font-medium text-gray-700">Password:</label>
            <input id="password" type="password" v-model="password" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" />
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
  import { ref } from 'vue';
  import { useAddAdminStore } from '@/store/addAdminStore';
  import axios from 'axios';
  import { useToast } from 'vue-toast-notification';
  
  const addAdminStore = useAddAdminStore();
  const name = ref('');
  const email = ref('');
  const password = ref('');
  const role = ref('admin');
  const toast = useToast();
  
  const closeModal = () => {
    addAdminStore.closeAddAdminModal();
  };

  const clearForm = () => {
    name.value = '';
    email.value = '';
    password.value = '';
  };
  
  const addAdmin = async () => {
    try{
      await axios.post('/api/admin/create', {
        name: name.value,
        email: email.value,
        password: password.value,
        role: role.value,
      });
      toast.success('Admin Added Successfully');
      clearForm();
      closeModal();
      setTimeout(() => {
        toast.clear();
      }, 2000);
    } catch (error) {
      console.error('Error adding admin:', error);
      toast.error('Error adding admin');
      setTimeout(() => {
        toast.clear();
      }, 2000);
    }
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