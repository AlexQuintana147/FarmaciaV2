import time
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.chrome.options import Options
import sys
import io

sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding='utf-8')

def get_driver():
    chrome_options = Options()
    chrome_options.add_argument('--start-maximized')
    chrome_options.add_argument('--disable-blink-features=AutomationControlled')
    chrome_options.add_argument('--headless')  # Descomenta para modo invisible
    return webdriver.Chrome(options=chrome_options)

def humata_query(query, url):
    driver = get_driver()
    driver.get(url)
    
    # Espera a que cargue el textarea
    time.sleep(5)
    textarea = driver.find_element(By.CSS_SELECTOR, 'textarea.chat-box_textAreaInput__0LBJL')
    textarea.clear()
    textarea.send_keys(query)
    time.sleep(6)  # Espera antes de enviar Enter para asegurar que el input esté listo
    textarea.send_keys(Keys.ENTER)
    
    # Espera a que aparezca la respuesta
    time.sleep(10)
    answers = driver.find_elements(By.CSS_SELECTOR, 'div.react-markdown_reactMarkdown__us9vs')
    if answers:
        print('')     #print('Respuesta:')
        # Cortar la respuesta en el primer corchete abierto
        respuesta = answers[-1].text
        idx = respuesta.find('[')
        if idx != -1:
            respuesta = respuesta[:idx].strip()
        print(respuesta)
        result = respuesta
    else:
        print('No se encontró respuesta.')
        result = None
    driver.quit()
    return result

if __name__ == "__main__":
    url = "https://app.humata.ai/ask/file/4253b633-c35b-4949-a5cb-990cec0e5e26?share_link=fa4fb366-3858-495c-9eb7-5d7542e9a0b7&selected-approach=Balanced"
    if len(sys.argv) > 1:
        producto = sys.argv[1]
    else:
        producto = input("Producto: ")
    query = f"dimelo a tu modo de entender la descripción del producto: {producto} y cuanto viene en una caja, en caso no encuentres nada, solo di, 'no encontrado'"
    respuesta = humata_query(query, url)
