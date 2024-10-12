import { createRouter, createWebHistory } from 'vue-router'
import Home from '@/pages/Home.vue'
import About from '@/components/About.vue'
import Faq from '@/components/Faq.vue'
import Contact from '@/components/Contact.vue'
import Help from '@/components/Help.vue'
import AdminCMS from '@/pages/AdminCMS.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/about',
      name: 'about',
      component: About
    },
    {
      path: '/faq',
      name: 'faq',
      component: Faq
    },
    {
      path: '/contact',
      name: 'contact',
      component: Contact
    },
    {
      path: '/help',
      name: 'help',
      component: Help
    },
    {
      path: '/admin',
      name: 'admin',
      component: AdminCMS
    },
  ]
})

export default router
