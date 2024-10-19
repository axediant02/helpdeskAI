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
        <h2 class="text-2xl font-bold text-center mx-auto pr-14">Sign Up</h2>
      </div>
      <form @submit.prevent="signup">
        <div class="mb-4">
          <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
          <input v-model="name" type="text" id="name" name="name" class="border-2 border-gray-300 p-2 w-full rounded" required>
        </div>
        <div class="mb-4">
          <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
          <input v-model="email" type="email" id="email" name="email" class="border-2 border-gray-300 p-2 w-full rounded" required>
          <div v-if="emailError" class="text-red-500 text-sm mt-2">Email is already used</div>
        </div>
        <div class="mb-6">
          <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
          <input v-model="password" type="password" id="password" name="password" class="border-2 border-gray-300 p-2 w-full rounded" required>
          <div v-if="password.length > 0 && password.length < 8" class="text-red-500 text-sm mt-2">Password must be at least 8 characters</div>
          <div v-if="password.length > 0 && (!/[a-zA-Z]/.test(password) || !/\d/.test(password))" class="text-red-500 text-sm mt-2">Password must contain letters and numbers</div>
        </div>
        <div class="mb-6">
          <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirm Password</label>
          <input v-model="password_confirmation" type="password" id="password_confirmation" name="password_confirmation" class="border-2 border-gray-300 p-2 w-full rounded" required>
          <div v-if="password !== password_confirmation" class="text-red-500 text-sm mt-2">Passwords do not match</div>
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Sign Up</button>
      </form>
      <div class="mt-4">
        <label for="login" class="text-sm font-medium flex items-center justify-center">Already have an account?<router-link to="/login" class="text-sm font-medium text-blue-700 flex items-center ml-2">Log In</router-link></label>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

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
  } catch (error) {
    console.error('Signup failed:', error.response.data);
    if (error.response.data.message === 'The password must be at least 8 characters.') {
      error.value = 'Password must be at least 8 characters.';
    } else if (error.response.data.message === 'The password confirmation does not match.') {
      error.value = 'Passwords do not match.';
    } else if (error.response.data.message === 'The email has already been taken.') {
      emailError.value = true;
    } else if (error.response.data.message === 'The password must contain at least one letter and one number.') {
      error.value = 'Password must contain letters and numbers.';
    } else {
      error.value = error.response.data.message;
    }
  }
};

</script>
