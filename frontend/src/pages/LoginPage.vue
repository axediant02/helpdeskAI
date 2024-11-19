<template>
  <div class="min-h-screen flex flex-col bg-gray-100">
    <Navbar />
    <div class="flex-grow flex items-center justify-center p-4" style="background-image: url('https://fps.cdnpk.net/autopromos/search-right-tablet.svg'); background-size: cover; background-position: bottom;">
      <div class="bg-white/20 backdrop-blur-md rounded-lg shadow-2xl w-full max-w-4xl overflow-hidden">
        <div class="flex flex-col md:flex-row">
          <div class="w-full md:w-1/2 p-8 flex flex-col justify-center bg-gradient-to-br from-blue-600 to-blue-800 text-white">
            <div class="mb-8">
              <router-link to="/" class="inline-flex items-center text-sm font-medium text-white hover:text-blue-200 transition-colors">
                <ArrowLeftIcon class="w-4 h-4 mr-2" />
                Back to Home
              </router-link>
            </div>
            <h1 class="text-3xl font-bold mb-4">Welcome Back to the Help Desk!</h1>
            <p class="text-lg mb-6">Log in to access the resources and support you need to thrive at Consolatrix College.</p>
          </div>

          <div class="w-full md:w-1/2 p-8 bg-white">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">User Login</h2>
            <form @submit.prevent="handleLogin" class="space-y-4">
              <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input v-model="email" type="email" id="email" name="email" required
                  class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
              </div>
              <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <div class="relative">
                  <input 
                    v-model="password" 
                    :type="showPassword ? 'text' : 'password'" 
                    id="password" 
                    name="password" 
                    required
                    class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                  >
                  <button 
                    type="button" 
                    @click="togglePasswordVisibility" 
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5"
                  >
                    <EyeIcon v-if="!showPassword" class="h-5 w-5 text-gray-400" />
                    <EyeOffIcon v-else class="h-5 w-5 text-gray-400" />
                  </button>
                </div>
              </div>
              <div class="flex items-center justify-between">
                <div class="flex items-center">
                  <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                  <label for="remember-me" class="ml-2 block text-sm text-gray-900">Remember me</label>
                </div>
                <div class="text-sm">
                  <a href="#" class="font-medium text-blue-600 hover:text-blue-500">Forgot your password?</a>
                </div>
              </div>
              <div>
                <button type="submit" 
                  class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                  Login
                </button>
              </div>
            </form>
            <p v-if="errorMessage" class="mt-4 text-sm text-red-600">{{ errorMessage }}</p>
            <div class="mt-6 text-center">
              <p class="text-sm text-gray-600">
                Don't have an account?
                <router-link to="/signup" class="font-medium text-blue-600 hover:text-blue-500">Sign Up</router-link>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</template>

<script setup>
import { ref } from 'vue';
import { useAuthStore } from '@/store/auth';
import { useRouter } from 'vue-router';
import Navbar from '@/components/Navbar.vue';
import { ArrowLeftIcon, EyeIcon, EyeOffIcon } from 'lucide-vue-next';

const email = ref('');
const password = ref('');
const errorMessage = ref('');
const showPassword = ref(false);
const authStore = useAuthStore();
const router = useRouter();

function togglePasswordVisibility() {
  showPassword.value = !showPassword.value;
}

async function handleLogin() {
  try {
    errorMessage.value = '';
    
    if (!email.value || !password.value) {
      throw new Error("Email and password are required.");
    }
    
    const response = await authStore.login({ email: email.value, password: password.value });
    
    if (response && response.access_token) {
      localStorage.setItem('token', response.access_token);
    }
    router.push('/');
  } catch (error) {
    errorMessage.value = error.response?.data?.message || error.message || "An unexpected error occurred. Please try again.";
    console.error("Login error:", error);
  }
}
</script>

<style scoped>
.bg-gradient-to-br {
  background-image: linear-gradient(to bottom right, var(--tw-gradient-stops));
}
</style>
