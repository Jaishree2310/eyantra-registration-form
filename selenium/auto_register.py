from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import Select
from faker import Faker
import time

fake = Faker()
X = 10  

driver = webdriver.Chrome()

for i in range(X):
    driver.get("http://localhost:5173/")  
    driver.implicitly_wait(5) 
    time.sleep(5)  # Let the page load fully

    driver.find_element(By.ID, "name").send_keys(fake.name())
    driver.find_element(By.ID, "email").send_keys(fake.unique.email())
    driver.find_element(By.ID, "contact").send_keys(fake.msisdn()[:10])

    Select(driver.find_element(By.ID, "gender")).select_by_visible_text("Male")
    Select(driver.find_element(By.ID, "country")).select_by_visible_text("India")
    Select(driver.find_element(By.ID, "college")).select_by_visible_text("IIT Bombay")

    driver.find_element(By.ID, "year").send_keys(str(fake.random_int(min=1, max=4)))
    driver.find_element(By.ID, "domain").send_keys(fake.job())

    driver.find_element(By.CSS_SELECTOR, "button[type='submit']").click()

    time.sleep(2)  # Wait for form reset or success message

driver.quit()
