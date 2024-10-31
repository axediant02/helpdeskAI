<template>
  <div class="absolute right-0 mt-2 w-64 bg-gray-100 rounded-lg p-4">
    <h1>Coming Soon...</h1>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
  notifications: Array,
});
</script>

<style scoped>
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
