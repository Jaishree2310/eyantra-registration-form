<template>
    <footer class="bg-[#333333] text-white py-8">
      <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-center mb-8">
          <div class="flex items-center mb-6 md:mb-0">
            <img 
              src="https://www.e-yantra.org/images/home/logo.svg" 
              alt="e-Yantra logo" 
              class="h-10 bg-white p-1 rounded"
            />
            <div class="ml-3 flex flex-col">
              <span class="font-montserrat font-bold text-lg">e-Yantra</span>
              <span class="font-opensans text-xs">Engineering a better tomorrow</span>
            </div>
          </div>
          
          <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            <div>
              <h3 class="font-montserrat font-bold mb-3 text-[#F7D154]">About</h3>
              <ul class="space-y-2">
                <li><a href="#" class="hover:text-[#F7D154] transition-colors">Mission</a></li>
                <li><a href="#" class="hover:text-[#F7D154] transition-colors">Team</a></li>
                <li><a href="#" class="hover:text-[#F7D154] transition-colors">Partners</a></li>
              </ul>
            </div>
            <div>
              <h3 class="font-montserrat font-bold mb-3 text-[#F7D154]">Programs</h3>
              <ul class="space-y-2">
                <li><a href="#" class="hover:text-[#F7D154] transition-colors">Competitions</a></li>
                <li><a href="#" class="hover:text-[#F7D154] transition-colors">Internships</a></li>
                <li><a href="#" class="hover:text-[#F7D154] transition-colors">Labs</a></li>
              </ul>
            </div>
            <div>
              <h3 class="font-montserrat font-bold mb-3 text-[#F7D154]">Resources</h3>
              <ul class="space-y-2">
                <li><a href="#" class="hover:text-[#F7D154] transition-colors">Tutorials</a></li>
                <li><a href="#" class="hover:text-[#F7D154] transition-colors">Documentation</a></li>
                <li><a href="#" class="hover:text-[#F7D154] transition-colors">FAQ</a></li>
              </ul>
            </div>
            <div>
              <h3 class="font-montserrat font-bold mb-3 text-[#F7D154]">Connect</h3>
              <div class="flex space-x-3">
                <a href="#" class="text-white hover:text-[#F7D154] transition-colors">
                  <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="text-white hover:text-[#F7D154] transition-colors">
                  <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="text-white hover:text-[#F7D154] transition-colors">
                  <i class="fab fa-linkedin-in"></i>
                </a>
                <a href="#" class="text-white hover:text-[#F7D154] transition-colors">
                  <i class="fab fa-youtube"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="border-t border-gray-700 pt-6 text-center text-sm">
          <p>© 2025. e-Yantra. All rights reserved.</p>
          <p class="mt-2">A robotics outreach program funded by the Ministry of Education and hosted at IIT Bombay</p>
        </div>
      </div>
    </footer>
  </template>
  
  <script>
  export default {
    name: 'Footer'
  }
  </script>