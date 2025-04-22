<template>
    <div class="mb-4">
      <label class="block text-[#333333] font-bold mb-2">
        {{ label }}
        <span v-if="required" class="text-[#E31E24]">*</span>
      </label>
      <slot></slot>
      <p v-if="error" class="mt-1 text-sm text-[#E31E24]">{{ error }}</p>
    </div>
  </template>
  
  <script>
  export default {
    name: 'FormField',
    props: {
      label: {
        type: String,
        required: true
      },
      error: {
        type: String,
        default: ''
      },
      required: {
        type: Boolean,
        default: true
      }
    }
  }
  </script>