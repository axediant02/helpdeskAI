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
      <form @submit.prevent="login">
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
import { useRouter } from 'vue-router';
import axios from 'axios'; // Import axios for API calls

// Router instance for navigation
const router = useRouter();

// State variables for login form
const email = ref('');
const password = ref('');

// Login function
const login = async () => {
  // Validate email and password fields
  if (email.value && password.value) {
    try {
      // Make an API call to authenticate user
      const response = await axios.post('api/login', {
        email: email.value,
        password: password.value,
      });

      // Extract user data from response
      const userData = response.data.user; // Access user object from response
      console.log('User Data:', userData); // Log user data to see its structure
      const userRole = userData.role; // Get the user's role from the response

      // Store any necessary information, such as user ID and token, in local storage
      localStorage.setItem('userId', userData.id); // Store user ID if needed
      localStorage.setItem('token', response.data.access_token); // Store access token

      // Call function to handle redirection based on user role
      handleRoleRedirect(userRole);
    } catch (error) {
      // Handle specific error messages from API if possible
      if (error.response && error.response.status === 401) {
        alert('Invalid email or password'); // Specific error handling for unauthorized access
      } else {
        alert('An error occurred during login. Please try again.'); // General error message
      }
    }
  } else {
    alert('Please fill in both fields'); // Basic error handling
  }
};

// Function to handle redirection based on user role
const handleRoleRedirect = (role) => {
  if (role === 'admin') {
    router.push('/admin'); // Redirect to admin page
  } else if (role === 'student') {
    router.push('/'); // Redirect to homepage for students
  } else {
    alert('User role is not recognized'); // Handle unexpected roles
  }
};
</script>

<style scoped>
/* Add any scoped styles here if necessary */
</style>
