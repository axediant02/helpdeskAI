<template>
  <div class="h-screen bg-gray-100 flex">
    <!-- Sidebar for Chat History -->
    <transition name="slide">
      <History
        v-if="showHistory"
        :messages="messages"
        :showHistory="showHistory"
        :toggleHistory="toggleHistory"
        class="fixed inset-y-0 left-0 z-40 w-64 bg-white shadow-lg p-4"
      >
        <button @click="toggleHistory" class="close-button">Close</button>
      </History>
    </transition>

    <!-- Main Chat Interface -->
    <div :class="showHistory ? 'ml-64' : 'ml-0'" class="flex-grow flex items-center justify-center p-0 transition-all duration-300">
      <div class="h-full w-full shadow-xl overflow-hidden relative bg-royalBlue">

        <!-- Header Section -->
          <div class="flex items-center p-6 bg-gradient-to-r h-20 from-lightRoyalBlue to-darkRoyalBlue">
            <div class="mr-auto">
              <ToggleButton :showHistory="showHistory" :toggleHistory="toggleHistory" />
            </div>
            <div class="flex-grow flex flex-col items-center justify-center text-center">
              <h1 class="text-2xl md:text-3xl font-bold text-white">
                Welcome to the Help Desk System
              </h1>
              <div class="flex justify-center mt-2">
                <span class="text-sm text-blue-100">
                  <span class="inline-block w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></span>
                  Conversation Mode Active
                </span>
              </div>
            </div>
        
            <!-- Login Button -->
            <div class="flex items-center justify-center" style="margin-right: 20px; margin-top: 20px;">
              <LoginButton />
            </div>
          </div>

        <div class="p-6">
          <div class="h-full flex justify-center items-center">
            <div ref="chatContainer" class="h-full w-1/2 overflow-y-auto mb-6 space-y-4 p-4 rounded-lg shadow-inner">
              <template v-if="messages.length">
              <div
                v-for="(message, index) in messages"
                :key="index"
                :class="[ 
                  'flex items-end space-x-2 mb-4',
                  message.type === 'user' ? 'justify-end' : 'justify-start'
                ]"
              >
                <!-- Display user messages aligned to the right and AI messages aligned to the left -->
                <div
                :class="[ 
                  'inline-block w-auto max-w-[70%] p-3 rounded-2xl shadow transition-all duration-300',
                  message.type === 'user' 
                    ? 'bg-blue-500 text-white ml-auto rounded-tr-none' 
                    : 'bg-gray-100 text-gray-800 rounded-tl-none'
                ]"
              >
                  <div class="flex items-center space-x-2 mb-1">
                    <span class="text-xs font-semibold">
                      {{ message.type === 'user' ? 'You' : 'AI Assistant' }}
                    </span>
                    <span v-if="message.type === 'ai'" class="text-xs text-gray-400">
                      {{ getTimestamp(message.timestamp) }}
                    </span>
                  </div>
                  <div class="text-sm">{{ message.text }}</div>
                </div>
              </div>
            </template>
            <div v-else class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 txt-center flex flex-col items-center justify-center h-full">
              <MessageSquare class="w-16 h-16 mx-auto mb-4 text-gray-400" />
              <p class="text-lg font-medium">No messages yet</p>
              <p class="text-sm">Start a conversation by asking a question!</p>
            </div>
          </div>
        </div>



          
          <div class="flex justify-center absolute bottom-10 w-full">
            <div class="flex flex-row items-center space-x-2 w-1/2 h-12 bg-lightRoyalBlue rounded-full">
              <input
                v-model="userInput"
                @keyup.enter="sendMessage"
                placeholder="Ask the System..."
                class="flex-grow border-2 border-lightRoyalBlue rounded-full focus:outline-none focus:ring-2 focus:ring-royalBlue transition duration-200 ease-in-out bg-lightRoyalBlue"
                :disabled="isLoading"
                style="margin-left: 10px;"
              />
              <button
                @click="sendMessage"
                class="bg-darkRoyalBlue text-white w-10 h-10 p-2 rounded-full flex items-center justify-center hover:bg-lightRoyalBlue focus:outline-none focus:ring-2 focus:ring-royalBlue transition-colors duration-200"
                :disabled="isLoading"
                style="margin-right: 10px;"
              >
                <Send v-if="!isLoading" class="w-5 h-5" />
                <Loader v-else class="w-5 h-5 animate-spin" />
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
.bg-light-blue-100 {
  background-color: #D1E6FF;
}
.sidebar {
  width: 300px;
  height: 100%;
  position: absolute;
  left: 0;
  top: 0;
  z-index: 10;
  overflow-y: auto;
}
.history-message {
  margin: 5px 0;
}
.close-button {
  background: none;
  border: none;
  color: #000;
  cursor: pointer;
  font-size: 16px;
  margin-bottom: 10px;
}
</style>

<script setup>
import { ref, onMounted, nextTick, watch } from 'vue';
import { GoogleGenerativeAI } from '@google/generative-ai';
import History from './History.vue';
import { Send, Loader, MessageSquare } from 'lucide-vue-next'; 
import ToggleButton from './ToggleButton.vue';
import LoginButton from './LoginButton.vue';

const genAI = ref(null);
const model = ref(null);
const userInput = ref('');
const messages = ref([]);
const chatContainer = ref(null);
const isLoading = ref(false);
const showHistory = ref(false);

const generationConfig = {
  temperature: 0.7,
  topP: 0.8,
  topK: 40,
  maxOutputTokens: 1024,
};

