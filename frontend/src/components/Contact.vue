<template>
  <div class="min-h-screen bg-gradient-to-b from-blue-50 to-white">
    <Navbar />
    <main class="py-16 px-4 sm:px-6 lg:px-8">
      <div class="max-w-4xl mx-auto">
        <header class="text-center mb-12">
          <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
            Contact <span class="text-blue-600">Us</span>
          </h1>
          <p class="mt-3 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
            Have questions, feedback, or need assistance? We're here to help you navigate and access the information you need.
          </p>
        </header>

        <div class="grid gap-8 md:grid-cols-2">
          <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
              <MapPinIcon class="w-6 h-6 text-blue-500 mr-2" />
              Reach Us At
            </h2>
            <ul class="text-gray-600 space-y-4">
              <li class="flex items-center">
                <MailIcon class="w-5 h-5 text-blue-500 mr-2" />
                <span><strong>Email:</strong> helpdesk@consolatrix.edu</span>
              </li>
              <li class="flex items-center">
                <PhoneIcon class="w-5 h-5 text-blue-500 mr-2" />
                <span><strong>Phone:</strong> (123) 456-7890</span>
              </li>
              <li class="flex items-center">
                <BuildingIcon class="w-5 h-5 text-blue-500 mr-2" />
                <span><strong>Address:</strong> Consolatrix College of Toledo City, Inc.</span>
              </li>
            </ul>
          </div>

          <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
              <MessageSquareIcon class="w-6 h-6 text-blue-500 mr-2" />
              Send Us a Message
            </h2>
            <form @submit.prevent="submitForm">
              <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-2">Your Name</label>
                <input 
                  v-model="formData.name"
                  type="text" 
                  id="name" 
                  placeholder="Enter your name" 
                  class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-transparent"
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
                  class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  required
                />
              </div>
              <div class="mb-4">
                <label for="message" class="block text-gray-700 font-medium mb-2">Your Message</label>
                <textarea 
                  v-model="formData.message"
                  id="message" 
                  placeholder="Enter your message" 
                  class="w-full p-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                  rows="4"
                  required
                ></textarea>
              </div>
              <button 
                type="submit" 
                class="w-full bg-blue-500 text-white font-medium px-4 py-2 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-300"
              >
                <SendIcon class="w-5 h-5 inline-block mr-2" />
                Send Message
              </button>
            </form>
          </div>
        </div>
      </div>
    </main>

    <footer class="bg-gray-50 mt-16">
      <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <p class="text-center text-base text-gray-400">
          © {{ new Date().getFullYear() }} Consolatrix College of Toledo City, Inc. All rights reserved.
        </p>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { reactive } from 'vue';
import { MapPinIcon, MailIcon, PhoneIcon, BuildingIcon, MessageSquareIcon, SendIcon } from 'lucide-vue-next';
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

