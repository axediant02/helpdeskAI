<template>
    <div class="relative">
      <button @click="toggleDropdown" class="flex items-center p-2 text-white rounded-full focus:outline-none hover:bg-blue-700 transition duration-300">
        <i class="mdi mdi-bell"></i>
  
        <span v-if="unreadCount > 0" class="absolute top-0 right-0 bg-red-500 text-white text-xs font-semibold rounded-full h-5 w-5 flex items-center justify-center">
          {{ unreadCount }}
        </span>
      </button>

      <NotificationContainer v-if="dropdownOpen" :notifications="notifications" />
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
import NotificationContainer from './NotificationContainer.vue';
import '@mdi/font/css/materialdesignicons.css';
  
  const dropdownOpen = ref(false);
  const unreadCount = ref(3);
  const notifications = ref([
    { id: 1, message: 'New comment on your post' },
    { id: 2, message: 'New follower' },
    { id: 3, message: 'Your password was changed' },
  ]);
  
  const toggleDropdown = () => {
    dropdownOpen.value = !dropdownOpen.value;
  };
  </script>
  
  <style scoped>
  button {
    position: relative;
    transition: background-color 0.3s ease-in-out;
  }
  .notification-count {
    position: absolute;
    top: 0;
    right: 0;
    background-color: #f44336;
    color: white;
    font-size: 12px;
    font-weight: bold;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
  }
  </style>