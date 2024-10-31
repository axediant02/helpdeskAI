<template>
  <button @click="toggle" :class="{ active: isActive }">
    <i :class="isActive ? 'fas fa-power-off' : 'fas fa-power-on'"></i>
    {{ isActive ? 'Turn Off' : 'Turn On' }}
  </button>
</template>

<script setup>
import { ref } from 'vue';

const isActive = ref(false);

const toggle = () => {
  isActive.value = !isActive.value;
};
</script>

<style scoped>
button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}

.active {
  background-color: #f44336; /* Red */
}
</style>
