<template>
  <div class="sidebar bg-white shadow-lg ml-2">
    <h2 class="text-lg font-bold">Chat History</h2>
    <div v-for="(msg, index) in messages" :key="index" class="history-message">
      <span>{{ msg.type === 'user' ? 'You' : 'AI Assistant' }}: {{ msg.text }}</span>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
  messages: {
    type: Array,
    required: true
  }
});
</script>

<style scoped>
.history-message {
  margin: 5px 0;
}
</style>