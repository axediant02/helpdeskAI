<template>
  <button @click="toggleHistory" class="p-2 rounded border w-10 h-10 flex items-center justify-center border-inputBorder" style="margin-left: 20px;">
    <template v-if="showHistory">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </template>
    <template v-else>
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </template>
  </button>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
  showHistory: {
    type: Boolean,
    required: true
  },
  toggleHistory: {
    type: Function,
    required: true
  }
});
</script>

<style scoped>
/* Add any specific styles for the button here */
</style>
