// src/store/auth.js
import { defineStore } from 'pinia';
import axios from 'axios';

export const useAuthStore = defineStore('auth', {
  state: () => ({
    token: null,
    user: {}, // Initialize user as an empty object
    message: null, // Optional error message handling
  }),
  getters: {
    isAuthenticated: (state) => !!state.token,
  },
  actions: {
    async login(credentials) {
      try {
        const response = await axios.post('api/login', credentials);
        this.token = response.data.token;
        axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;

        // Set the user data directly from the login response
        this.user = response.data.user; // Assuming the user data is returned in this structure

        localStorage.setItem('token', this.token);
        localStorage.setItem('user', JSON.stringify(this.user));
        
        console.log(this.user); // Log user info for debugging

      } catch (error) {
        this.message = "Login failed. Please check your credentials.";
        console.error("Login failed:", error.response ? error.response.data : error);
        throw error;
      }
    },
    async fetchUser() {
      try {
        // Only attempt to fetch if user ID exists
        if (!this.user || !this.user.id) {
          throw new Error("User is not logged in or user ID is not available.");
        }
        const response = await axios.get(`api/user/${this.user.id}`);
        this.user = response.data; // Update user with fetched data
      } catch (error) {
        this.message = "Failed to fetch user data.";
        console.error("Fetch user failed:", error.response ? error.response.data : error);
      }
    },
    logout() {
      this.token = null;
      this.user = {}; // Reset user to an empty object
      this.message = null;
      delete axios.defaults.headers.common['Authorization'];
      localStorage.removeItem('token');
      localStorage.removeItem('user');
    },
  },
});
