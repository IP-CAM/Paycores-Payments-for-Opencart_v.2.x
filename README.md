## Plugin Opencart 2 de Paycores.com ##
[link a Paycores Opencart](https://paycores.com/Opencart_2_plugin).

Paycores brinda soporte seguro y confiable, por esto ofrecemos nuestro plugin Opencart 
para pagos a través de nuestra pasarela. A continuación describimos los puntos que debes de tener en 
cuenta para integrar nuestro plugin Opencart de forma segura y sencilla.

## Instalar el plugin Opencart de Paycores
**Paso 1:**
Se debe de [descargar](https://codeload.github.com/Paycores/WooCommerce_plugin/zip/master) el plugin Opencart de Paycores.

**Paso 2:**
Instalación en Opencart: para instalar el plugin Opencart debes descomprimir el archivo 
y copiar las carpetas admin y catalog en la carpeta raiz de su proyecto.
![alt text](https://raw.githubusercontent.com/paycores/steps/master/Opencart/step_1.png)
![alt text](https://raw.githubusercontent.com/paycores/steps/master/Opencart/step_2.png)

**Paso 3:**
En el menu de Extensiones haces clic en **Pagos**
![alt text](https://raw.githubusercontent.com/paycores/steps/master/Opencart/step_3.png)

Busca en la lista de extensiones a **Paycores Payment Gateway**
![alt text](https://raw.githubusercontent.com/paycores/steps/master/Opencart/step_4.png)

y haces clic en **Instalar**
![alt text](https://raw.githubusercontent.com/paycores/steps/master/Opencart/step_5.png)

## Configurar el plugin Opencart de Paycores ##
**Paso 4:**
Una vez instalado el plugin Opencart de Paycores presiona el boton de **Editar**
![alt text](https://raw.githubusercontent.com/paycores/steps/master/Opencart/step_6.png)

Llene los datos que se solicitan y presione el boton **Guardar**
![alt text](https://raw.githubusercontent.com/paycores/steps/master/Opencart/step_7.png)

* **CommerceID:** CommerceID asignado en el panel de administración de Paycores
* **ApiKey:** ApiKey asignada en el panel de administración de Paycores
* **ApiLogin:** ApiLogin asignado en el panel de administración de Paycores
* **estado:** Activa o Desactiva el plugin en la tienda
* **activar transacciones de prueba:** Activa las transacciones de prueba de Paycores
* **Estado de orden aprobada:** Estado en el que quedan las ordenes aprobadas por Paycores
* **Estado de orden fallida:** Estado en el que quedan las ordenes negadas o fallidas por Paycores

Felicitaciones ha integrado pagos a través de Paycores en su página web.

 ## Recomendaciones: ##
El servicio de nuestra Api requiere de que los servidores cuenten con un certificado TLS debidamente firmado, 
y el proyecto debe de estar bien estructurado con el código limpio para que el certificado TLS SSL funcione correctamente. 
