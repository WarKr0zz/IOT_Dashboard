from ast import Bytes
from selenium import webdriver
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.common.by import By
from webdriver_manager.chrome import ChromeDriverManager


opts = Options()
opts.add_argument("user-agent=Mozilla")

DRIVER_PATH = 'D:\chromedriver.exe'
driver = webdriver.Chrome(executable_path=DRIVER_PATH)
driver.get('http://localhost/IOT_Dashboard/API')
elem = driver.find_elements(By.ID,'WebScrapping')


test1 = elem[0].text
print("test page principal")
if test1 == "Array ( [message] => Probleme de récupération de données. [code] => 0 )" :
    print("OK tout est bon")
else : 
    print("pas OKdu tout")



## test 2
driver.get('http://localhost/IOT_Dashboard/API/DeviceId')
elem2 = driver.find_elements(By.ID,'WebScrapping')
test2 = elem2[0].text
print("test numero 2 liste des device")
if len(test2) > 4 :
    print("OK tout est bon")
else : 
    print("pas OKdu tout")

while True:
    pass

