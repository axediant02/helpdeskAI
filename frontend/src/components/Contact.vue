<template>
  <div>
  <Navbar />
  <section class="contact-page py-10 px-6">
    <div class="max-w-4xl mx-auto text-center">
      <h1 class="text-3xl font-bold text-gray-800 mb-4">Contact Us</h1>
      <p class="text-gray-600 leading-relaxed mb-6">
        Have questions, feedback, or need assistance? Feel free to reach out to us!
        We're here to help you navigate and access the information you need.
      </p>
      <div class="grid gap-8 md:grid-cols-2">
        <div class="bg-gray-100 p-6 rounded-lg shadow-md">
          <h2 class="text-xl font-semibold text-gray-700 mb-4">Reach Us At</h2>
          <ul class="text-gray-600 space-y-2">
            <li><strong>Email:</strong> helpdesk@consolatrix.edu</li>
            <li><strong>Phone:</strong> (123) 456-7890</li>
            <li><strong>Address:</strong> Consolatrix College of Toledo City, Inc.</li>
          </ul>
        </div>
        <div class="bg-gray-100 p-6 rounded-lg shadow-md">
          <h2 class="text-xl font-semibold text-gray-700 mb-4">Send Us a Message</h2>
          <form @submit.prevent="submitForm">
            <div class="mb-4">
              <label for="name" class="block text-gray-700 font-medium mb-2">Your Name</label>
              <input 
                v-model="formData.name"
                type="text" 
                id="name" 
                placeholder="Enter your name" 
                class="w-full p-2 border border-gray-300 rounded"
                required
              />
            </div>
            <div class="mb-4">
              <label for="email" class="block text-gray-700 font-medium mb-2">Your Email</label>
              <input 
                v-model="formData.email"
                type="email" 
                id="email" 
                placeholder="Enter your email" 
                class="w-full p-2 border border-gray-300 rounded"
                required
              />
            </div>
            <div class="mb-4">
              <label for="message" class="block text-gray-700 font-medium mb-2">Your Message</label>
              <textarea 
                v-model="formData.message"
                id="message" 
                placeholder="Enter your message" 
                class="w-full p-2 border border-gray-300 rounded"
                rows="4"
                required
              ></textarea>
            </div>
            <button 
              type="submit" 
              class="bg-blue-500 text-white font-medium px-4 py-2 rounded hover:bg-blue-600 transition"
            >
              Send Message
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>
  </div>
</template>

<script setup>
import { reactive } from 'vue';
import Navbar from './Navbar.vue';
const formData = reactive({
  name: '',
  email: '',
  message: ''
});

const submitForm = () => {
  if (formData.name && formData.email && formData.message) {
    alert(`Message sent! Thank you, ${formData.name}.`);
    formData.name = '';
    formData.email = '';
    formData.message = '';
  }
};
</script>

<style scoped>
.contact-page {
  background-color: #f9fafb;
}
</style>
