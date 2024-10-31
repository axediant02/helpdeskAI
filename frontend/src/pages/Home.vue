<template>
  <div class="app-container bg-gray-100 flex flex-col h-screen">
    <Navbar />
      <!-- <div class="history-container flex-3 overflow-y-auto p-16 border-r border-gray-300">
        <History :messages="messages" :isLoading="isLoading" />
      </div> -->
        <UserInput @sendMessage="sendMessage" :isLoading="isLoading" />
  </div>
</template>

<script setup>
import Navbar from "@/components/Navbar.vue";
import History from "@/components/History.vue";
import UserInput from "@/components/UserInput.vue";

import { ref, onMounted, nextTick } from 'vue';

const messages = ref([]);
const isLoading = ref(false);

const sendMessage = async (messageText) => {
  isLoading.value = true;

  await new Promise(resolve => setTimeout(resolve, 1000));
  messages.value.push(messageText);
  isLoading.value = false;
};
</script>

<style scoped>
.app-container {
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  border-radius: 4px;
}

.content-container {
  display: flex;
  flex-grow: 1;
  overflow: hidden;
  padding: 20px;
}

.history-container {
  overflow-y: auto;
}

.user-input-container {
  max-width: 400px;
  display: flex;
  flex-direction: column;
}
</style>
