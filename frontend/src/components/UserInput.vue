<template>
  <div class="ai-chat">
    <h1 class="chat-title">AI School Assistant</h1>
    <div class="chat-container" ref="chatContainer">
      <div v-for="(message, index) in messages" :key="index" :class="['message', message.type]">
        <div class="message-content">{{ message.text }}</div>
      </div>
    </div>
    <div class="input-container">
      <input v-model="userInput" @keyup.enter="sendMessage" placeholder="Ask a question..." />
      <button @click="sendMessage">
        <span class="button-text">Send</span>
        <i class="fas fa-paper-plane"></i>
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
  { text: "Please ensure that your response is both accurate and concise, based on the available data. And if the user is asking a question that is not related to the school," },//If no data exists, respond with: 'There is no information available at this moment.'  respond with: 'I'm sorry, I can't answer that question.'. And also if the user continues to ask, respond with the given data.
  // { text: "input: Question" },
  // { text: "output: Answer" },
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
.ai-chat {
  max-width: 800px;
  margin: 0 auto;
  padding: 30px;
  background-color: #f0f4f8;
  border-radius: 20px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.chat-title {
  font-size: 28px;
  color: #2c3e50;
  margin-bottom: 20px;
  text-align: center;
}

.chat-container {
  height: 500px;
  overflow-y: auto;
  border: 1px solid #e0e0e0;
  padding: 20px;
  margin-bottom: 20px;
  background-color: #ffffff;
  border-radius: 15px;
  box-shadow: inset 0 2px 10px rgba(0, 0, 0, 0.05);
}

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
  background-color: #4a90e2;
  color: white;
  margin-left: auto;
  text-align: right;
}

.ai {
  background-color: #f1f1f1;
  color: #333;
  text-align: left;
}

.input-container {
  display: flex;
  background-color: #fff;
  border: 2px solid #4a90e2;
  border-radius: 10px;
  overflow: hidden;
  transition: box-shadow 0.3s ease;
}

.input-container:focus-within {
  box-shadow: 0 0 10px rgba(74, 144, 226, 0.5);
}

input {
  flex-grow: 1;
  padding: 15px;
  border: none;
  outline: none;
  font-size: 16px;
}

button {
  background-color: #4a90e2;
  color: white;
  border: none;
  padding: 0 25px;
  font-size: 16px;
  cursor: pointer;
  outline: none;
  transition: background-color 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
}

button:hover {
  background-color: #3a7bc8;
}

.button-text {
  margin-right: 8px;
}

.fas {
  font-size: 14px;
}

@media (max-width: 600px) {
  .ai-chat {
    padding: 20px;
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
