<template>
  <div class="container">
    <div class="glass-card">
      <div class="header">
        <h1>e-Yantra Competition 2025</h1>
        <p>Presented by IIT Bombay</p>
      </div>

      <form @submit.prevent="submitForm">
        <div class="form-group">
          <label for="name">Full Name</label>
          <input id="name" v-model="form.name" required placeholder="Enter your full name" />
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="email">Email Address</label>
            <input id="email" type="email" v-model="form.email" required placeholder="your.email@example.com" />
          </div>
          
          <div class="form-group">
            <label for="contact">Contact</label>
            <input id="contact" v-model="form.contact" required placeholder="+91 98765 43210" />
          </div>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="gender">Gender</label>
            <select id="gender" v-model="form.gender" required>
              <option disabled value="">Select Gender</option>
              <option>Male</option>
              <option>Female</option>
              <option>Other</option>
            </select>
          </div>

          <div class="form-group">
            <label for="country">Country</label>
            <select id="country" v-model="form.country" required>
              <option disabled value="">Select Country</option>
              <option>India</option>
              <option>USA</option>
              <option>UK</option>
              <option>Japan</option>
              <option>Other</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="college">Institution</label>
          <select id="college" v-model="form.college" required>
            <option disabled value="">Select Your Institution</option>
            <option>IIT Bombay</option>
            <option>MIT</option>
            <option>Stanford</option>
            <option>Harvard</option>
            <option>Other</option>
          </select>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="year">Year of Study</label>
            <input id="year" v-model="form.year" required placeholder="e.g. 2nd Year" />
          </div>

          <div class="form-group">
            <label for="domain">Domain/Department</label>
            <input id="domain" v-model="form.domain" required placeholder="e.g. Computer Science" />
          </div>
        </div>

        <button type="submit">Register Now</button>
      </form>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      form: {
        name: '',
        email: '',
        contact: '',
        gender: '',
        country: '',
        college: '',
        year: '',
        domain: '',
      },
    };
  },
  methods: {
    async submitForm() {
      try {
        const res = await axios.post('http://localhost:5000/api/register', this.form);
        this.$emit('registration-success');
        alert('Registration successful! Welcome to e-Yantra Competition.');
        this.resetForm();
      } catch (error) {
        alert(error.response?.data?.message || 'Error registering. Please try again.');
      }
    },
    resetForm() {
      this.form = {
        name: '',
        email: '',
        contact: '',
        gender: '',
        country: '',
        college: '',
        year: '',
        domain: '',
      };
    }
  },
};
</script>

<style scoped>

@import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@500&family=Inter&display=swap');

body {
  background: linear-gradient(to right top, #0f0c29, #302b63, #24243e);
  font-family: 'Inter', sans-serif;
  color: white;
  margin: 0;
  padding: 0;
}

.container {
  max-width: 800px;
  margin: 3rem auto;
  padding: 1rem;
}

.glass-card {
  background: rgba(255, 255, 255, 0.05);
  border-radius: 16px;
  padding: 2rem;
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.2);
  box-shadow: 0 0 25px rgba(255, 255, 255, 0.1);
}

.header {
  text-align: center;
  margin-bottom: 2rem;
}

h1 {
  font-family: 'Orbitron', sans-serif;
  font-size: 2rem;
  color: #ffcd38;
}

p {
  color: #9fd3c7;
  font-size: 0.9rem;
  margin-top: 0.3rem;
}

form {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.form-group {
  /* margin-bottom: 1.2rem; */
  width: 100%;
  display: flex;
  flex-direction: column;
}

.form-row {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 1.2rem;
}

label {
  font-weight: 600;
  color: #ffc300;
  margin-bottom: 0.4rem;
  text-align: left;
}

input, select {
  width: 100%;
  padding: 0.75rem 1rem;
  background: rgba(255, 255, 255, 0.08);
  border: 1px solid #ffa500;
  color: #eee;
  border-radius: 8px;
  font-size: 1rem;
  transition: all 0.3s ease;
  appearance: none;
}

input::placeholder {
  color: #ccc;
}

input:focus, select:focus {
  outline: none;
  border-color: #ffd166;
  box-shadow: 0 0 10px #ffcc70;
}

/* Custom dropdown arrow for select */
select {
  background-image: url("data:image/svg+xml;charset=UTF-8,%3Csvg fill='%23ffd166' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
  background-repeat: no-repeat;
  background-position: right 1rem center;
  background-size: 1.2rem;
}

button {
  background: linear-gradient(135deg, #ff6f00, #ff9900);
  padding: 1rem;
  border: none;
  border-radius: 10px;
  font-size: 1rem;
  color: white;
  font-weight: 700;
  cursor: pointer;
  margin-top: 1rem;
  transition: transform 0.2s, box-shadow 0.2s;
  align-self: center;
  width: 60%;
  max-width: 300px;
}

button:hover {
  transform: scale(1.02);
  box-shadow: 0 0 20px rgba(255, 153, 0, 0.5);
}

button:disabled {
  background: #555;
  cursor: not-allowed;
  opacity: 0.6;
}

@media (max-width: 600px) {
  .form-row {
    grid-template-columns: 1fr;
  }
}

</style>
