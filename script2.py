import zipfile
import os

def descomprimir_zip_en_carpeta(archivo_zip, destino):
  """
  Descomprime un archivo ZIP en una carpeta llamada "softwarehotel" dentro de la ruta especificada.

  Args:
    archivo_zip: Ruta completa del archivo ZIP.
    destino: Ruta del directorio donde se creará la carpeta "softwarehotel".
  """

  # Crear la ruta completa de la carpeta "softwarehotel"
  ruta_carpeta = os.path.join(destino, "softwarehotel")

  # Crear la carpeta si no existe
  os.makedirs(ruta_carpeta, exist_ok=True)

  # Descomprimir el archivo ZIP en la carpeta creada
  with zipfile.ZipFile(archivo_zip, 'r') as zip_ref:
    zip_ref.extractall(ruta_carpeta)
    print(f"El archivo {archivo_zip} se ha descomprimido en {ruta_carpeta}")

# Ejemplo de uso:
ruta_zip = "C:/Users/juans/Downloads/mi_archivo_comprimido.zip"
ruta_destino = "C:/xampp/mysql/data/"

descomprimir_zip_en_carpeta(ruta_zip, ruta_destino)