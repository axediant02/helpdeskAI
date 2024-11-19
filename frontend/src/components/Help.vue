<template>
  <div class="min-h-screen bg-gradient-to-b from-blue-50 to-white">
    <Navbar />
    <main class="py-16 px-4 sm:px-6 lg:px-8">
      <div class="max-w-4xl mx-auto">
        <header class="text-center mb-12">
          <h1 class="text-4xl font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
            Help & <span class="text-blue-600">Instructions</span>
          </h1>
          <p class="mt-3 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
            Learn how to make the most of our AI-Powered Helpdesk System
          </p>
        </header>

        <div class="space-y-12">
          <section class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
              <RocketIcon class="w-6 h-6 text-blue-500 mr-2" />
              Getting Started
            </h2>
            <p class="text-gray-600">
              Welcome to the AI-Powered Helpdesk System! This platform is designed to assist students in finding information about Consolatrix College quickly and easily. Follow these steps to make the most of the system.
            </p>
          </section>

          <section class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
              <HelpCircleIcon class="w-6 h-6 text-blue-500 mr-2" />
              How to Use the Helpdesk
            </h2>
            <ol class="list-decimal list-inside text-gray-600 space-y-4">
              <li>
                <strong>Ask a Question:</strong> Simply type your question in the search bar or chat interface, such as "Where is the library?" or "What are the enrollment requirements?"
              </li>
              <li>
                <strong>Receive Instant Answers:</strong> The system will respond with precise and accurate information based on your query.
              </li>
              <li>
                <strong>Use Suggested Prompts:</strong> If you're not sure what to ask, click on the suggested questions to get quick answers to common queries.
              </li>
              <li>
                <strong>Explore FAQs:</strong> Visit the FAQ section for detailed information on common topics like policies, schedules, and campus facilities.
              </li>
              <li>
                <strong>Contact Support:</strong> If you can't find the information you need, use the "Contact Us" page to reach out for further assistance.
              </li>
            </ol>
          </section>

          <section class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
              <LightbulbIcon class="w-6 h-6 text-blue-500 mr-2" />
              Tips for Best Results
            </h2>
            <ul class="space-y-2">
              <li class="flex items-start">
                <CheckCircleIcon class="w-5 h-5 text-green-500 mr-2 mt-1 flex-shrink-0" />
                <span>Be specific with your questions to get more accurate answers.</span>
              </li>
              <li class="flex items-start">
                <CheckCircleIcon class="w-5 h-5 text-green-500 mr-2 mt-1 flex-shrink-0" />
                <span>Use simple language to describe your query.</span>
              </li>
              <li class="flex items-start">
                <CheckCircleIcon class="w-5 h-5 text-green-500 mr-2 mt-1 flex-shrink-0" />
                <span>Check the FAQs for quick help on commonly asked questions.</span>
              </li>
              <li class="flex items-start">
                <CheckCircleIcon class="w-5 h-5 text-green-500 mr-2 mt-1 flex-shrink-0" />
                <span>If the system doesn't understand your query, try rephrasing it.</span>
              </li>
            </ul>
          </section>

          <section class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
              <WrenchIcon class="w-6 h-6 text-blue-500 mr-2" />
              Troubleshooting
            </h2>
            <p class="text-gray-600 mb-4">
              If you encounter issues while using the system, try the following steps:
            </p>
            <ul class="space-y-2">
              <li class="flex items-start">
                <AlertCircleIcon class="w-5 h-5 text-yellow-500 mr-2 mt-1 flex-shrink-0" />
                <span>Ensure you have a stable internet connection.</span>
              </li>
              <li class="flex items-start">
                <AlertCircleIcon class="w-5 h-5 text-yellow-500 mr-2 mt-1 flex-shrink-0" />
                <span>Refresh the page and try asking your question again.</span>
              </li>
              <li class="flex items-start">
                <AlertCircleIcon class="w-5 h-5 text-yellow-500 mr-2 mt-1 flex-shrink-0" />
                <span>Contact technical support via the "Contact Us" page if the issue persists.</span>
              </li>
            </ul>
          </section>
        </div>

        <div class="mt-12 text-center">
          <router-link 
            to="/" 
            class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
          >
            Try the Helpdesk
            <ArrowRightIcon class="ml-2 -mr-1 h-5 w-5" />
          </router-link>
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
import { RocketIcon, HelpCircleIcon, LightbulbIcon, WrenchIcon, CheckCircleIcon, AlertCircleIcon, ArrowRightIcon } from 'lucide-vue-next';
import Navbar from './Navbar.vue';
</script>

<style scoped>
@import 'tailwindcss/base';
@import 'tailwindcss/components';
@import 'tailwindcss/utilities';

.list-decimal {
  list-style-type: decimal;
  padding-left: 1.25rem;
}

.list-decimal li::marker {
  color: #3182ce;
  font-weight: bold;
}
</style>