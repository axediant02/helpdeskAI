<template>
  <div class="h-screen flex flex-col">
  <Navbar />
  <div class="bg-royalBlue h-full flex items-center justify-center" style="background-image: url('https://fps.cdnpk.net/autopromos/search-right-tablet.svg'); background-size: cover; background-position: bottom;">
    <div class="bg-white/15 backdrop-blur-md rounded-lg shadow-2xl p-4 w-1/2 h-3/5 flex justify-end items-end overflow-hidden pt-10" >
      <div class="w-1/2 h-full p-4 m-4 flex flex-col mb-6">
        <div class="flex  items-center">
          <router-link to="/" class="w-6 h-6 bg-gray-500 text-white p-1 rounded mr-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
          </router-link>
          <span class="text-sm font-medium text-gray-700">Back</span>
        </div>
        <div class="">
        <h1 class="text-3xl font-bold mx-auto pr-10 text-center">Welcome Back to the Help Desk!</h1>
        <p class="text-lg font-medium">Log in to access the resources and support you need to thrive at Consolatrix College.</p>
        </div>
      </div>

    <div class="w-full max-w-md h-full bg-lightRoyalBlue rounded-lg shadow-xl p-4 flex flex-col justify-center it">
      <div class="flex items-center justify-center mb-6 ">
        <h2 class="text-2xl font-bold text-center mx-auto">User Login</h2>
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
  </div>
</div>
</template>

<script setup>
import { ref } from 'vue';
import { useAuthStore } from '@/store/auth';
import { useRouter } from 'vue-router';
import Navbar from '@/components/Navbar.vue';

const email = ref('');
const password = ref('');
const errorMessage = ref('');
const authStore = useAuthStore();
const router = useRouter();

async function handleLogin() {
  try {
    // Validate input before attempting to log in
    if (!email.value || !password.value) {
      throw new Error("Email and password are required.");
    }
    
    // Call the login method and wait for the response
    const response = await authStore.login({ email: email.value, password: password.value });
    
    // Save the token to localStorage if your store returns it
    if (response && response.access_token) {
      localStorage.setItem('token', response.access_token);
    }
    
    // Redirect the user after successful login
    router.push('/');
  } catch (error) {
    // Error handling
    errorMessage.value = error.response?.data?.message || "Login failed. Please try again.";
    console.error("Login error:", error); // Added for debugging purposes
  }
}

// Removed onMounted function to prevent automatic token check
</script>


<style scoped>

</style>
