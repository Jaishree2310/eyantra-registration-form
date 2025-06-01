<template>
    <header class="bg-white shadow">
      <div class="container mx-auto px-4 py-3 flex flex-col md:flex-row items-center justify-between">
        <div class="flex items-center mb-4 md:mb-0">
          <a href="/" class="flex items-center">
            <img 
              src="https://www.e-yantra.org/images/home/logo.svg" 
              alt="e-Yantra logo" 
              class="h-12"
            />
            <div class="ml-3 flex flex-col">
              <span class="font-montserrat font-bold text-xl text-[#333333]">e-Yantra</span>
              <span class="font-opensans text-xs text-[#333333]">Engineering a better tomorrow</span>
            </div>
          </a>
        </div>
        
        <nav class="flex flex-wrap items-center justify-center md:justify-end gap-4">
          <a href="#" class="font-montserrat text-[#333333] hover:text-[#E31E24] transition-colors">Home</a>
          <a href="#" class="font-montserrat text-[#333333] hover:text-[#E31E24] transition-colors">About</a>
          <a href="#" class="font-montserrat text-[#333333] hover:text-[#E31E24] transition-colors">Competitions</a>
          <a href="#" class="font-montserrat text-[#333333] hover:text-[#E31E24] transition-colors">Resources</a>
          <a href="#" class="btn-primary">Register Now</a>
        </nav>
      </div>
    </header>
  </template>
  
  <script>
  export default {
    name: 'Header'
  }
  </script>