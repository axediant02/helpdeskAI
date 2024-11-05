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
          <span class="text-sm font-medium text-gray-700">Back</span>
        </div>
        <h2 class="text-2xl font-bold text-center mx-auto pr-14">User Login</h2>
      </div>
      <form @submit.prevent="handleLogin">
        <div class="mb-4">
          <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
          <input v-model="email" type="email" id="email" name="email" class="border-2 border-gray-300 p-2 w-full rounded" required>
        </div>
        <div class="mb-6 relative">
          <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
          <input v-model="password" type="password" id="password" name="password" class="border-2 border-gray-300 p-2 w-full rounded" required>
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Login</button>
      </form>
      <div class="mt-4">
        <label for="signup" class="text-sm font-medium flex items-center justify-center">
          Don't have an account?
          <router-link to="/signup" class="text-sm font-medium text-blue-700 flex items-center ml-2">Sign Up</router-link>
        </label>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useAuthStore } from '@/store/auth';
import { useRouter } from 'vue-router';

const email = ref('');
const password = ref('');
const errorMessage = ref('');
const authStore = useAuthStore();
const router = useRouter();

async function handleLogin() {
  try {
    await authStore.login({ email: email.value, password: password.value });
    console.log('logged in', 'token:', localStorage.getItem('token'));
    router.push('/');
  } catch (error) {
    errorMessage.value = error.response.data.message;
  }
}
</script>

<style scoped>
</style>
