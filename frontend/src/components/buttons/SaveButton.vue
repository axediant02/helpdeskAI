<template>
    <button
      @click="save"
      class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline"
    >
      Save Changes
    </button>
  </template>
  
  <script setup>
  const emit = defineEmits(['save'])
  
  function save() {
    emit('save')
  }
  </script>
  
  <style scoped>
    button {
      transition: background-color 0.3s ease-in-out;
    }
  </style>