<template>
  <div>
<Navbar />
  <section class="about-page py-10 px-6">
    <div class="max-w-4xl mx-auto text-center">
      <h1 class="text-3xl font-bold text-gray-800 mb-4">About Our Helpdesk System</h1>
      <p class="text-gray-600 leading-relaxed mb-6">
        Welcome to the AI-powered Helpdesk System of Consolatrix College of Toledo City, Inc. 
        Our mission is to streamline how students access information about the school environment.
        Whether you're looking for details on enrollment, building locations, or school policies, 
        this system is designed to provide instant and accurate responses to your questions.
      </p>
      <div class="grid gap-8 md:grid-cols-2">
        <div class="bg-gray-100 p-6 rounded-lg shadow-md">
          <h2 class="text-xl font-semibold text-gray-700 mb-2">Our Mission</h2>
          <p class="text-gray-600">
            To enhance accessibility and simplify information retrieval for students through AI technology.
          </p>
        </div>
        <div class="bg-gray-100 p-6 rounded-lg shadow-md">
          <h2 class="text-xl font-semibold text-gray-700 mb-2">Core Features</h2>
          <ul class="list-disc list-inside text-gray-600">
            <li>Quick and precise answers to common queries</li>
            <li>Easy navigation through school-related information</li>
            <li>Admin panel for managing FAQ content dynamically</li>
          </ul>
        </div>
      </div>
    </div>
  </section>
</div>
</template>

<script setup>
import Navbar from './Navbar.vue';

</script>

<style scoped>
.about-page {
  background-color: #f9fafb;
}
</style>
