import { defineStore } from 'pinia';
import axios from 'axios';

export const useAuthStore = defineStore('auth', {
  state: () => ({
    token: null,
    user: null,
  }),
  actions: {
    async login(credentials) {
      try {
        const response = await axios.post('api/login', credentials);
        this.token = response.data.token;
        axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
        await this.fetchUser();
      } catch (error) {
        console.error("Login failed:", error);
        throw error;
      }
    },
    async fetchUser() {
      try {
        const response = await axios.get('api/user');
        this.user = response.data;
      } catch (error) {
        console.error("Fetch user failed:", error);
      }
    },
    logout() {
      this.token = null;
      this.user = null;
      delete axios.defaults.headers.common['Authorization'];
    },
  },
});
