// backend/routes/registrationRoutes.js
const express = require('express');
const { registerUser, getAllRegistrations } = require('../controllers/registrationController');
const router = express.Router();

router.post('/register', registerUser);
router.get('/submissions', getAllRegistrations);

module.exports = router;
