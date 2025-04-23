# e-Yantra Competition Registration Frontend

This is the Vue.js frontend for the e-Yantra competition registration system. It provides a responsive, user-friendly interface for participants to register for e-Yantra robotics competitions.

## Tech Stack

- Vue.js 3 (Composition API)
- Tailwind CSS for styling
- Vuelidate for form validation
- Axios for API communication

## Directory Structure

```
├── public/               # Static assets
│   └── index.html        # HTML entry point with meta tags
├── src/                  # Vue source code
│   ├── assets/           # CSS and other assets
│   │   └── tailwind.css  # Tailwind configuration
│   ├── components/       # Vue components
│   │   ├── ApiErrorMessage.vue   # Error display component
│   │   ├── Footer.vue            # Site footer
│   │   ├── FormField.vue         # Reusable form field
│   │   ├── Header.vue            # Site header
│   │   ├── LoadingSpinner.vue    # Loading indicator
│   │   └── RegistrationForm.vue  # Main registration form
│   ├── services/         # API services
│   │   └── api.js        # API client module
│   ├── App.vue           # Main application component
│   └── main.js           # Vue application entry point
├── Dockerfile            # Docker configuration
└── nginx.conf            # Nginx server configuration
```

## Features

- **Responsive Design**: Mobile-first approach with Tailwind CSS
- **Form Validation**: Client-side validation with Vuelidate
- **API Integration**: Communicates with Laravel backend
- **Error Handling**: User-friendly error messages
- **Loading States**: Visual loading indicators during API calls
- **Success Feedback**: Modal confirmation for successful submissions

## Component Structure

### RegistrationForm

The main registration form component includes:

- Personal information fields (name, email, contact, gender)
- Academic information (country, college, year, department)
- Terms and conditions acceptance
- Form validation with visual feedback
- Success modal after registration

### FormField

A reusable component for form fields that provides:

- Consistent styling
- Label with required indicator
- Error message display
- Help text support

### LoadingSpinner

A flexible loading indicator that can be:

- Used inline or full-screen
- Sized from small to extra large
- Colored to match brand colors
- Accompanied by custom text

## Development Setup

### Prerequisites

- Node.js 16+ and npm
- Vue CLI installed globally (optional)

### Installation

1. Install dependencies:
   ```bash
   npm install
   ```

2. Start the development server:
   ```bash
   npm run serve
   ```

3. Access the development server at http://localhost:8080

### Using Docker

To run the frontend using Docker:

1. Build and start the container:
   ```bash
   docker-compose up -d frontend
   ```

2. Access the application at http://localhost:8080

## Building for Production

To create a production build:

```bash
npm run build
```

This will create a `dist` folder with optimized files ready for deployment.

## API Configuration

The frontend communicates with the backend API using the `api.js` service. Configuration options:

- **Base URL**: Set in `src/services/api.js` or through the `VUE_APP_API_URL` environment variable
- **Timeout**: Default is 30 seconds
- **Error Handling**: Structured error responses for forms
- **CORS Support**: Configured for cross-origin requests

## Styling

The application uses Tailwind CSS with custom configuration to match the e-Yantra branding:

- **Primary Color**: #E31E24 (Red)
- **Accent Color**: #F7D154 (Yellow)
- **Neutral Color**: #333333 (Dark Gray)
- **Fonts**: Montserrat for headings, Open Sans for body text

## Contributing

When contributing to the frontend:

1. Follow the Vue.js style guide
2. Use the existing component patterns
3. Maintain the responsive design
4. Test across different browsers and devices

## License

This project is licensed under the MIT License.