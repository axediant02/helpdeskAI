<template>
  <div>
  <Navbar />
  <section class="help-page py-10 px-6">
    <div class="max-w-4xl mx-auto">
      <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Help & Instructions</h1>
      <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-2">Getting Started</h2>
        <p class="text-gray-600">
          Welcome to the AI-Powered Helpdesk System! This platform is designed to assist students in finding information about Consolatrix College quickly and easily. Follow these steps to make the most of the system.
        </p>
      </div>
      <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-2">How to Use the Helpdesk</h2>
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
      </div>
      <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-2">Tips for Best Results</h2>
        <ul class="list-disc list-inside text-gray-600 space-y-2">
          <li>Be specific with your questions to get more accurate answers.</li>
          <li>Use simple language to describe your query.</li>
          <li>Check the FAQs for quick help on commonly asked questions.</li>
          <li>If the system doesn't understand your query, try rephrasing it.</li>
        </ul>
      </div>
      <div>
        <h2 class="text-xl font-semibold text-gray-700 mb-2">Troubleshooting</h2>
        <p class="text-gray-600">
          If you encounter issues while using the system, try the following steps:
        </p>
        <ul class="list-disc list-inside text-gray-600 space-y-2">
          <li>Ensure you have a stable internet connection.</li>
          <li>Refresh the page and try asking your question again.</li>
          <li>Contact technical support via the "Contact Us" page if the issue persists.</li>
        </ul>
      </div>
    </div>
  </section>
  </div>
</template>

<script setup>
import Navbar from './Navbar.vue';
</script>

<style scoped>
.help-page {
  background-color: #f9fafb; /* Light background for readability */
}
h1, h2 {
  color: #2d3748; /* Dark gray for headers */
}
</style>
