<!-- src/components/ApiErrorMessage.vue -->
<template>
    <div v-if="show" class="bg-red-50 border-l-4 border-[#E31E24] p-6 rounded mb-6">
      <div class="flex">
        <div class="flex-shrink-0">
          <svg class="h-6 w-6 text-[#E31E24]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
          </svg>
        </div>
        <div class="ml-4">
          <h3 class="font-montserrat font-bold text-lg text-[#E31E24]">{{ title }}</h3>
          <p class="font-opensans mt-1">{{ message }}</p>
          <button v-if="showRetry" @click="$emit('retry')" 
            class="mt-4 inline-flex items-center font-montserrat font-semibold text-[#E31E24] hover:underline">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
            Retry
          </button>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'ApiErrorMessage',
    props: {
      show: {
        type: Boolean,
        default: true
      },
      title: {
        type: String,
        default: 'Something went wrong'
      },
      message: {
        type: String,
        required: true
      },
      showRetry: {
        type: Boolean,
        default: false
      }
    },
    emits: ['retry']
  }
  </script>