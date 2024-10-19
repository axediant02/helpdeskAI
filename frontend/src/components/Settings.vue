<template>
  <div class="flex flex-col items-center justify-center p-4">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Settings</h1>
    <form @submit.prevent="saveSettings">
      <div class="mb-4">
        <label for="theme" class="block text-gray-700 text-sm font-bold mb-2">Theme</label>
        <select v-model="theme" id="theme" name="theme" class="border-2 border-gray-300 p-2 w-full rounded">
          <option value="light">Light</option>
          <option value="dark">Dark</option>
        </select>
      </div>
      <div class="mb-4">
        <label for="language" class="block text-gray-700 text-sm font-bold mb-2">Language</label>
        <select v-model="language" id="language" name="language" class="border-2 border-gray-300 p-2 w-full rounded">
          <option value="en">English</option>
          <option value="es">Spanish</option>
          <option value="fr">French</option>
        </select>
      </div>
      <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Save Settings</button>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const theme = ref('light');
const language = ref('en');

const saveSettings = () => {
  console.log('Saving settings:', { theme: theme.value, language: language.value });
  // Assuming there's a function to handle the saving of settings
  // This is a placeholder for the actual implementation
};
</script>

<style scoped>
</style>
