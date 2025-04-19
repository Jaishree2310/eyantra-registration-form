// backend/controllers/registrationController.js
const Registration = require('../models/Registration');

const registerUser = async (req, res) => {
  const { name, email, contact, gender, country, college, year, domain } = req.body;

  // Check if the email already exists
  const existingUser = await Registration.findOne({ email });
  if (existingUser) {
    return res.status(400).json({ message: 'Email already exists' });
  }

  try {
    const newRegistration = new Registration({
      name, email, contact, gender, country, college, year, domain
    });
    await newRegistration.save();
    res.status(201).json({ message: 'Registration successful' });
  } catch (error) {
    res.status(500).json({ message: 'Error registering user', error });
  }
};

const getAllRegistrations = async (req, res) => {
  try {
    const registrations = await Registration.find();
    res.status(200).json(registrations);
  } catch (error) {
    res.status(500).json({ message: 'Error fetching registrations', error });
  }
};

module.exports = { registerUser, getAllRegistrations };
