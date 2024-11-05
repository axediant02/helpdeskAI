<template>
  <div class="relative">
    <router-link to="/login" v-if="!isAuthenticated">
      <button class="px-4 py-2 mb-5 bg-blue-600 text-white rounded hover:bg-blue-700 transition duration-300 ease-in-out">
        Log In
      </button>
    </router-link>
    <div v-else class="relative inline-block text-left">
      <button 
        @click="toggleDropdown" 
        class="flex items-center px-4 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 transition duration-300 ease-in-out"
      >
        <UserIcon class="mr-2 text-xl"/>
        <span>{{ user.name }}</span>
        <i class="mdi mdi-chevron-down"></i>
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

<script setup>
import { ref, computed, watch } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/store/auth'
import UserIcon from './UserIcon.vue';

const router = useRouter();
const authStore = useAuthStore();

// Retrieve initial authentication state from local storage
const isAuthenticated = computed(() => {
  const storedAuthState = localStorage.getItem('isAuthenticated');
  return storedAuthState !== null ? JSON.parse(storedAuthState) : authStore.isAuthenticated;
});

watch(isAuthenticated, (newValue) => {
  localStorage.setItem('isAuthenticated', JSON.stringify(newValue));
});

const user = computed(() => authStore.user);
const showDropdown = ref(false);

const toggleDropdown = () => {
  showDropdown.value = !showDropdown.value;
}

const logout = () => {
  authStore.logout();
  localStorage.removeItem('user');
  toggleDropdown();

}
</script>
