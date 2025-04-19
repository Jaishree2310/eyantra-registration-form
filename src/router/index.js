import { createRouter, createWebHistory } from 'vue-router';
import Registration from '../components/RegistrationForm.vue';

const routes = [
  { path: '/', name: 'Registration', component: Registration },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
