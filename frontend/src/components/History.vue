<template>
    <div ref="chatContainer" class="h-[400px] overflow-y-auto mb-6 space-y-4" :class="{ 'hidden': !isSidebarVisible }">
      <template v-if="messages.length">
        <div
          v-for="(message, index) in messages"
          :key="index"
          :class="[
            'max-w-[80%] p-3 rounded-lg transition-all duration-300',
            message.type === 'user' ? 'ml-auto bg-blue-500 text-white' : 'bg-gray-100 text-gray-800',
            { 'opacity-50': isLoading && index === messages.length - 1 }
          ]"
        >
          <div class="flex items-center space-x-2 mb-1">
            <span class="text-sm font-medium">{{ message.type === 'user' ? 'You' : 'AI Assistant' }}</span>
            <span v-if="message.type === 'ai'" class="text-xs text-gray-500">
              {{ getTimestamp(message.timestamp) }}
            </span>
          </div>
          <div class="text-sm">{{ message.text }}</div>
        </div>
      </template>
      <div v-else class="text-center text-gray-500">
        <p class="text-lg font-medium">No messages yet</p>
        <p class="text-sm">Start a conversation by asking a question!</p>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, nextTick, watch, computed } from 'vue';
  
  const props = defineProps({
    messages: Array,
    isLoading: Boolean,
    isSidebarVisible: Boolean
  });
  
  const chatContainer = ref(null);
  
  const getTimestamp = (timestamp) => {
    // Timestamp format logic here
  };
  
  const scrollToBottom = () => {
    chatContainer.value.scrollTop = chatContainer.value.scrollHeight;
  };
  
  watch(() => props.messages, () => {
    nextTick(scrollToBottom);
  });
  </script>