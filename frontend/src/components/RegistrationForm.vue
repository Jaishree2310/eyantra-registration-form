<template>
    <div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-md">
      <h1 class="text-3xl font-bold text-[#E31E24] mb-6">Competition Registration</h1>
      
      <!-- Loading state -->
      <div v-if="isLoading" class="py-12">
        <LoadingSpinner size="lg" text="Loading form data..." :fullScreen="false" />
      </div>
      
      <!-- API Error Message -->
      <div v-else-if="apiError" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
        <div class="flex">
          <div class="py-1">
            <svg class="h-6 w-6 text-red-500 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
          </div>
          <div>
            <p>{{ apiError }}</p>
            <button 
              @click="fetchReferenceData" 
              class="mt-2 text-[#E31E24] font-semibold hover:underline"
            >
              Retry
            </button>
          </div>
        </div>
      </div>
      
      <form v-else @submit.prevent="submitForm" class="space-y-6">
        <!-- Name Field -->
        <FormField 
          label="Full Name" 
          :error="v$.name.$errors.length > 0 ? v$.name.$errors[0].$message : ''"
        >
          <input
            v-model="form.name"
            type="text"
            class="form-input"
            :class="{ 'border-red-500': v$.name.$error }"
            @blur="v$.name.$touch()"
          />
        </FormField>
  
        <!-- Email Field -->
        <FormField 
          label="Email ID" 
          :error="v$.email.$errors.length > 0 ? v$.email.$errors[0].$message : ''"
        >
          <div class="flex gap-2 items-start">
            <div class="flex-grow">
              <input
                v-model="form.email"
                type="email"
                class="form-input"
                :class="{ 'border-red-500': v$.email.$error }"
                @blur="v$.email.$touch()"
              />
            </div>
            <button
              @click="sendVerificationEmail"
              class="px-2 py-2 bg-[#E31E24] text-white rounded hover:bg-red-700 transition-colors"
              :disabled="!form.email || v$.email.$error || emailVerified"
            >
              {{ emailVerified ? 'Verified' : 'Verify' }}
            </button>
          </div>
        </FormField>
  
        <!-- Contact Number Field -->
        <FormField 
          label="Contact Number" 
          :error="v$.contactNumber.$errors.length > 0 ? v$.contactNumber.$errors[0].$message : ''"
        >
          <input
            v-model="form.contactNumber"
            type="tel"
            class="form-input"
            :class="{ 'border-red-500': v$.contactNumber.$error }"
            @blur="v$.contactNumber.$touch()"
          />
        </FormField>
  
        <!-- Gender Field -->
        <FormField 
          label="Gender" 
          :error="v$.gender.$errors.length > 0 ? v$.gender.$errors[0].$message : ''"
        >
          <div class="flex gap-4">
            <label class="inline-flex items-center">
              <input
                v-model="form.gender"
                type="radio"
                value="male"
                class="form-radio"
                @blur="v$.gender.$touch()"
              />
              <span class="ml-2">Male</span>
            </label>
            <label class="inline-flex items-center">
              <input
                v-model="form.gender"
                type="radio"
                value="female"
                class="form-radio"
                @blur="v$.gender.$touch()"
              />
              <span class="ml-2">Female</span>
            </label>
            <label class="inline-flex items-center">
              <input
                v-model="form.gender"
                type="radio"
                value="other"
                class="form-radio"
                @blur="v$.gender.$touch()"
              />
              <span class="ml-2">Other</span>
            </label>
          </div>
        </FormField>
  
        <!-- Country Field -->
        <FormField 
          label="Country" 
          :error="v$.country.$errors.length > 0 ? v$.country.$errors[0].$message : ''"
        >
          <select
            v-model="form.country"
            class="form-select"
            :class="{ 'border-red-500': v$.country.$error }"
            @blur="v$.country.$touch()"
          >
            <option value="" disabled>Select your country</option>
            <option v-for="country in countries" :key="country.id" :value="country.id">
              {{ country.name }}
            </option>
          </select>
        </FormField>
  
        <!-- College Field -->
        <FormField 
          label="College" 
          :error="v$.college.$errors.length > 0 ? v$.college.$errors[0].$message : ''"
        >
          <select
            v-model="form.college"
            class="form-select"
            :class="{ 'border-red-500': v$.college.$error }"
            @blur="v$.college.$touch()"
          >
            <option value="" disabled>Select your college</option>
            <option v-for="college in colleges" :key="college.id" :value="college.id">
              {{ college.name }}
            </option>
          </select>
        </FormField>
  
        <!-- Year Field -->
        <FormField 
          label="Year" 
          :error="v$.year.$errors.length > 0 ? v$.year.$errors[0].$message : ''"
        >
          <select
            v-model="form.year"
            class="form-select"
            :class="{ 'border-red-500': v$.year.$error }"
            @blur="v$.year.$touch()"
          >
            <option value="" disabled>Select your year</option>
            <option value="1">1st Year</option>
            <option value="2">2nd Year</option>
            <option value="3">3rd Year</option>
            <option value="4">4th Year</option>
            <option value="5">5th Year</option>
          </select>
        </FormField>
  
        <!-- Department Field -->
        <FormField 
          label="Domain / Department" 
          :error="v$.department.$errors.length > 0 ? v$.department.$errors[0].$message : ''"
        >
          <select
            v-model="form.department"
            class="form-select"
            :class="{ 'border-red-500': v$.department.$error }"
            @blur="v$.department.$touch()"
          >
            <option value="" disabled>Select your department</option>
            <option v-for="dept in departments" :key="dept.id" :value="dept.id">
              {{ dept.name }}
            </option>
          </select>
        </FormField>
  
        <!-- Submit Button -->
        <div class="flex justify-center pt-4">
          <button
            type="submit"
            class="px-6 py-3 bg-[#E31E24] text-white font-bold rounded hover:bg-red-700 transition-colors flex items-center justify-center min-w-[120px]"
            :disabled="isSubmitting || !emailVerified"
          >
            <LoadingSpinner v-if="isSubmitting" size="sm" color="white" class="mr-2" />
            <span>{{ isSubmitting ? 'Registering...' : 'Register' }}</span>
          </button>
        </div>
      </form>
  
      <!-- Registration Success Modal -->
      <transition name="fade">
        <div v-if="showSuccessModal" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
          <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full text-center">
            <div class="text-[#E31E24] text-6xl mb-4">
              <i class="fas fa-check-circle"></i>
            </div>
            <h2 class="text-2xl font-bold mb-2">Registration Successful!</h2>
            <p class="mb-6">Thank you for registering for the competition. We'll contact you soon with further details.</p>
            <button 
              @click="closeSuccessModal" 
              class="px-6 py-2 bg-[#E31E24] text-white rounded hover:bg-red-700 transition-colors"
            >
              Close
            </button>
          </div>
        </div>
      </transition>
    </div>
  </template>
  
  <script>
  import { reactive, ref, computed, onMounted } from 'vue';
  import { useVuelidate } from '@vuelidate/core';
  import { required, email, helpers, minLength } from '@vuelidate/validators';
  import FormField from './FormField.vue';
  import LoadingSpinner from './LoadingSpinner.vue';
  import apiService from '../services/api';
  
  export default {
    name: 'RegistrationForm',
    components: {
      FormField,
      LoadingSpinner
    },
    setup() {
      const isSubmitting = ref(false);
      const showSuccessModal = ref(false);
      const emailVerified = ref(false);
      const isLoading = ref(true);
      const apiError = ref('');
      const verificationSent = ref(false);
      
      // Reference data for dropdowns
      const countries = ref([]);
      const colleges = ref([]);
      const departments = ref([]);
  
      const form = reactive({
        name: '',
        email: '',
        contactNumber: '',
        gender: '',
        country: '',
        college: '',
        year: '',
        department: ''
      });
  
      // Custom validators
      const nameValidator = helpers.regex(/^[A-Za-z\s]+$/);
      const phoneValidator = helpers.regex(/^\+?[0-9]{10,15}$/);
  
      // Validation rules
      const rules = computed(() => {
        return {
          name: { 
            required: helpers.withMessage('Name is required', required),
            nameFormat: helpers.withMessage('Name can only contain letters and spaces', nameValidator),
            minLength: helpers.withMessage('Name must be at least 3 characters', minLength(3))
          },
          email: { 
            required: helpers.withMessage('Email is required', required),
            email: helpers.withMessage('Please enter a valid email address', email)
          },
          contactNumber: { 
            required: helpers.withMessage('Contact number is required', required),
            phoneFormat: helpers.withMessage('Please enter a valid phone number (10-15 digits)', phoneValidator)
          },
          gender: { 
            required: helpers.withMessage('Please select your gender', required)
          },
          country: { 
            required: helpers.withMessage('Please select your country', required)
          },
          college: { 
            required: helpers.withMessage('Please select your college', required)
          },
          year: { 
            required: helpers.withMessage('Please select your year', required)
          },
          department: { 
            required: helpers.withMessage('Please select your department', required)
          }
        }
      });
  
      const v$ = useVuelidate(rules, form);
  
      // Fetch reference data from API
      const fetchReferenceData = async () => {
        isLoading.value = true;
        apiError.value = '';
        
        try {
          const [countriesResponse, collegesResponse, departmentsResponse] = await Promise.all([
            apiService.referenceData.getCountries(),
            apiService.referenceData.getColleges(),
            apiService.referenceData.getDepartments()
          ]);
          
          countries.value = countriesResponse.data;
          colleges.value = collegesResponse.data;
          departments.value = departmentsResponse.data;
        } catch (error) {
          console.error('Failed to fetch reference data', error);
          apiError.value = 'Unable to load form data. Please refresh the page.';
        } finally {
          isLoading.value = false;
        }
      };
      
      // Load data on component mount
      onMounted(() => {
        fetchReferenceData();
      });
  
      // Email verification through API
      const sendVerificationEmail = async () => {
        if (form.email && !v$.value.email.$error) {
          verificationSent.value = true;
          
          try {
            await apiService.registration.verifyEmail(form.email);
            emailVerified.value = true;
          } catch (error) {
            console.error('Email verification failed', error);
            if (error.response?.data?.message) {
              // Show specific error message from backend
              apiError.value = error.response.data.message;
            } else {
              apiError.value = 'Email verification failed. Please try again.';
            }
          } finally {
            verificationSent.value = false;
          }
        }
      };
  
      const submitForm = async () => {
        const isFormValid = await v$.value.$validate();
        apiError.value = '';
        
        if (isFormValid && emailVerified.value) {
          isSubmitting.value = true;
          
          try {
            await apiService.registration.submit(form);
            isSubmitting.value = false;
            showSuccessModal.value = true;
          } catch (error) {
            console.error('Registration failed', error);
            
            if (error.response?.data?.errors) {
              // Handle validation errors from backend
              const serverErrors = error.response.data.errors;
              Object.keys(serverErrors).forEach(field => {
                if (v$.value[field]) {
                  v$.value[field].$errors.push({
                    $message: serverErrors[field][0]
                  });
                }
              });
            } else if (error.response?.data?.message) {
              apiError.value = error.response.data.message;
            } else {
              apiError.value = 'Registration failed. Please try again.';
            }
            
            isSubmitting.value = false;
          }
        }
      };
  
      const closeSuccessModal = () => {
        showSuccessModal.value = false;
        // Reset form after successful submission
        Object.keys(form).forEach(key => form[key] = '');
        v$.value.$reset();
        emailVerified.value = false;
      };
  
      return {
        form,
        v$,
        isSubmitting,
        showSuccessModal,
        emailVerified,
        countries,
        colleges,
        departments,
        submitForm,
        sendVerificationEmail,
        closeSuccessModal,
        isLoading,
        apiError,
        verificationSent,
        fetchReferenceData
      };
    }
  }
  </script>
  
  <style scoped>
  .form-input,
  .form-select {
    width: 100%;
    padding: 0.5rem 1rem;
    border: 1px solid #d1d5db;
    border-radius: 0.25rem;
  }
  
  .form-input:focus,
  .form-select:focus {
    outline: none;
    --tw-ring-color: #E31E24;
    --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color);
    --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(2px + var(--tw-ring-offset-width)) var(--tw-ring-color);
    box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow, 0 0 #0000);
    border-color: transparent;
  }
  
  .form-radio {
    color: #E31E24;
  }
  
  .form-radio:focus {
    --tw-ring-color: #E31E24;
  }
  
  .fade-enter-active,
  .fade-leave-active {
    transition: opacity 0.3s;
  }
  
  .fade-enter-from,
  .fade-leave-to {
    opacity: 0;
  }
  </style>