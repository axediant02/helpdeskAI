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
  text: `You are an AI assistant for Consolatrix. Answer the question precisely and accurately base on the given data. If the user ask a question that the answer is Yes or No, then answer Yes or No, and give a little information. Remember the context of the conversation in case for chain conversation. If the question is not related to the data, say "I can't help with that question .The scope of this system is limited to Consolatrix. Please ask a question related to Consolatrix."`
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
    {text: "Answer the question precisely and accurately."},
    { text: `Student: ${question}` },
    { text: 'Assistant: ' },
    { text: "input: Question" },
    { text: "output: Answer" },
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
    { text: "input: How can i borrow a book from the library?" },
    { text: "output: You can borrow a book from the library by visiting the library and asking the librarian. They will help you find the book you need and check it out to you." },
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