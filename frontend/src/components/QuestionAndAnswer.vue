<template>
    <div class="flex flex-col items-center justify-center p-4 w-screen">
      <table class="min-w-full divide-y divide-gray-200 shadow-md rounded-lg overflow-hidden">
        <thead class="bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">
              Question
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">
              Answer
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium tracking-wider text-gray-500 uppercase">
              Actions
            </th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <tr v-for="(item, index) in mockQnA" :key="index" class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm font-medium text-gray-900">
                {{ item.question }}
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm font-medium text-gray-900">
                {{ item.answer }}
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <!-- Enhanced actions with icons -->
              <button class="text-blue-600 hover:text-blue-800 p-2 rounded-full bg-blue-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-1.414a1 1 0 01-1.414 0V10a1 1 0 011.414 0L13 14.586V17a1 1 0 01-1.414 1.414l-3 3a1 1 0 01-1.414-1.414l1-1a1 1 0 011.414 0z" />
                </svg>
              </button>
              <button class="text-red-600 hover:text-red-800 p-2 rounded-full bg-red-100 ml-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-5 5m-5-5v-2a2 2 0 00-2 2H5a2 2 0 002 2v3a2 2 0 002 2h11a2 2 0 002-2v-3a2 2 0 00-2-2h-1" />
                </svg>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script setup>
  const mockQnA = [
    { question: "What is the library's opening hour?", answer: "The library opens at 8 AM." },
    { question: "Where is the cafeteria located?", answer: "The cafeteria is on the first floor." },
    { question: "How do I register for classes?", answer: "You can register online through the student portal." },
    { question: "What are the office hours for the registrar?", answer: "The registrar's office is open from 9 AM to 5 PM." },
    { question: "Can I park on campus?", answer: "Yes, parking is available for students." },
  ];
  </script>