<template>
    <button
      @click="cancel"
      class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline"
    >
      Cancel
    </button>
  </template>
  
  <script setup>
  const emit = defineEmits(['cancel'])
  
  function cancel() {
    emit('cancel') 
  }
  </script>
  
  <style scoped>
    button {
      transition: background-color 0.3s ease-in-out;
    }
  </style>