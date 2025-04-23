# e-Yantra Competition Registration Frontend

A responsive Vue.js 3 application for the e-Yantra competition registration system, designed to provide a seamless user experience for competition participants.

![e-Yantra Frontend](https://www.e-yantra.org/images/home/logo.svg)

## Features

- **Responsive Design**: Mobile-first layout using Tailwind CSS
- **Form Validation**: Real-time validation with Vuelidate
- **API Integration**: Seamless communication with the Laravel backend
- **User-Friendly Experience**: Loading states, error messages, and success confirmations
- **Brand-Aligned Design**: Custom styling matching e-Yantra's visual identity

## Component Structure

The application is built using a component-based architecture:

```
src/
├── assets/
│   └── tailwind.css       # Custom Tailwind configuration
├── components/
│   ├── ApiErrorMessage.vue    # Error display component
│   ├── Footer.vue             # Site footer
│   ├── FormField.vue          # Reusable form field component
│   ├── Header.vue             # Site header with navigation
│   ├── LoadingSpinner.vue     # Loading indicator
│   └── RegistrationForm.vue   # Main registration form
├── services/
│   └── api.js             # API client and services
├── App.vue                # Main application component
└── main.js               # Vue application entry point
```

## Main Components

### RegistrationForm

The core of the application, handling:
- Form data management with reactive state
- Validation using Vuelidate
- API communication for form submission
- Loading states and error handling
- Success confirmation

### FormField

A reusable component that provides:
- Consistent form styling
- Label and help text
- Error message display
- Required field indicators

### LoadingSpinner

A flexible loading indicator with:
- Customizable size (sm, md, lg, xl)
- Color options (primary, accent, white, gray)
- Full-screen or inline display
- Optional text display

## API Integration

The frontend communicates with the backend through the `api.js` service, which uses native Fetch API and provides:

- Structured API client with error handling
- Timeout management
- CORS handling
- Resource-specific service methods

## Design System

The application implements a custom design system based on Tailwind CSS:

### Colors
- **Primary**: #E31E24 (Red)
- **Accent**: #F7D154 (Yellow)
- **Neutral**: #333333 (Dark Gray)

### Typography
- **Headings**: Montserrat (Bold)
- **Body**: Open Sans

### Components
- Custom button styles
- Form input styling
- Card and modal designs

## Development Setup

### Prerequisites
- Node.js 16+ and npm
- Git

### Installation

1. Clone the repository and navigate to the frontend directory:
   ```bash
   git clone <repository-url>
   cd <repository-directory>/frontend
   ```

2. Install dependencies:
   ```bash
   npm install
   ```

3. Start the development server:
   ```bash
   npm run serve
   ```

4. The application will be available at `http://localhost:8080`

### Using Docker

If you're using Docker with the full application stack:

1. Start the Docker environment from the project root:
   ```bash
   docker compose up -d
   ```

2. The frontend will be available at `http://localhost:8080`

3. View frontend container logs:
   ```bash
   docker compose logs -f frontend
   ```

## Building for Production

Create a production build:

```bash
npm run build
```

The compiled files will be in the `dist/` directory, ready to be served by any static file server.

## Environment Configuration

The application uses the following environment variables:

- `VUE_APP_API_URL`: Backend API URL (default: `http://localhost:8000/api`)

These can be configured in a `.env` file or passed through Docker environment variables.

## Form Validation

The registration form validates:

- **Name**: Letters and spaces only, 3+ characters
- **Email**: Valid email format, required
- **Contact Number**: Valid phone number format
- **Gender**: Required selection
- **Country/College/Department**: Required selections
- **Year of Study**: Valid selection
- **Terms Acceptance**: Must be accepted

## Customization

### Modifying the Form

To add or modify form fields:

1. Update the form structure in `RegistrationForm.vue`
2. Add validation rules in the `rules` computed property
3. Update the API submission format in the `submitForm` method

### Styling Changes

The application uses Tailwind CSS with custom configuration:

1. Edit `src/assets/tailwind.css` for global styles
2. Component-specific styles are in their respective `.vue` files

## Testing

For manual testing:

1. Start the application
2. Fill out the form with valid/invalid data to test validation
3. Submit the form to test API integration

For automated testing, use the included Selenium script in the `automation/` directory (see main repository README).

## License

This project is licensed under the MIT License.