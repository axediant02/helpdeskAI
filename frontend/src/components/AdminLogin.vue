<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white rounded-lg shadow-xl p-6">
      <div class="flex items-center justify-between mb-6">
        <div class="flex items-center">
          <router-link to="/" class="w-6 h-6 bg-gray-500 text-white p-1 rounded mr-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
          </router-link>
          <span class="text-sm font-medium text-gray-700"><a href="/">Back</a></span>
        </div>
        <h2 class="text-2xl font-bold text-center mx-auto pr-14">Admin Login</h2>
      </div>
      <form @submit.prevent="login">
        <div class="mb-4">
          <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Username</label>
          <input v-model="username" type="text" id="username" name="username" class="border-2 border-gray-300 p-2 w-full rounded" required>
        </div>
        <div class="mb-6">
          <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
          <input v-model="password" type="password" id="password" name="password" class="border-2 border-gray-300 p-2 w-full rounded" required>
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Login</button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const username = ref('');
const password = ref('');

const login = () => {
  if (username.value === 'admin' && password.value === 'admin') {
    router.push('/admin');
  } else {
    alert('Invalid credentials');
  }
};
</script>
