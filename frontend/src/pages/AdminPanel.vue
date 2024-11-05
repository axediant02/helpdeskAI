<template>
    <div>
        <nav class="w-full ">
            <div class="flex flex-col items-center justify-center p-4 bg-blue-400 shadow mx-auto">
                <div class="flex flex-row items-center justify-between w-full">
                    <h1 class="text-4xl font-bold text-gray-800">Admin Panel</h1>
                    <SearchBar />
                    <div class="flex flex-row items-center">
                        <Notification class="text-3xl mr-4"/>
                        <LoginButton />
                    </div>
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
import Notification from '@/components/Notification.vue';
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import SearchBar from '@/components/SearchBar.vue';
import LoginButton from '@/components/LoginButton.vue';
const router = useRouter();

const logout = () => {
    router.push('/');
    localStorage.removeItem('token');
    localStorage.removeItem('user');
};
</script>

<style scoped>
</style>
