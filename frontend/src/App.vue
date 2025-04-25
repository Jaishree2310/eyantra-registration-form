<!-- src/App.vue -->
<template>
  <div class="min-h-screen bg-gray-50 flex flex-col">
    <Header />
    <main class="flex-grow container mx-auto py-12 px-4">
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
    Header,
    RegistrationForm,
    Footer
  }
}
</script>