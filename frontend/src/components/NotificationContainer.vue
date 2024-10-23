<template>
  <div class="absolute right-0 mt-2 w-64 bg-white shadow-lg rounded-lg p-4">
    <ul class="space-y-2">
      <li v-for="notification in notifications" :key="notification.id" class="p-3 border-b border-gray-200 hover:bg-gray-100 rounded-lg">
        <div class="flex items-center justify-between">
          <p class="text-sm font-medium text-gray-900">{{ notification.message }}</p>
          <button class="ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Mark as read
          </button>
        </div>
      </li>
    </ul>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
  notifications: Array,
});
</script>

<style scoped>
/* Styles for the notification dropdown */
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

li {
  cursor: pointer;
  transition: background-color 0.3s ease-in-out;
}

li:hover {
  background-color: #f9fafb;
}
</style>
