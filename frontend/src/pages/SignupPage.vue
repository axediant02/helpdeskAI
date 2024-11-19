<template>
  <div class="min-h-screen flex flex-col bg-gray-100">
    <Navbar />
    <div class="flex-grow flex items-center justify-center p-4" style="background-image: url('https://fps.cdnpk.net/autopromos/search-right-tablet.svg'); background-size: cover; background-position: bottom;">
      <div class="bg-white/20 backdrop-blur-md rounded-lg shadow-2xl w-full max-w-4xl overflow-hidden">
        <div class="flex flex-col md:flex-row">
          <!-- Left side - Welcome message -->
          <div class="w-full md:w-1/2 p-8 flex flex-col justify-center bg-gradient-to-br from-blue-600 to-blue-800 text-white">
            <div class="mb-8">
              <router-link to="/login" class="inline-flex items-center text-sm font-medium text-white hover:text-blue-200 transition-colors">
                <ArrowLeftIcon class="w-4 h-4 mr-2" />
                Back to Login
              </router-link>
            </div>
            <h1 class="text-3xl font-bold mb-4">Join the Help Desk System!</h1>
            <p class="text-lg mb-6">Create an account to access instant support and find answers to common questions about Consolatrix College. Your journey to easy, on-demand assistance starts here!</p>
          </div>

          <!-- Right side - Sign up form -->
          <div class="w-full md:w-1/2 p-8 bg-white">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Sign Up</h2>
            <form @submit.prevent="signup" class="space-y-4">
              <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input v-model="name" type="text" id="name" name="name" required
                  class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
              </div>
              <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input v-model="email" type="email" id="email" name="email" required
                  class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                <p v-if="emailError" class="mt-2 text-sm text-red-600">Email is already in use</p>
              </div>
              <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input v-model="password" type="password" id="password" name="password" required
                  class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                <p v-if="password.length > 0 && password.length < 8" class="mt-2 text-sm text-red-600">Password must be at least 8 characters</p>
                <p v-if="password.length > 0 && (!/[a-zA-Z]/.test(password) || !/\d/.test(password))" class="mt-2 text-sm text-red-600">Password must contain letters and numbers</p>
              </div>
              <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input v-model="password_confirmation" type="password" id="password_confirmation" name="password_confirmation" required
                  class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                <p v-if="password !== password_confirmation" class="mt-2 text-sm text-red-600">Passwords do not match</p>
              </div>
              <div>
                <button type="submit" 
                  class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                  Sign Up
                </button>
              </div>
            </form>
            <p v-if="error" class="mt-4 text-sm text-red-600">{{ error }}</p>
            <div class="mt-6 text-center">
              <p class="text-sm text-gray-600">
                Already have an account?
                <router-link to="/login" class="font-medium text-blue-600 hover:text-blue-500">Log In</router-link>
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
import { useRouter } from 'vue-router';
import axios from 'axios';
import Navbar from '@/components/Navbar.vue';
import { ArrowLeftIcon } from 'lucide-vue-next';

const name = ref('');
const email = ref('');
const password = ref('');
const password_confirmation = ref('');
const emailError = ref(false);
const router = useRouter();
const error = ref(null);

const signup = async () => {
  try {
    const response = await axios.post('/api/signup', {
      name: name.value,
      email: email.value,
      password: password.value,
      password_confirmation: password_confirmation.value,
    });
    console.log('Signup successful:', response.data);
    router.push('/login');
  } catch (err) {
    console.error('Signup failed:', err.response.data);
    if (err.response.data.message === 'The password must be at least 8 characters.') {
      error.value = 'Password must be at least 8 characters.';
    } else if (err.response.data.message === 'The password confirmation does not match.') {
      error.value = 'Passwords do not match.';
    } else if (err.response.data.message === 'The email has already been taken.') {
      emailError.value = true;
    } else if (err.response.data.message === 'The password must contain at least one letter and one number.') {
      error.value = 'Password must contain letters and numbers.';
    } else {
      error.value = err.response.data.message;
    }
  }
};
</script>