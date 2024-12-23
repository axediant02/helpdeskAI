<template>
    <button @click="handleEdit" class="text-blue-600 hover:text-blue-800 p-2 rounded-full bg-blue-100 tooltip" title="Edit">
      <i class="mdi mdi-pencil"></i>
    </button>
  </template>
  
  <script setup>
  const props = defineProps({
    item: {
      type: Object,
      required: true
    },
    onEdit: {
      type: Function,
      required: true
    }
  });
  
  const handleEdit = () => {
    props.onEdit(props.item);
  };
  </script>
  