<template>
    <Navbar />
    <div class="flex flex-col items-center justify-center h-screen">
        
    <div class="flex flex-col items-center justify-center h-24 text-3xl font-bold">
        <h1>Profile Coming Soon... 🚧</h1>

    </div>
    <div>
        <router-link to="/" class="mb-4">
            <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition duration-300 ease-in-out">
                Back
            </button>
        </router-link>
    </div>
</div>
</template>
<script setup>
import Navbar from '@/components/Navbar.vue';
</script>
