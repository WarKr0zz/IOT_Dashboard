from ast import Bytes
from selenium import webdriver
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.chrome.service import Service
from webdriver_manager.chrome import ChromeDriverManager


opts = Options()
opts.add_argument("user-agent=Selenium")

DRIVER_PATH = 'D:\chromedriver.exe'
driver = webdriver.Chrome(executable_path=DRIVER_PATH,chrome_options=opts)
driver.get('http://localhost/IOT_Dashboard/API/DeviceId/')




while True:
    pass

