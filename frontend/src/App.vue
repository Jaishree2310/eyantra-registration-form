<template>
    <div class="min-h-screen bg-gray-50">
      <Header />
      <main class="container mx-auto py-8 px-4">
        <RegistrationForm />
      </main>
      <Footer />
    </div>
  </template>
  
  <script>
  import Header from './components/Header.vue';
  import RegistrationForm from './components/RegistrationForm.vue';
  import Footer from './components/Footer.vue';
  
  export default {
    name: 'App',
    components: {
      RegistrationForm,
    }
  }
  </script>