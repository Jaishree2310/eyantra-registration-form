<!-- src/components/LoadingSpinner.vue -->
<template>
  <div 
    v-if="show"
    :class="[
      fullScreen ? 'fixed inset-0 flex items-center justify-center bg-white bg-opacity-75 z-50' : '',
      !fullScreen && centered ? 'flex justify-center' : ''
    ]"
  >
    <div class="flex flex-col items-center">
      <!-- Spinner SVG -->
      <svg 
        :class="[
          'animate-spin',
          sizeClasses,
          color === 'primary' ? 'text-[#E31E24]' : 
          color === 'accent' ? 'text-[#F7D154]' : 
          color === 'white' ? 'text-white' : 'text-gray-500'
        ]"
        xmlns="http://www.w3.org/2000/svg" 
        fill="none" 
        viewBox="0 0 24 24"
      >
        <circle 
          class="opacity-25" 
          cx="12" 
          cy="12" 
          r="10" 
          stroke="currentColor" 
          stroke-width="4"
        ></circle>
        <path 
          class="opacity-75" 
          fill="currentColor" 
          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
        ></path>
      </svg>
      
      <!-- Optional loading text -->
      <span 
        v-if="text" 
        class="mt-2 font-opensans text-sm font-medium text-[#333333]"
      >
        {{ text }}
      </span>
    </div>
  </div>
</template>

<script>
export default {
  name: 'LoadingSpinner',
  props: {
    size: {
      type: String,
      default: 'md',
      validator: value => ['sm', 'md', 'lg', 'xl'].includes(value)
    },
    color: {
      type: String,
      default: 'primary',
      validator: value => ['primary', 'accent', 'white', 'gray'].includes(value)
    },
    text: {
      type: String,
      default: ''
    },
    fullScreen: {
      type: Boolean,
      default: false
    },
    centered: {
      type: Boolean,
      default: true
    },
    show: {
      type: Boolean,
      default: true
    }
  },
  computed: {
    sizeClasses() {
      switch(this.size) {
        case 'sm': return 'h-4 w-4';
        case 'md': return 'h-6 w-6';
        case 'lg': return 'h-8 w-8';
        case 'xl': return 'h-12 w-12';
        default: return 'h-6 w-6';
      }
    }
  }
}
</script>