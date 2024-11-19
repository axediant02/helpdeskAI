<template>
  <div class="relative h-screen flex">
    <transition name="slide">
      <div
        v-if="showHistory"
        class="fixed top-0 left-0 h-full w-64 bg-white shadow-lg p-4 z-40"
      >
        <h2 class="text-lg font-semibold mb-4">History</h2>
      </div>
    </transition>

    <div :class="showHistory ? 'ml-64' : 'ml-0'" class="flex-grow flex items-center justify-center p-0 transition-all duration-300">
      <p>Coming Soon....</p>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const showHistory = ref(false);

const toggleHistory = () => {
  showHistory.value = !showHistory.value;
};
</script>

<style scoped>
.slide-enter-active,
.slide-leave-active {
  transition: transform 0.3s ease;
}
.slide-enter {
  transform: translateX(-100%);
}
.slide-leave-to {
  transform: translateX(-100%);
}
</style>
