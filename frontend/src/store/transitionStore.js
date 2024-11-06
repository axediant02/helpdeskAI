import { defineStore } from 'pinia';

export const useTransitionStore = defineStore('transition', {
    state: () => ({
        isSwitching: false,
    }),
    actions: {
        startSwitch() {
            this.isSwitching = true;
        },
        endSwitch() {
            this.isSwitching = false;
        }
    }
});