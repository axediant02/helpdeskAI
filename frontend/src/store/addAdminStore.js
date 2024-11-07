import { defineStore } from 'pinia';

export const useAddAdminStore = defineStore('addAdmin', {
    state: () => ({
        isAdminModalVisible: false,
        adminAccountData: {
            name: '',
            username: '',
            email: '',
            password: '',
            role: 'admin',
        },
    }),
    actions: {
        openAddAdminModal() {
            this.isAdminModalVisible = true;
        },
        closeAddAdminModal() {
            this.isAdminModalVisible = false;
        },
        resetAdminData() {
            this.adminAccountData = {
                name: '',
                username: '',
                email: '',
                password: '',
                role: 'admin',
            };
        }
    }
});

