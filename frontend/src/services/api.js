// Base configuration
const baseURL = process.env.VUE_APP_API_URL || 'http://localhost:8000/api';
const defaultHeaders = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
};
const timeout = 10000; // 10 seconds timeout

// Helper function to add auth token to headers (can remove if not needed)
function createHeaders() {
  return defaultHeaders;
}

// Helper function for timeout with fetch
function fetchWithTimeout(resource, options) {
  const controller = new AbortController();
  const id = setTimeout(() => controller.abort(), timeout);
  const signal = controller.signal;

  return fetch(resource, { 
    ...options, 
    signal,
    mode: 'cors', // Add CORS mode
    credentials: 'same-origin'
  }).finally(() => clearTimeout(id));
}

// Helper function to handle request and response logic
async function apiClient(endpoint, options = {}) {
  const headers = createHeaders();
  try {
    console.log(`Making ${options.method || 'GET'} request to: ${baseURL}${endpoint}`);
    
    const response = await fetchWithTimeout(`${baseURL}${endpoint}`, {
      ...options,
      headers,
    });

    if (!response.ok) {
      // Handle specific error status codes
      switch (response.status) {
        case 401:
          console.error('Unauthorized access');
          break;
        case 403:
          console.error('Forbidden resource');
          break;
        case 404:
          console.error('Resource not found');
          break;
        case 500:
          console.error('Server error');
          break;
        default:
          console.error('API error', await response.text());
      }
      throw new Error(`HTTP Error: ${response.status}`);
    }

    return await response.json();
  } catch (error) {
    if (error.name === 'AbortError') {
      console.error('Network error - request timed out');
    } else {
      console.error('Error', error.message);
    }
    throw error;
  }
}

// API functions
export default {
  // Registration endpoints
  registration: {
    submit(formData) {
      return apiClient('/register', {
        method: 'POST',
        body: JSON.stringify(formData),
      });
    }
  },

  // Reference data endpoints
  referenceData: {
    getCountries() {
      return apiClient('/countries', { method: 'GET' });
    },
    getColleges() {
      return apiClient('/colleges', { method: 'GET' });
    },
    getDepartments() {
      return apiClient('/departments', { method: 'GET' });
    },
  },
};