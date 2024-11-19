<template>
  <div class="min-h-screen bg-gradient-to-b from-blue-50 to-white">
    <Navbar />
    <main class="py-16 px-4 sm:px-6 lg:px-8">
      <div class="max-w-4xl mx-auto">
        <header class="text-center mb-12">
          <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
            About Our
            <span class="text-blue-600">Helpdesk System</span>
          </h1>
          <p class="mt-3 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
            Empowering students with instant access to information at Consolatrix College of Toledo City, Inc.
          </p>
        </header>

        <section class="prose prose-blue mx-auto mb-16">
          <p>
            Welcome to the AI-powered Helpdesk System of Consolatrix College of Toledo City, Inc. 
            Our mission is to streamline how students access information about the school environment.
            Whether you're looking for details on enrollment, building locations, or school policies, 
            this system is designed to provide instant and accurate responses to your questions.
          </p>
        </section>

        <div class="grid gap-8 md:grid-cols-2">
          <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center mb-4">
              <FlagIcon class="w-8 h-8 text-blue-500 mr-3" />
              <h2 class="text-2xl font-bold text-gray-800">Our Mission</h2>
            </div>
            <p class="text-gray-600">
              To enhance accessibility and simplify information retrieval for students through AI technology,
              ensuring that every query is met with a prompt and accurate response.
            </p>
          </div>
          <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center mb-4">
              <ListChecksIcon class="w-8 h-8 text-blue-500 mr-3" />
              <h2 class="text-2xl font-bold text-gray-800">Core Features</h2>
            </div>
            <ul class="space-y-2 text-gray-600">
              <li class="flex items-center">
                <CheckCircleIcon class="w-5 h-5 text-green-500 mr-2" />
                Quick and precise answers to common queries
              </li>
              <li class="flex items-center">
                <CheckCircleIcon class="w-5 h-5 text-green-500 mr-2" />
                Easy navigation through school-related information
              </li>
              <li class="flex items-center">
                <CheckCircleIcon class="w-5 h-5 text-green-500 mr-2" />
                Admin panel for managing FAQ content dynamically
              </li>
              <li class="flex items-center">
                <CheckCircleIcon class="w-5 h-5 text-green-500 mr-2" />
                24/7 availability for student support
              </li>
            </ul>
          </div>
        </div>

        <section class="mt-16 text-center">
          <h2 class="text-3xl font-bold text-gray-900 mb-4">Ready to Get Started?</h2>
          <p class="text-gray-600 mb-8">
            Explore our AI-powered helpdesk and get instant answers to your questions.
          </p>
          <router-link 
            to="/" 
            class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
          >
            Try the Helpdesk
            <ArrowRightIcon class="ml-2 -mr-1 h-5 w-5" />
          </router-link>
        </section>
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
import { FlagIcon, ListChecksIcon, CheckCircleIcon, ArrowRightIcon } from 'lucide-vue-next';
import Navbar from './Navbar.vue';
</script>
