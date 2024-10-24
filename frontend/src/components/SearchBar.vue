<template>
  <div class="flex items-center border border-gray-300 rounded-md shadow-sm p-2 w-full max-w-sm">
    <input 
      v-model="searchQuery" 
      @input="emitSearch" 
      type="text" 
      placeholder="Search..." 
      class="flex-grow p-2 border-none outline-none text-sm text-gray-700"
    />
    <button @click="clearSearch" class="ml-2 text-gray-500 hover:text-gray-700 focus:outline-none">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const searchQuery = ref('');

const emitSearch = () => {
  emit('search', searchQuery.value);
};

const clearSearch = () => {
  searchQuery.value = '';
  emitSearch();
};
</script>

<style scoped>

input {
  width: 100%;
  font-size: 1rem;
}
</style>
