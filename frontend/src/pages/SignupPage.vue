<template>
  <div class="h-screen flex flex-col">
    <Navbar />
  <div class="bg-royalBlue h-screen flex items-center justify-center" style="background-image: url('https://fps.cdnpk.net/autopromos/search-right-tablet.svg'); background-size: cover; background-position: bottom;">
    <div class="bg-white/15 backdrop-blur-md rounded-lg shadow-2xl w-1/2 h-3/5 flex justify-end items-end overflow-hidden p-4 pt-10">
      <div class="w-1/2 h-full mt-4 mr-4 flex flex-col mb-6">
        <div class="flex items-center justify-center p-2 h-10 w-20 hover:bg-buttonHover rounded">
          <router-link to="/login" class="w-6 h-6 text-white p-1 rounded mr-2 flex items-center">
            <i class="mdi mdi-arrow-left h-4 w-4 flex justify-center items-center"></i>
          <span class="text-sm font-medium text-gray-700 hover:text-gray-900 pl-2">Back</span>
        </router-link>
        </div>
        <div class="p-4 pb-20 h-full flex flex-col justify-center">
          <div class="flex h-full border border-buttonColor rounded">
        <h1 class="text-3xl font-bold mx-auto pr-10 text-center">Join the Help Desk System!</h1>
      </div>
      <div class="h-full
      ">
        <p class="text-lg text-justify"><span class="pl-4">Create</span> an account to access instant support and find answers to common questions about Consolatrix College. Your journey to easy, on-demand assistance starts here!</p>
      </div>
        </div>
      </div>
    <div class="w-full max-w-md bg-white/10 rounded-lg shadow-2xl p-4">
      <div class="flex items-center justify-between mb-6">
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
  </div>
</div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';
import Navbar from '@/components/Navbar.vue';
import '@mdi/font/css/materialdesignicons.css';


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
