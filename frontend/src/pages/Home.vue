<template>
    <div>
      <div>
      <Navbar />
      <div class="flex justify-end">
      <Button label="Logout" backgroundColor="red" />
      </div>
      </div>
      <UserInput/>
    </div>
  </template>
  
  <script setup>
  import Navbar from "@/components/Navbar.vue";
  import UserInput from '@/components/UserInput.vue';
  import Button from '@/components/Button.vue';
  </script>  
