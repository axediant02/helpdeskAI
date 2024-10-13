<template>
  <div class="ai-chat max-w-3xl mx-auto p-8 bg-gray-100 rounded-2xl shadow-md">
    <h1 class="chat-title text-2xl text-gray-800 mb-5 text-center">AI School Assistant</h1>
    <div class="chat-container h-[500px] overflow-y-auto border border-gray-300 p-5 mb-5 bg-white rounded-lg shadow-inner" ref="chatContainer">
      <div v-for="(message, index) in messages" :key="index" :class="['message', message.type]">
        <div class="message-content p-2">{{ message.text }}</div>
      </div>
    </div>
    <div class="input-container flex bg-white border-2 border-blue-500 rounded-lg overflow-hidden transition-shadow duration-300 ease-in-out focus-within:shadow-lg">
      <input v-model="userInput" @keyup.enter="sendMessage" placeholder="Ask a question..." class="flex-grow p-4 border-none outline-none text-lg" />
      <button @click="sendMessage" class="bg-blue-500 text-white border-none py-2 px-6 text-lg cursor-pointer transition-colors duration-300 ease-in-out flex items-center justify-center hover:bg-blue-600">
        <span class="button-text mr-2">Send</span>
        <i class="fas fa-paper-plane text-base"></i>
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, nextTick } from 'vue';
import { GoogleGenerativeAI } from '@google/generative-ai';

const genAI = ref(null);
const model = ref(null);
const userInput = ref('');
const messages = ref([]);
const chatContainer = ref(null);

const generationConfig = {
  temperature: 1,
  topP: 0.95,
  topK: 64,
  maxOutputTokens: 8192,
};

const presetQuestions = [
  { text: "Please ensure that your response is both accurate and concise, based on the available data. And if the user is asking a question that is not related to the school," },
  { text: "input: Where is the library located?" },
  { text: "output: The library is located on the second floor of the main building, near the science labs." },
];

onMounted(() => {
  const API_KEY = import.meta.env.VITE_GEMINI_API_KEY;
  genAI.value = new GoogleGenerativeAI(API_KEY);
  model.value = genAI.value.getGenerativeModel({ model: 'gemini-1.5-flash' });
});

const sendMessage = async () => {
  if (!userInput.value.trim()) return;

  messages.value.push({ type: 'user', text: userInput.value });
  const question = userInput.value;
  userInput.value = '';

  try {
    const answer = await generateAnswer(question);
    messages.value.push({ type: 'ai', text: answer });
  } catch (error) {
    console.error('Error generating answer:', error);
    messages.value.push({ type: 'ai', text: 'Sorry, there was an error generating the answer.' });
  }

  nextTick(() => {
    scrollToBottom();
  });
};

const generateAnswer = async (question) => {
  const parts = [
    ...presetQuestions,
    { text: `input: ${question}` },
    { text: 'output: ' },
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
</script>

<style scoped>
.message {
  margin-bottom: 20px;
  padding: 12px 18px;
  border-radius: 18px;
  font-size: 16px;
  line-height: 1.5;
  word-wrap: break-word;
  max-width: 85%;
}

.message-content {
  padding: 8px;
}

.user {
  @apply bg-blue-500 text-white ml-auto text-right;
}

.ai {
  @apply bg-gray-200 text-gray-800 text-left;
}

@media (max-width: 600px) {
  .ai-chat {
    @apply p-5;
  }

  .chat-container {
    height: 400px;
  }

  .message {
    font-size: 14px;
  }

  input, button {
    font-size: 14px;
  }
}
</style>
