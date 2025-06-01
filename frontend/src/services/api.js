// Base configuration
const baseURL = process.env.VUE_APP_API_URL || 'http://localhost:8000/api';
const defaultHeaders = {
  'Content-Type': 'application/json',
  'Accept': 'application/json',
};
const timeout = 30000; // 30 seconds timeout

// Helper function to add auth token to headers if needed
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
    mode: 'cors',
    credentials: 'omit' // Helps with CORS issues
  }).finally(() => clearTimeout(id));
}

// API client with error handling
async function apiClient(endpoint, options = {}) {
  const headers = createHeaders();
  try {
    console.log(`API Request: ${options.method || 'GET'} to ${baseURL}${endpoint}`);
    
    const response = await fetchWithTimeout(`${baseURL}${endpoint}`, {
      ...options,
      headers,
    });

    // Log response status
    console.log(`API Response status: ${response.status}`);

    // Handle error status codes
    if (!response.ok) {
      // Parse error response
      const errorData = await response.json();
      console.error('API error:', errorData);
      
      // Throw structured error with the response data
      throw {
        status: response.status,
        data: errorData,
        message: errorData.message || `Request failed with status: ${response.status}`
      };
    }

    // Parse the JSON response
    const data = await response.json();
    return data;
  } catch (error) {
    if (error.name === 'AbortError') {
      console.error('Request timeout - the server took too long to respond');
      throw {
        message: 'The request timed out. Please check your connection and try again.'
      };
    }
    
    // If we already created a structured error, just rethrow it
    if (error.status || error.data || error.message) {
      throw error;
    }
    
    console.error('API request failed:', error.message);
    throw {
      message: error.message || 'An unexpected error occurred. Please try again.'
    };
  }
}

// API service module
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