const systemPrompt = {
  text: `You are a friendly AI assistant for Consolatrix, your name is Ezhack. Answer the question precisely and accurately base on the given data. If the user ask a question that the answer is Yes or No, then answer Yes or No, and give a little information. Remember the context of the conversation in case for chain conversation. If the question does not have data on the system for response, respond with "I dont have information about that for now, please wait for the next update". If the question is not related to the data, say "I can't help with that question .The scope of this system is limited to Consolatrix. Please ask a question related to Consolatrix."`
};


const getTimestamp = (timestamp) => {
  if (!timestamp) return '';
  const now = new Date();
  const msgTime = new Date(timestamp);
  
  return now.toDateString() === msgTime.toDateString() 
    ? msgTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }) 
    : msgTime.toLocaleDateString();
};

const sendMessage = async () => {
  if (!userInput.value.trim() || isLoading.value) return;

  const currentTime = new Date().toISOString();
  messages.value.push({ 
    type: 'user', 
    text: userInput.value,
    timestamp: currentTime
  });

  const question = userInput.value;
  userInput.value = '';
  isLoading.value = true;

  try {
    const answer = await generateAnswer(question);
    messages.value.push({ 
      type: 'ai', 
      text: answer,
      timestamp: new Date().toISOString()
    });
  } catch (error) {
    console.error('Error generating answer:', error);
    messages.value.push({ 
      type: 'ai', 
      text: 'Sorry, there was an error generating the answer. Please try again later.',
      timestamp: new Date().toISOString()
    });
  } finally {
    isLoading.value = false;
    nextTick(() => scrollToBottom());
  }
};

const generateAnswer = async (question) => {
  const parts = [
    systemPrompt,
    { text: "Answer the question precisely and accurately." },
    { text: "input: Where is the library located?" },
    { text: "output: The library is located on the second floor of the main building, near the science labs." },
    { text: "input: What time does the school day start?" },
    { text: "output: The school day starts at 8:00 AM. Make sure to arrive a bit earlier to get settled before classes begin." },
    { text: "input: Where can I find the cafeteria?" },
    { text: "output: The cafeteria is on the ground floor, right next to the main entrance. It's open for breakfast and lunch." },
    { text: "input: How can I get a locker?" },
    { text: "output: You can get a locker by visiting the student services office. They will assign one to you and provide a key or combination." },
    { text: "input: Where is the gymnasium?" },
    { text: "output: The gymnasium is located on the west side of the campus, behind the main building. It’s next to the outdoor sports fields." },
    { text: "input: What is the school’s policy on absences?" },
    { text: "output: If you need to be absent, make sure to notify the school office and provide a note from a parent or guardian explaining the absence." },
    { text: "input: Where are the art classrooms?" },
    { text: "output: The art classrooms are located on the third floor, in the east wing of the main building." },
    { text: "input: How do I contact a teacher?" },
    { text: "output: You can contact your teacher via email or by visiting them during their office hours, which are posted on the classroom door." },
    { text: "input: Where is the nurse’s office?" },
    { text: "output: The nurse’s office is on the ground floor, near the main office. It's where you should go if you feel unwell during the school day." },
    { text: "input: What is the procedure for dropping off a forgotten lunch?" },
    { text: "output: Drop off forgotten lunches at the main office. They will ensure that your child receives it during lunch period." },
    { text: "input: Where can I find the principal’s office?" },
    { text: "output: The principal’s office is located in the administrative building, next to the main entrance." },
    { text: "input: What is the school’s policy on cell phone use?" },
    { text: "output: Cell phones should be turned off or on silent mode during class. They can be used during breaks and lunchtime." },
    { text: "input: Where is the computer lab?" },
    { text: "output: The computer lab is on the second floor, adjacent to the library. It’s available for student use during free periods." },
    { text: "input: How do I sign up for extracurricular activities?" },
    { text: "output: Sign up for extracurricular activities by visiting the activities coordinator’s office. You can also find information on the school’s website." },
    { text: "input: What is the school’s dress code?" },
    { text: "output: The dress code requires students to wear appropriate, non-revealing clothing. Specific guidelines are outlined in the student handbook." },
    { text: "input: Where are the restrooms located?" },
    { text: "output: Restrooms are available on every floor. They are marked with signs for easy identification." },
    { text: "input: How do I get a student ID card?" },
    { text: "output: Student ID cards are issued during the first week of school. Visit the student services office for more information." },
    { text: "input: Where is the music room?" },
    { text: "output: The music room is on the ground floor, near the auditorium. It’s where you can find the band and choir classes." },
    { text: "input: What time does school end?" },
    { text: "output: School ends at 3:00 PM. If you have after-school activities, make sure to check their specific end times." },
    { text: "input: Where can I find information about school events?" },
    { text: "output: Information about school events is posted on the school’s website and bulletin boards around the campus." },
    // { text: "input: Who is the principal?" },
    // { text: "output: Mr Yoso is the principal." }
  ];

  const result = await model.value.generateContent({
    contents: [{ role: 'user', parts }],
    generationConfig,
  });

  return result.response.text();
};

const scrollToBottom = () => {
  const container = chatContainer.value;
  container.scrollTop = container.scrollHeight;
};

const toggleHistory = () => {
  showHistory.value = !showHistory.value;
};

onMounted(() => {
  const API_KEY = import.meta.env.VITE_GEMINI_API_KEY;
  genAI.value = new GoogleGenerativeAI(API_KEY);
  model.value = genAI.value.getGenerativeModel({ model: 'gemini-1.5-pro' });
});

watch(messages, () => {
  nextTick(() => {
    scrollToBottom();
  });
});
</script>
