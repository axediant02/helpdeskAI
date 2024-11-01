<template>
    <div class="relative">
      <router-link to="/login" v-if="!isAuthenticated">
        <button @click="login" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition duration-300 ease-in-out">
        Log In
        </button>
      </router-link>
      <div v-else class="relative inline-block text-left">
        <button 
          @click="toggleDropdown" 
          class="flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition duration-300 ease-in-out"
        >
          <UserIcon :userIconSrc="userIconSrc" class="mr-2" />
          <span>{{ user.name }}</span>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13l-7-7m0 0l-7 7m7-7v7m-7-7h7" />
          </svg>
        </button>
        <div 
          v-if="showDropdown" 
          class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded shadow-md"
        >
          <router-link to="/profile" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 transition duration-300 ease-in-out">
            Profile
          </router-link>
          <button 
            @click="logout" 
            class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 transition duration-300 ease-in-out"
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
      const isAuthenticated = ref(false);
      const user = ref({ name: '' });
      const showDropdown = ref(false);
      const userIconSrc = ref('');

      const toggleDropdown = () => {
        showDropdown.value = !showDropdown.value;
      };

      const login = () => {
        isAuthenticated.value = true;
        user.value.name = 'John Doe';
        userIconSrc.value = 'path/to/user/icon';
      };

      // Log out the user
      const logout = () => {
        isAuthenticated.value = false;
        user.value.name = '';
        userIconSrc.value = '';
        showDropdown.value = false;
      };

      return {
        isAuthenticated,
        user,
        showDropdown,
        toggleDropdown,
        login,
        logout,
        userIconSrc,
      };
    },
  };
  </script>
  
  <style scoped>
  button {
    transition: background-color 0.2s;
  }
  </style>