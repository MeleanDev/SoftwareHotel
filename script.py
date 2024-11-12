import zipfile
import os

def crear_zip(carpeta_origen, ruta_destino, nombre_archivo_zip="archivo.zip"):
  """
  Crea un archivo ZIP de una carpeta específica y lo guarda en una ruta determinada.

  Args:
    carpeta_origen: Ruta completa de la carpeta a comprimir.
    ruta_destino: Ruta completa donde se guardará el archivo ZIP.
    nombre_archivo_zip: Nombre del archivo ZIP a crear (opcional).
  """

  # Crear el objeto ZipFile
  with zipfile.ZipFile(os.path.join(ruta_destino, nombre_archivo_zip), 'w') as zip_file:
    # Recorrer todos los archivos y subdirectorios de la carpeta origen
    for root, dirs, files in os.walk(carpeta_origen):
      for file in files:
        # Agregar cada archivo al archivo ZIP
        zip_file.write(os.path.join(root, file), os.path.relpath(os.path.join(root, file), carpeta_origen))

# Ejemplo de uso:
carpeta_a_comprimir = "C:/xampp/mysql/data/softwarehotel"  # Reemplaza con la ruta de tu carpeta
ruta_de_descargas = "C:/Users/juans/Downloads"  # Reemplaza con la ruta de tus descargas
nombre_del_zip = "mi_archivo_comprimido.zip"

crear_zip(carpeta_a_comprimir, ruta_de_descargas, nombre_del_zip)