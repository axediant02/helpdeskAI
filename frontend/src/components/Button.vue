<template>
  <button :class="`bg-${backgroundColor}-500 text-white p-2 rounded`" @click="$emit('click')">
    {{ label }}
  </button>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
  label: {
    type: String,
    required: true
  },
  backgroundColor: {
    type: String,
    default: 'blue'
  }
});
</script>
