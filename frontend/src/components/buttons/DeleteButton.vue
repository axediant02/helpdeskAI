<template>
    <button @click="handleDelete" class="text-red-600 hover:text-red-800 p-2 rounded-full bg-red-100 shadow-md transition duration-300 ease-in-out transform hover:scale-110 tooltip" title="Delete">
      <i class="mdi mdi-delete text-lg"></i>
    </button>
  </template>
  
  <script setup>
  const props = defineProps({
    itemId: {
      type: Number,
      required: true
    },
    onDelete: {
      type: Function,
      required: true
    }
  });
  
  const handleDelete = () => {
    props.onDelete(props.itemId);
  };
  </script>