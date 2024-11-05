import { defineStore } from 'pinia';

export const useAuthStore = defineStore('auth', {
  state: () => ({
    isAuthenticated: false,
    user: null,
  }),
  actions: {
    login(userData) {
      this.isAuthenticated = true;
      this.user = userData;
    },
    logout() {
      this.isAuthenticated = false;
      this.user = null; 
    },
    isAdmin() {
      return this.user && this.user.role === 'admin'; 
    }
  }
});
