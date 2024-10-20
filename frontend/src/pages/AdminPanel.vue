<template>
    <div>
        <nav class="w-full ">
            <div class="flex flex-col items-center justify-center p-4 bg-blue-400 shadow mx-auto">
                <div class="flex flex-row items-center justify-between w-full mb-4">
                    <h1 class="text-4xl font-bold text-gray-800">Admin Panel</h1>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" @click="logout">Logout</button>
                </div>
            </div>
        </nav>
        <div class="flex flex-col items-center justify-center">
            <QuestionAndAnswer />
        </div>
    </div>
</template>

<script setup>
import QuestionAndAnswer from '@/components/QuestionAndAnswer.vue';

import { ref } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();

const logout = () => {
    router.push('/');
    localStorage.removeItem('token');
    localStorage.removeItem('user');
};
</script>

<style scoped>
</style>
