<!-- src/components/FormField.vue -->
<template>
  <div class="mb-6">
    <label class="block font-montserrat font-bold text-[#333333] mb-2">
      {{ label }}
      <span v-if="required" class="text-[#E31E24]">*</span>
    </label>
    <slot></slot>
    <p 
      v-if="error" 
      class="mt-1 text-sm font-opensans text-[#E31E24] flex items-center"
    >
      <i class="fas fa-exclamation-circle mr-1"></i>
      {{ error }}
    </p>
    <p 
      v-if="helpText" 
      class="mt-1 text-sm font-opensans text-gray-500"
    >
      {{ helpText }}
    </p>
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
    },
    helpText: {
      type: String,
      default: ''
    }
  }
}
</script>