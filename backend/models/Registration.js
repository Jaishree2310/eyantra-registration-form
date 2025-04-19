// backend/models/Registration.js
const mongoose = require('mongoose');

const RegistrationSchema = new mongoose.Schema({
  name: { type: String, required: true },
  email: { type: String, required: true, unique: true },
  contact: { type: String, required: true },
  gender: { type: String, required: true },
  country: { type: String, required: true },
  college: { type: String, required: true },
  year: { type: String, required: true },
  domain: { type: String, required: true }
});

module.exports = mongoose.model('Registration', RegistrationSchema);
