<!-- src/components/Button.vue -->
<template>
  <button :class="`bg-${backgroundColor}-500 text-white p-2 rounded`" @click="handleClick">
    {{ label }}
    <slot />
  </button>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
  label: { type: String, required: true },
  backgroundColor: { type: String, default: 'blue' },
});

const emit = defineEmits(['click']);

const handleClick = () => {
  emit('click');  // Trigger a custom click event that can be used to open the modal
};
</script>
