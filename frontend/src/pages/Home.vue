<template>
  <div class="app-container">
    <Navbar />
      <UserInput />
  </div>
</template>

<script setup>
import Navbar from "@/components/Navbar.vue";
import UserInput from '@/components/UserInput.vue';
</script>

<style scoped>
.app-container {
  overflow: hidden;
  height: 100vh;
  display: flex;
  flex-direction: column;
}
</style>
