from ast import Bytes
from selenium import webdriver
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.common.by import By
from webdriver_manager.chrome import ChromeDriverManager


opts = Options()
opts.add_argument("user-agent=Mozilla")

DRIVER_PATH = 'D:\chromedriver.exe'
driver = webdriver.Chrome(executable_path=DRIVER_PATH,chrome_options=opts)
driver.get('http://localhost/IOT_Dashboard/API/')
elem = driver.find_elements(By.ID,'WebScrapping')


if elem == "Array ( [message] => Probleme de récupération de données. [code] => 0 )": 
    print("OK")
else:
    print("Pas OK")

# check if the innerHTML is empty



while True:
    pass

