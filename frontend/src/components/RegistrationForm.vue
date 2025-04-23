<!-- src/components/RegistrationForm.vue -->
<template>
  <div class="max-w-3xl mx-auto">
    <!-- Page Title -->
    <div class="text-center mb-10">
      <h1 class="text-4xl font-bold text-[#333333] mb-3">Competition Registration</h1>
      <p class="text-xl font-opensans text-gray-600 max-w-2xl mx-auto">
        Join the e-Yantra robotics competition and start your journey in
        <span class="text-[#E31E24] font-semibold">Engineering a better tomorrow</span>
      </p>
    </div>

    <!-- Form Card -->
    <div class="card">
      <!-- Loading state -->
      <div v-if="isLoading" class="py-12 flex flex-col items-center">
        <LoadingSpinner :show="isLoading" size="lg" color="primary" text="Loading form data..." :fullScreen="false" />
        <p class="mt-4 text-gray-600 font-opensans">Please wait while we prepare your registration form...</p>
      </div>

      <!-- API Error Message -->
      <div v-else-if="apiError" class="bg-red-50 border-l-4 border-[#E31E24] p-6 rounded mb-6">
        <div class="flex">
          <div class="flex-shrink-0">
            <svg class="h-6 w-6 text-[#E31E24]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
          </div>
          <div class="ml-4">
            <h3 class="font-montserrat font-bold text-lg text-[#E31E24]">Something went wrong</h3>
            <p class="font-opensans mt-1">{{ apiError }}</p>
            <button @click="fetchReferenceData" 
              class="mt-4 inline-flex items-center font-montserrat font-semibold text-[#E31E24] hover:underline">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
              </svg>
              Retry
            </button>
          </div>
        </div>
      </div>

      <form v-else @submit.prevent="submitForm" class="space-y-6">
        <div class="border-b border-gray-200 pb-6 mb-6">
          <h2 class="text-2xl font-montserrat font-bold text-[#333333] mb-4">Personal Information</h2>
          
          <!-- Name Field -->
          <FormField 
            label="Full Name" 
            :error="v$.name.$errors.length > 0 ? v$.name.$errors[0].$message : ''"
            helpText="Enter your name as it appears on official documents"
          >
            <input 
              v-model="form.name" 
              type="text" 
              class="form-input" 
              :class="{ 'error': v$.name.$error }"
              placeholder="John Doe"
              @blur="v$.name.$touch()" 
            />
          </FormField>

          <!-- Email Field -->
          <FormField 
            label="Email ID" 
            :error="v$.email.$errors.length > 0 ? v$.email.$errors[0].$message : ''"
            helpText="We'll send confirmation and updates to this email"
          >
            <input 
              v-model="form.email" 
              type="email" 
              class="form-input" 
              :class="{ 'error': v$.email.$error }"
              placeholder="you@example.com"
              @blur="v$.email.$touch()" 
            />
          </FormField>

          <!-- Contact Number Field -->
          <FormField 
            label="Contact Number"
            :error="v$.contactNumber.$errors.length > 0 ? v$.contactNumber.$errors[0].$message : ''"
            helpText="Include country code if applicable"
          >
            <input 
              v-model="form.contactNumber" 
              type="tel" 
              class="form-input"
              :class="{ 'error': v$.contactNumber.$error }" 
              placeholder="+91 9876543210"
              @blur="v$.contactNumber.$touch()" 
            />
          </FormField>

          <!-- Gender Field -->
          <FormField 
            label="Gender" 
            :error="v$.gender.$errors.length > 0 ? v$.gender.$errors[0].$message : ''"
          >
            <div class="flex gap-6">
              <label class="inline-flex items-center">
                <input v-model="form.gender" type="radio" value="male" class="form-radio" @blur="v$.gender.$touch()" />
                <span class="ml-2 font-opensans">Male</span>
              </label>
              <label class="inline-flex items-center">
                <input v-model="form.gender" type="radio" value="female" class="form-radio" @blur="v$.gender.$touch()" />
                <span class="ml-2 font-opensans">Female</span>
              </label>
              <label class="inline-flex items-center">
                <input v-model="form.gender" type="radio" value="other" class="form-radio" @blur="v$.gender.$touch()" />
                <span class="ml-2 font-opensans">Other</span>
              </label>
            </div>
          </FormField>
        </div>

        <div class="border-b border-gray-200 pb-6 mb-6">
          <h2 class="text-2xl font-montserrat font-bold text-[#333333] mb-4">Academic Information</h2>

          <!-- Country Field -->
          <FormField 
            label="Country" 
            :error="v$.country.$errors.length > 0 ? v$.country.$errors[0].$message : ''"
          >
            <select 
              v-model="form.country" 
              class="form-select" 
              :class="{ 'error': v$.country.$error }"
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
              :class="{ 'error': v$.college.$error }"
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
            label="Year of Study" 
            :error="v$.year.$errors.length > 0 ? v$.year.$errors[0].$message : ''"
          >
            <select 
              v-model="form.year" 
              class="form-select" 
              :class="{ 'error': v$.year.$error }"
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
              :class="{ 'error': v$.department.$error }"
              @blur="v$.department.$touch()"
            >
              <option value="" disabled>Select your department</option>
              <option v-for="dept in departments" :key="dept.id" :value="dept.id">
                {{ dept.name }}
              </option>
            </select>
          </FormField>
        </div>

        <!-- Terms and Conditions -->
        <FormField 
          label="Terms and Conditions"
          :error="v$.termsAccepted.$errors.length > 0 ? v$.termsAccepted.$errors[0].$message : ''"
        >
          <label class="inline-flex items-center">
            <input 
              v-model="form.termsAccepted" 
              type="checkbox" 
              class="form-checkbox" 
              @blur="v$.termsAccepted.$touch()"
            />
            <span class="ml-2 font-opensans">
              I agree to the 
              <a href="#" class="text-[#E31E24] hover:underline">Terms and Conditions</a> 
              and 
              <a href="#" class="text-[#E31E24] hover:underline">Privacy Policy</a>
            </span>
          </label>
        </FormField>

        <!-- Submit Button -->
        <div class="flex flex-col sm:flex-row justify-between items-center pt-6">
          <p class="text-sm text-gray-600 mb-4 sm:mb-0">
            <span class="text-[#E31E24]">*</span> Required fields
          </p>
          <button 
            type="submit"
            class="btn-primary"
            :disabled="isSubmitting"
          >
            <LoadingSpinner :show="isSubmitting" size="sm" color="white" class="mr-2" />
            <span>{{ isSubmitting ? 'Registering...' : 'Register Now' }}</span>
          </button>
        </div>
      </form>

      <!-- Registration Success Modal -->
      <transition name="fade">
        <div v-if="showSuccessModal" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
          <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
            <div class="text-center">
              <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-green-100 text-green-500 mb-6">
                <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
              </div>
              <h2 class="text-2xl font-montserrat font-bold text-[#333333] mb-2">Registration Successful!</h2>
              <p class="text-gray-600 mb-6">
                Thank you for registering for the e-Yantra competition. We'll contact you soon with further details.
              </p>
              <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <button @click="closeSuccessModal"
                  class="btn-primary">
                  Close
                </button>
                <a href="#" class="btn-secondary">
                  Visit Dashboard
                </a>
              </div>
            </div>
          </div>
        </div>
      </transition>
    </div>
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
    const isLoading = ref(true);
    const apiError = ref('');

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
      department: '',
      termsAccepted: false
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
        },
        termsAccepted: {
          checked: helpers.withMessage('You must accept the terms and conditions', value => value === true)
        }
      }
    });

    const v$ = useVuelidate(rules, form);

    // Fetch reference data from API
    const fetchReferenceData = async () => {
      isLoading.value = true;
      apiError.value = '';

      try {
        console.log('Fetching reference data...');

        // Fetch countries, then colleges and departments sequentially to reduce chance of errors
        const countriesResponse = await apiService.referenceData.getCountries();
        console.log('Countries fetched:', countriesResponse);
        countries.value = countriesResponse.data || [];

        const collegesResponse = await apiService.referenceData.getColleges();
        console.log('Colleges fetched:', collegesResponse);
        colleges.value = collegesResponse.data || [];

        const departmentsResponse = await apiService.referenceData.getDepartments();
        console.log('Departments fetched:', departmentsResponse);
        departments.value = departmentsResponse.data || [];

        console.log('All reference data fetched successfully');
      } catch (error) {
        console.error('Failed to fetch reference data', error);
        apiError.value = 'Unable to load form data. Please refresh the page or try again later.';
      } finally {
        // Ensure we have a small delay before hiding the spinner to prevent UI flashing
        setTimeout(() => {
          isLoading.value = false;
        }, 300);
      }
    };

    // Load data on component mount
    onMounted(() => {
      fetchReferenceData();
    });

    const submitForm = async () => {
      const isFormValid = await v$.value.$validate();
      apiError.value = '';

      if (isFormValid) {
        isSubmitting.value = true;

        try {
          // Prepare data for submission
          const formData = {
            name: form.name,
            email: form.email,
            contact_number: form.contactNumber,
            gender: form.gender,
            year: parseInt(form.year), // Ensure year is sent as a number
            department_id: parseInt(form.department), // Ensure IDs are sent as numbers
            college_id: parseInt(form.college),
            country_id: parseInt(form.country)
          };

          console.log('Submitting form data:', formData);

          const response = await apiService.registration.submit(formData);
          console.log('Registration successful:', response);
          
          // Add a small delay before showing success modal for better UX
          setTimeout(() => {
            isSubmitting.value = false;
            showSuccessModal.value = true;
          }, 500);
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

          // Add a small delay before hiding the spinner
          setTimeout(() => {
            isSubmitting.value = false;
          }, 300);
        }
      }
    };
    const closeSuccessModal = () => {
      showSuccessModal.value = false;
      // Reset form after successful submission
      Object.keys(form).forEach(key => form[key] = '');
      v$.value.$reset();
    };

    return {
      form,
      v$,
      isSubmitting,
      showSuccessModal,
      countries,
      colleges,
      departments,
      submitForm,
      closeSuccessModal,
      isLoading,
      apiError,
      fetchReferenceData
    };
  }
}
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s, transform 0.3s;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
  transform: scale(0.95);
}
</style>