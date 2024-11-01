<template>
    <div class="relative">
      <!-- Button when the user is not logged in -->
      <button 
        v-if="!isAuthenticated" 
        @click="login" 
        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition"
      >
        Log In
      </button>
  
      <!-- Button and dropdown menu when the user is logged in -->
      <div v-else class="relative inline-block text-left">
        <!-- User button with icon and name -->
        <button 
          @click="toggleDropdown" 
          class="flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition"
        >
          <UserIcon :userIconSrc="userIconSrc" />
          <span>{{ user.name }}</span>
        </button>
  
        <!-- Dropdown menu for logged-in users -->
        <div 
          v-if="showDropdown" 
          class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded shadow-md"
        >
          <button 
            @click="logout" 
            class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 transition"
          >
            Log Out
          </button>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  import { ref } from 'vue';
  import UserIcon from './UserIcon.vue';
  
  export default {
    components: {
      UserIcon,
    },
    setup() {
      // Track whether user is authenticated
      const isAuthenticated = ref(false);
      const user = ref({ name: '' }); // User data, e.g., { name: 'John Doe' }
      const showDropdown = ref(false);
  
      // Function to toggle the dropdown menu
      const toggleDropdown = () => {
        showDropdown.value = !showDropdown.value;
      };
  
      // Simulate login action
      const login = () => {
        // Simulate successful login
        isAuthenticated.value = true;
        user.value.name = 'John Doe'; // Replace with actual username from API
      };
  
      // Log out the user
      const logout = () => {
        isAuthenticated.value = false;
        user.value.name = '';
        showDropdown.value = false;
      };
  
      return {
        isAuthenticated,
        user,
        showDropdown,
        toggleDropdown,
        login,
        logout,
      };
    },
  };
  </script>
  
  <style scoped>
  /* Optional styling for transitions */
  button {
    transition: background-color 0.2s;
  }
  </style>
  