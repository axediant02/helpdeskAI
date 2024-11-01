import { defineStore } from 'pinia'

export const useAuthStore = defineStore('auth', {
    state: () => ({
        isAdmin: false,
        user: {
            name: '',
            email: '',
        },
    }),
    actions: {
        login(user) {
            this.isAdmin = true;
            this.user = { ...user };
        },
        logout() {
            this.isAdmin = false;
            this.user = { name: '', email: '' };
        },
    },
})

