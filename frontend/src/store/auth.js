import { defineStore } from 'pinia';
import axios from 'axios';

export const useAuthStore = defineStore('auth', {
    state: () => ({
        token: localStorage.getItem('token') || null, // Retrieve token from local storage
        user: JSON.parse(localStorage.getItem('user')) || {}, // Retrieve user from local storage
        message: null,
      }),
  getters: {
      isAuthenticated: (state) => !!state.token,
      
  },
  actions: {
    async login(credentials) {
      try {
        const response = await axios.post('api/login', credentials);
        this.token = response.data.access_token;
        axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
        this.user = response.data.user;
          
        localStorage.setItem('token', this.token, this.isAuthenticated);
        localStorage.setItem('user', JSON.stringify(this.user));
          
      } catch (error) {
        if (error.response && error.response.status === 422) {
          this.message = "Login failed. Please check your input data.";
        } else {
          this.message = "Login failed. Please check your credentials.";
        }
        console.error("Login failed:", error.response ? error.response.data : error);
        throw error;
      }
    },
    async fetchUser() {
      try {
        if (!this.user || !this.user.id) {
          throw new Error("User is not logged in or user ID is not available.");
        }
        const response = await axios.get(`api/user/${this.user.id}`);
        this.user = response.data;
      } catch (error) {
        this.message = "Failed to fetch user data.";
        console.error("Fetch user failed:", error.response ? error.response.data : error);
      }
    },
    logout() {
      this.token = null;
      this.user = {};
      this.message = null;
      delete axios.defaults.headers.common['Authorization'];
      localStorage.removeItem('token');
      localStorage.removeItem('user');
    },
  },
});
