<template>
    <div class="min-h-screen bg-gray-100 flex">
      <!-- Sidebar -->
      <aside class="w-64 bg-gradient-to-b from-blue-600 to-blue-800 text-white">
        <div class="p-4">
          <h1 class="text-2xl font-bold">Admin Panel</h1>
        </div>
        <nav class="mt-8">
          <a href="#" class="block py-2 px-4 hover:bg-blue-700 transition duration-200">
            <LayoutDashboard class="inline-block w-5 h-5 mr-2" />
            Dashboard
          </a>
          <a href="#" class="block py-2 px-4 hover:bg-blue-700 transition duration-200">
            <Users class="inline-block w-5 h-5 mr-2" />
            Admins
          </a>
          <a href="#" class="block py-2 px-4 hover:bg-blue-700 transition duration-200">
            <MessageSquare class="inline-block w-5 h-5 mr-2" />
            Conversations
          </a>
          <a href="#" class="block py-2 px-4 hover:bg-blue-700 transition duration-200">
            <Settings class="inline-block w-5 h-5 mr-2" />
            Settings
          </a>
        </nav>
      </aside>
  
      <!-- Main Content -->
      <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Header -->
        <header class="bg-white shadow-md p-4">
          <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">Dashboard</h2>
            <div class="flex items-center space-x-4">
              <SearchBar />
              <Notification />
              <LoginButton />
            </div>
          </div>
        </header>
  
        <!-- Main Content Area -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gradient-to-r from-blue-100 via-blue-50 to-purple-50 p-6">
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <StatCard title="Total Users" value="1,234" icon="Users" />
            <StatCard title="Active Conversations" value="56" icon="MessageSquare" />
            <StatCard title="Questions Asked" value="8,901" icon="HelpCircle" />
            <StatCard title="Satisfaction Rate" value="95%" icon="ThumbsUp" />
          </div>
  
          <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold mb-4">Recent Activity</h3>
            <div class="flex flex-row items-center justify-end w-full mb-4">

                <ExportCSV/>
            </div>
            <QuestionAndAnswer/>
          </div>
        </main>
      </div>
      <!-- Add Admin Modal -->
      <AddAdminModal v-if="addAdminStore.isAdminModalVisible" @close="closeAddAdminModal" />
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { useAddAdminStore } from '@/store/addAdminStore';
  import SearchBar from '@/components/SearchBar.vue';
  import Notification from '@/components/Notification.vue';
  import LoginButton from '@/components/LoginButton.vue';
  import AddAdminModal from '@/components/AddAdminModal.vue';
  import ExportCSV from '@/components/buttons/ExportCSV.vue';
  import QuestionAndAnswer from '@/components/QuestionAndAnswer.vue';

  
  const addAdminStore = useAddAdminStore();
  
  const closeAddAdminModal = () => {
    addAdminStore.isAdminModalVisible = false;
  };
  </script>