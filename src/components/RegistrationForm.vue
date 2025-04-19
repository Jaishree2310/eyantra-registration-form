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
          <input
            id="name"
            v-model="form.name"
            required
            placeholder="Enter your full name"
            :class="{ invalid: form.name && !isNameValid }"
          />
          <span v-if="form.name && !isNameValid" class="error-msg">
            No special characters allowed in name.
          </span>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label for="email">Email Address</label>
            <input
              id="email"
              type="email"
              v-model="form.email"
              required
              placeholder="your.email@example.com"
            />
          </div>

          <div class="form-group">
            <label for="contact">Contact</label>
            <input
              id="contact"
              v-model="form.contact"
              required
              maxlength="10"
              placeholder="Enter 10-digit mobile number"
              :class="{ invalid: form.contact && !isContactValid }"
            />
            <span v-if="form.contact && !isContactValid" class="error-msg">
              Please enter a valid 10-digit number.
            </span>
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
            <label for="domain">Domain</label>
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
  computed: {
    isNameValid() {
      const nameRegex = /^[A-Za-z\s]+$/;
      return nameRegex.test(this.form.name);
    },
    isContactValid() {
      const contactRegex = /^\d{10}$/;
      return contactRegex.test(this.form.contact);
    },
  },
  methods: {
    async submitForm() {
      if (!this.isNameValid) {
        alert('Please enter a valid name without special characters.');
        return;
      }

      if (!this.isContactValid) {
        alert('Please enter a valid 10-digit contact number.');
        return;
      }

      try {
        const API_URL = process.env.NEXT_PUBLIC_API_URL || 'http://localhost:5000';
        const res = await axios.post(`${API_URL}/api/register`, this.form);
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
    },
  },
};
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@500&family=Inter&display=swap');

* {
  box-sizing: border-box;
}

body {
  margin: 0;
  padding: 0;
  font-family: 'Inter', sans-serif;
  background: linear-gradient(145deg, #1f1f1f, #2c2c2c);
  color: #ffffff;
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 40px 16px;
}

.container {
  width: 100%;
  max-width: 500px;
  background: rgba(255, 255, 255, 0.05);
  backdrop-filter: blur(12px);
  border: 1px solid rgba(255, 255, 255, 0.1);
  padding: 30px 32px;
  border-radius: 20px;
  box-shadow: 0 0 40px rgba(255, 193, 7, 0.15);
}

.header {
  text-align: center;
  margin-bottom: 24px;
}

.header h1 {
  font-family: 'Orbitron', sans-serif;
  font-size: 24px;
  color: #ffcc00;
  margin-bottom: 4px;
}

.header p {
  font-family: 'Orbitron', sans-serif;
  font-size: 14px;
  color: #74f2ca;
}

form {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

.form-group label {
  font-family: 'Orbitron', sans-serif;
  display: flex;
  margin-bottom: 6px;
  font-weight: 600;
  color: #ffcc00;
  font-size: 14px;

}


input,
select {
  width: 100%;
  padding: 12px;
  font-size: 14px;
  color: #fff;
  background-color: #2c2c2c;
  border: 1px solid #ffb300;
  border-radius: 8px;
  outline: none;
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
}

input:focus,
select:focus {
  outline: none;
  border-color: #ffc107;
  box-shadow: 0 0 6px rgba(255, 193, 7, 0.5);
}

select {
  appearance: none;
  background-image: url("data:image/svg+xml;utf8,<svg fill='%23ffffff' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/></svg>");
  background-repeat: no-repeat;
  background-position: right 14px center;
  background-size: 14px;
  padding-right: 36px;
}

.form-row {
  display: flex;
  flex-wrap: wrap;
  gap: 16px;
}

.form-row .form-group {
  flex: 1;
  min-width: 0;
}

button {
  background-color: #ff9800;
  color: white;
  padding: 12px;
  border: none;
  border-radius: 10px;
  font-weight: bold;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button:hover {
  background-color: #ffa726;
}

.error-msg {
  color: #ff6f61;
  font-size: 12px;
  margin-top: -16px;
}

</style>
