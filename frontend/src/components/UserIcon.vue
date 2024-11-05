<template>
  <div class="text-xl">
    <i class="mdi mdi-account-outline text-2xl"></i>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';


const props = defineProps({
  userIconSrc: {
    type: String,
    required: true
  }
});
</script>

<style scoped>
.user-icon {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  overflow: hidden;
}

.user-icon img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
</style>

