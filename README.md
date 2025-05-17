# PRACTICA DE PHP---CRUD-Contactos


Este proyecto es una agenda de contactos web desarrollada en PHP aplicando el patrón de arquitectura **MVC (Modelo - Vista - Controlador)**. Permite a los usuarios autenticarse y gestionar contactos en una interfaz sencilla.

##  Requisitos

- PHP 7.4 o superior
- MySQL
- [XAMPP](https://www.apachefriends.org/index.html) (recomendado para entorno local)
- Navegador web moderno

## Instalación y configuración

### 1. Clonar o copiar el repositorio

Coloca la carpeta del proyecto en el directorio `htdocs` de XAMPP:
https://github.com/Mariana450/CRUD-Contactos

C:\xampp\htdocs\agendaversion2

2. Crear la base de datos
Inicia XAMPP y activa Apache y MySQL.
Accede a http://localhost/phpmyadmin.
Crea una nueva base de datos llamada agenda1.
Los scripts de la base de datos, se encuentran en el respositorio indicado anteriormente.

## Captura de pantalla inicial

<p>
    <img src="capturas/Inicio.png" alt="Captura de pantalla inicial" width="600"/>
</p>


### Ejecución
Abre tu navegador.

Ve a: http://localhost/agendaversion2/index.php

Inicia sesión con: Para ver todos los contactos que se encuentran en la base de datos

Usuario: admin

Contraseña: 12345

USUARIO 2: Para solo acceder a los contactos de ese usuario
Usuario: Usua1
contraseña: clave1

USUARIO 3: Para solo acceder a los contactos de ese usuario
Usuario: Usua2
contraseña:clave2

### Personalización
Puedes agregar más vistas, controladores o mejorar el sistema de roles y seguridad.

El controlador actual redirige a eliminar.php, pero puedes cambiar el destino a un dashboard u otro módulo.

### Licencia
Este proyecto es de uso educativo y puede modificarse libremente.
### Informacion de contacto 
- Nombre: Vázquez González Mariana
- Carrera: Ingenería en sistemas computacionales
- Correo: marlyvazgon@gmail.com




