<template>
    <button
      @click="exportData"
      class="hover:bg-blue-500 hover:text-white text-blue-500 border border-blue-500 py-2 px-4 rounded flex items-center"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="h-5 w-5 mr-2"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"
        />
      </svg>
      Export CSV
    </button>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import axios from 'axios';
  
  const exportData = async () => {
    try {
      const response = await axios.get('/api/unanswered-questions');
      const csvContent = ["Question,Answer"];
  
      response.data.forEach((item) => {
        csvContent.push(`"${item.question}","${item.answer}"`);
      });
  
      const csvString = csvContent.join("\n");
      const encodedUri = encodeURI(`data:text/csv;charset=utf-8,${csvString}`);
      const link = document.createElement("a");
      link.setAttribute("href", encodedUri);
      link.setAttribute("download", "unanswered_questions.csv");
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
    } catch (error) {
      console.error('Error exporting data:', error);
    }
  };
  </script>
  
  <style scoped>

  </style>