import time
import random
import string
import argparse
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.support.ui import Select
from selenium.common.exceptions import TimeoutException, NoSuchElementException
from faker import Faker
# from locators import Locators

class EYantraFormAutomator:
    def __init__(self, url, headless=False):
        """Initialize the automator with target URL and browser options."""
        self.url = url
        self.fake = Faker()
        
        # Configure WebDriver options
        options = webdriver.ChromeOptions()
        if headless:
            options.add_argument('--headless')
        options.add_argument('--no-sandbox')
        options.add_argument('--disable-dev-shm-usage')
        options.add_argument('--disable-gpu')
        options.add_argument('--window-size=1920,1080')
        
        self.driver = webdriver.Chrome(options=options)
        self.wait = WebDriverWait(self.driver, 10)

    def __del__(self):
        """Clean up resources when the object is destroyed."""
        if hasattr(self, 'driver'):
            self.driver.quit()

    def navigate_to_form(self):
        """Navigate to the registration form page."""
        try:
            self.driver.get(self.url)
            print(f"Navigated to {self.url}")
            
            # Wait for form to be fully loaded
            # self.wait.until(EC.presence_of_element_located(*Locators.form))
            return True
        except TimeoutException:
            print("Error: Form page took too long to load")
            return False

    def wait_for_elements_to_load(self):
        """Wait for dropdown elements to be populated."""
        try:
            # Wait for country dropdown to have options
            self.wait.until(lambda d: len(d.find_elements(By.XPATH, "//select[@class='form-select']//option[text()='Select your country']")) > 0)
            
            # Wait for college dropdown to have options
            self.wait.until(lambda d: len(d.find_elements(By.XPATH, "//select[@class='form-select']//option[text()='Select your college']")) > 0)
            
            # Wait for department dropdown to have options
            self.wait.until(lambda d: len(d.find_elements(By.XPATH, "//select[@class='form-select']//option[text()='Select your department']")) > 0)
            
            return True
        except TimeoutException:
            print("Error: Dropdown elements did not load within the timeout period")
            return False

    def generate_random_data(self):
        """Generate random data for form fields."""
        # Full name (2-3 words)
        name = self.fake.name()
        
        # Email with unique suffix to avoid duplicates
        random_suffix = ''.join(random.choices(string.ascii_lowercase + string.digits, k=6))
        email = f"{name.lower().replace(' ', '.')}_{random_suffix}@example.com"
        
        # Contact number (10 digits)
        contact_number = ''.join(random.choices(string.digits, k=10))
        
        # Gender (male, female, other)
        gender = random.choice(['male', 'female', 'other'])
        
        # Year (1-5)
        year = random.choice(['1', '2', '3', '4', '5'])
        
        return {
            'name': name,
            'email': email,
            'contact_number': contact_number,
            'gender': gender,
            'year': year
        }

    def select_random_option(self, select_element):
        """Select a random option from a dropdown."""
        options = select_element.find_elements(By.TAG_NAME, "option")
        # Filter out the disabled placeholder option
        valid_options = [opt for opt in options if not opt.get_attribute("disabled")]
        
        if valid_options:
            random.choice(valid_options).click()
            return True
        return False

    def fill_form(self, data):
        """Fill the registration form with provided or random data."""
        try:
            # Fill text inputs
            self.driver.find_element(By.XPATH, "//*[text()='Full Name ']//following-sibling::input").send_keys(data['name'])
            self.driver.find_element(By.XPATH, "//*[text()='Email ID ']//following-sibling::input").send_keys(data['email'])
            self.driver.find_element(By.XPATH, "//*[text()='Contact Number ']//following-sibling::input").send_keys(data['contact_number'])
            
            # Select gender
            gender_radio = self.driver.find_element(By.XPATH, f"""//input[@type='radio' and @value='{data["gender"]}']""")
            gender_radio.click()
            
            # Select dropdowns
            country_select = self.driver.find_element(By.XPATH, "//option[text()='Select your country']//parent::select")
            self.select_random_option(country_select)
            
            college_select = self.driver.find_element(By.XPATH, "//option[text()='Select your college']//parent::select")
            self.select_random_option(college_select)
            
            year_select = self.driver.find_element(By.XPATH, "//option[text()='Select your year']//parent::select")
            self.select_random_option(year_select)
            
            department_select = self.driver.find_element(By.XPATH, "//option[text()='Select your department']//parent::select")
            self.select_random_option(department_select)
            
            terms_checkbox = self.driver.find_element(By.XPATH, "//input[@type='checkbox']")
            terms_checkbox.click()
            
            print(f"Filled form with data: {data}")
            return True
        except (NoSuchElementException, TimeoutException) as e:
            print(f"Error filling form: {str(e)}")
            return False

    def submit_form(self):
        """Submit the form and handle potential success modal."""
        try:
            # Submit the form
            submit_button = self.driver.find_element(By.XPATH, "//button[@type='submit']")
            submit_button.click()
            
            # Wait for either success modal or error message
            try:
                # Check if success modal appears
                self.wait.until(EC.visibility_of_element_located((By.XPATH, "//button[text()=' Close ']")))
                print("Form submitted successfully! Success modal detected.")
                
                # Close the modal
                close_button = self.driver.find_element(By.XPATH, "//button[text()=' Close ']")
                close_button.click()
                
                # Wait for modal to close
                self.wait.until(EC.invisibility_of_element_located((By.XPATH, "//button[text()=' Close ']")))
                return True
            except TimeoutException:
                # Check if there are error messages
                error_messages = self.driver.find_elements(By.XPATH, ".text-[#E31E24]")
                if error_messages:
                    errors = [err.text for err in error_messages if err.text]
                    print(f"Form submission failed with errors: {errors}")
                else:
                    print("Form submission status unknown. No success modal or error messages detected.")
                return False
                
        except NoSuchElementException as e:
            print(f"Error submitting form: {str(e)}")
            return False

    def run_automation(self, count=1, delay=2):
        """Run the automation process for the specified number of times."""
        successful_submissions = 0
        
        # Navigate to the form page
        if not self.navigate_to_form():
            print("Could not navigate to form page. Exiting.")
            return 0
        
        # Wait for elements to load
        if not self.wait_for_elements_to_load():
            print("Form elements failed to load properly. Exiting.")
            return 0
        
        for i in range(1, count + 1):
            print(f"\n--- Submission {i}/{count} ---")
            
            # Generate random data for this submission
            data = self.generate_random_data()
            
            # Fill the form
            if self.fill_form(data):
                # Submit the form
                if self.submit_form():
                    successful_submissions += 1
                    print(f"✓ Successfully submitted form {i}")
                else:
                    print(f"✗ Failed to submit form {i}")
            else:
                print(f"✗ Failed to fill form {i}")
            
            # Wait before proceeding to the next submission
            if i < count:
                print(f"Waiting {delay} seconds before next submission...")
                time.sleep(delay)
                
                # Refresh the page for next submission
                self.driver.refresh()
                
                # Wait for elements to load again
                if not self.wait_for_elements_to_load():
                    print("Form elements failed to load after refresh. Skipping to next iteration.")
                    continue
        
        print(f"\nAutomation completed: {successful_submissions}/{count} forms successfully submitted.")
        return successful_submissions

def main():
    """Main function to run the automator with command line arguments."""
    parser = argparse.ArgumentParser(description="Automate e-Yantra competition registration form submissions.")
    parser.add_argument("url", help="URL of the e-Yantra registration form")
    parser.add_argument("--count", type=int, default=1, help="Number of form submissions to make (default: 1)")
    parser.add_argument("--delay", type=int, default=2, help="Delay in seconds between submissions (default: 2)")
    parser.add_argument("--headless", action="store_true", help="Run in headless mode without GUI")
    
    args = parser.parse_args()
    
    print(f"Starting e-Yantra form automation")
    print(f"Target URL: {args.url}")
    print(f"Submissions to make: {args.count}")
    print(f"Delay between submissions: {args.delay} seconds")
    print(f"Headless mode: {'Enabled' if args.headless else 'Disabled'}")
    
    # Initialize and run the automator
    automator = EYantraFormAutomator(args.url, headless=args.headless)
    automator.run_automation(count=args.count, delay=args.delay)

if __name__ == "__main__":
    main()
