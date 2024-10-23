<template>
  <div class="min-h-screen bg-gray-100 flex items-center justify-center p-4">
    <div class="w-full max-w-2xl bg-white rounded-xl shadow-xl overflow-hidden">
      <div class="p-6 bg-gradient-to-r from-blue-600 to-blue-800">
        <h1 class="text-2xl md:text-3xl font-bold text-white text-center">Help Desk System</h1>
        <div class="flex justify-center mt-2">
          <span class="text-sm text-blue-100">
            <span class="inline-block w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></span>
            Conversation Mode Active
          </span>
        </div>
      </div>
      <div class="p-6">
        <div ref="chatContainer" class="h-[400px] overflow-y-auto mb-6 space-y-4">
          <template v-if="messages.length">
            <div
              v-for="(message, index) in messages"
              :key="index"
              :class="[
                'max-w-[80%] p-3 rounded-lg transition-all duration-300',
                message.type === 'user' ? 'ml-auto bg-blue-500 text-white' : 'bg-gray-100 text-gray-800',
                {'opacity-50': isLoading && index === messages.length - 1}
              ]"
            >
              <div class="flex items-center space-x-2 mb-1">
                <span class="text-sm font-medium">{{ message.type === 'user' ? 'You' : 'AI Assistant' }}</span>
                <span v-if="message.type === 'ai'" class="text-xs text-gray-500">
                  {{ getTimestamp(message.timestamp) }}
                </span>
              </div>
              <div class="text-sm">{{ message.text }}</div>
            </div>
          </template>
          <div v-else class="text-center text-gray-500">
            <MessageSquare class="w-16 h-16 mx-auto mb-4 text-gray-400" />
            <p class="text-lg font-medium">No messages yet</p>
            <p class="text-sm">Start a conversation by asking a question!</p>
          </div>
        </div>
        <div class="flex items-center space-x-2">
          <input
            v-model="userInput"
            @keyup.enter="sendMessage"
            placeholder="Continue the conversation..."
            class="flex-grow px-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200 ease-in-out"
            :disabled="isLoading"
          />
          <button
            @click="sendMessage"
            class="bg-blue-500 text-white p-2 rounded-full hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors duration-200"
            :disabled="isLoading"
          >
            <Send v-if="!isLoading" class="w-5 h-5" />
            <Loader v-else class="w-5 h-5 animate-spin" />
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, nextTick, watch } from 'vue';
import { GoogleGenerativeAI } from '@google/generative-ai';
// import { Send, Loader, MessageSquare } from 'lucide-vue-next';
import { Send, Loader, MessageSquare } from 'lucide-vue-next'; 

const genAI = ref(null);
const model = ref(null);
const userInput = ref('');
const messages = ref([]);
const chatContainer = ref(null);
const isLoading = ref(false);
const conversationHistory = ref([]);

const generationConfig = {
  temperature: 0.7,
  topP: 0.8,
  topK: 40,
  maxOutputTokens: 1024,
};

const systemPrompt = {
  text: `You are a virtual assistant for Consolatrix College of Toledo City (CCTC), responsible for answering questions from students using up-to-date school information. You have access to details like building locations, department contacts, event schedules, and FAQs, all provided by the school's administrators.Clarity & Accuracy: Ensure that your responses are clear, concise, and based on the most recent data. Always reference the latest information to ensure accuracy.Handling Unclear Queries: If a student’s question is vague or incomplete, kindly request more details to provide an accurate answer. For example: "Could you clarify which building or service you're referring to?"Unavailable Information: If you can't find the requested information in the provided data, politely inform the student: "This information is currently unavailable. Please check with the school office for further assistance."Out-of-Scope Questions: For questions unrelated to Consolatrix College, respond with: "I'm here to help with questions about Consolatrix College. It seems your query is outside my scope. Please contact the school office or check the website for more info. Let me know if you have any other questions!"Tone and Response Format: Maintain a friendly, professional, and approachable tone in all responses. Keep answers brief and simple, especially for students unfamiliar with school procedures. Example: "The library is located in the South Building, next to the cafeteria. It’s open from 8 AM to 5 PM, Monday to Friday."Missing or Outdated Data: If data is outdated or missing, inform the student politely: "I'm sorry, the information you're looking for is not available at the moment. Please contact the school office for assistance, or check back later after we've updated our system.",`
  };

const formatConversationHistory = () => {
  return messages.value.slice(-6).map(msg => ({
    text: `${msg.type === 'user' ? 'Student' : 'Assistant'}: ${msg.text}`
  }));
};

const getTimestamp = (timestamp) => {
  if (!timestamp) return '';
  const now = new Date();
  const msgTime = new Date(timestamp);
  
  if (now.toDateString() === msgTime.toDateString()) {
    return msgTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
  }
  return msgTime.toLocaleDateString();
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
  }

  nextTick(() => {
    scrollToBottom();
  });
};

const generateAnswer = async (question) => {

  const history = formatConversationHistory();
  
  const parts = [
    systemPrompt,
    ...history,
    { text: `Student: ${question}` },
    { text: 'Assistant: ' },
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