import { createRouter, createWebHistory } from 'vue-router';
import Home from '@/pages/Home.vue';
import About from '@/components/About.vue';
import Contact from '@/components/Contact.vue';
import Help from '@/components/Help.vue';
import AdminPanel from '@/pages/AdminPanel.vue';
import LoginPage from '@/pages/LoginPage.vue';
import SignupPage from '@/pages/SignupPage.vue';
import Profile from '@/pages/Profile.vue';
// import { useAuthStore } from '@/store/store';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home,
    },
    {
      path: '/about',
      name: 'about',
      component: About,
    },
    {
      path: '/contact',
      name: 'contact',
      component: Contact,
    },
    {
      path: '/help',
      name: 'help',
      component: Help,
    },
    {
      path: '/admin',
      name: 'admin',
      component: AdminPanel,
      // meta: { requiresAuth: true, adminOnly: true },
    },
    {
      path: '/login',
      name: 'login',
      component: LoginPage,
    },
    {
      path: '/signup',
      name: 'signup',
      component: SignupPage,
    },
    {
      path: '/profile',
      name: 'profile',
      component: Profile,
    },
  ],
});

// router.beforeEach((to, from, next) => {
//   const authStore = useAuthStore();
//   const { isAuthenticated, user } = authStore;

//   if (to.matched.some(record => record.meta.requiresAuth)) {
//     if (!isAuthenticated) {
//       next({ name: 'login' });
//     } else if (to.matched.some(record => record.meta.adminOnly)) {
//       if (user && user.role === 'admin') {
//         next();
//       } else {
//         next({ name: 'Unauthorized' });
//       }
//     } else {
//       next(); 
//     }
//   } else {
//     next();
//   }
// });

export default router;
