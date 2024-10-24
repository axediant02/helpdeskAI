<template>
    <div class="pagination-controls">
      <button @click="goToPage(currentPage - 1)" :disabled="currentPage === 1" class="pagination-button">
        <i class="mdi mdi-chevron-left"></i>
      </button>
      <span class="pagination-text">Page {{ currentPage }} of {{ totalPages }}</span>
      <button @click="goToPage(currentPage + 1)" :disabled="currentPage === totalPages" class="pagination-button">
        <i class="mdi mdi-chevron-right"></i>
      </button>
    </div>
  </template>
  
  <script setup>
  import { computed, toRefs } from 'vue';
  

  const props = defineProps({
    totalPages: {
      type: Number,
      required: true
    },
    currentPage: {
      type: Number,
      required: true
    }
  });
  
  const emit = defineEmits(['updatePage']);
  
  const goToPage = (page) => {
    if (page >= 1 && page <= props.totalPages) {
      emit('updatePage', page); 
    }
  };
  </script>
  
  <style scoped>
  .pagination-controls {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
    gap: 10px;
  }
  
  .pagination-button {
    padding: 10px 15px;
    border: none;
    border-radius: 20px;
    background-color: #f0f0f0;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  
  .pagination-button:hover {
    background-color: #e0e0e0;
  }
  
  .pagination-button:disabled {
    background-color: #e0e0e0;
    cursor: not-allowed;
  }
  
  .pagination-text {
    font-size: 16px;
    font-weight: 500;
    color: #333;
  }
  </style>