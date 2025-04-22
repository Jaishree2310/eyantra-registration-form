# e-Yantra Competition Registration Frontend

This is the Vue.js frontend for the e-Yantra competition registration system. It provides a responsive, user-friendly interface for participants to register for e-Yantra competitions.

## Stack

- Vue.js 3 (Composition API)
- Tailwind CSS for styling
- Vuelidate for form validation
- Axios for API communication

## Development

### Project Setup

```bash
npm install
```

### Compiles and hot-reloads for development

```bash
npm run serve
```

### Compiles and minifies for production

```bash
npm run build
```

### Lints and fixes files

```bash
npm run lint
```

## Component Structure

- **App.vue**: Main component that includes the header, registration form, and footer
- **Header.vue**: Navigation and brand logo
- **RegistrationForm.vue**: The main registration form with validation
- **FormField.vue**: Reusable form field component
- **Footer.vue**: Page footer with links and copyright

## Form Validation

The registration form validates the following:
- Name (only letters and spaces, minimum 3 characters)
- Email (valid format, with verification process)
- Contact number (valid phone number format, 10-15 digits)
- Required fields for all dropdowns and selections

## Styling

The application uses Tailwind CSS with custom configuration to match the e-Yantra branding:
- Primary Red: #E31E24
- Accent Yellow: #F7D154
- Neutral Black: #333333
- Fonts: Montserrat for headings, Open Sans for body text

## Docker

The included Dockerfile creates a production-ready build that:
1. Builds the Vue application using Node.js
2. Serves the built assets using Nginx
3. Configures proper routing for the SPA

## API Integration

The application is set up to communicate with a Laravel backend. When connecting to the real API:

1. Update the API base URL in the axios configuration
2. Replace the mock functions with actual API calls
3. Handle the API responses accordingly