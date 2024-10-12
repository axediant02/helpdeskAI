<template>
    <div>
      <Navbar />
      <UserInput/>
    </div>
  </template>
  
  <script>
  import Navbar from "@/components/Navbar.vue";
  import UserInput from '@/components/UserInput.vue';
  
  export default {
    components: {
      Navbar,
      UserInput
    },
  };
  </script>
  