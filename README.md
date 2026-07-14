# Informe de Auditoría de Seguridad

**Fecha de Auditoría:** 13 de Julio de 2026  
**Estado General:** **APROBADO / CONFORME**

### 1. Validación de Hashing Criptográfico Industrial (Estudiante 2)
Se confirma textualmente que el **Estudiante 2** ha implementado de manera exitosa y correcta la constante criptográfica de nivel industrial **`PASSWORD_BCRYPT`** en el módulo de inserción DML (`public/registro.php`). 
* El flujo de persistencia procesa las contraseñas mediante el algoritmo derivativo robusto *Blowfish*, garantizando la inyección automática de una sal (*salt*) aleatoria de 22 caracteres.
* Esto anula la viabilidad de ataques basados en tablas de arcoíris (*Rainbow Tables*) o diccionarios precomputados, cumpliendo a cabalidad con los estándares corporativos de almacenamiento seguro de credenciales.

### 2. Análisis de Mitigación de Fugas de Información (Bloques Catch)
Se ha auditado la totalidad de las estructuras de control de excepciones (`try...catch`) en las capas de conexión, registro y autenticación. El diagnóstico confirma la **ausencia absoluta de fugas de información (*Information Disclosure*)**:
* Ningún bloque `catch` imprime directamente en la pantalla del cliente el contenido de las variables nativas `$e->getMessage()` o `$e->getTraceAsString()`.
* Toda anomalía en la capa de persistencia se redirige de manera interna a los logs del servidor web (`error_log()`). El cliente interactúa únicamente con interfaces controladas y mensajes genéricos sanitizados (ej. *"Ocurrió un error interno en el servidor"*).
* Se mitiga de forma total la exposición accidental de metadatos críticos como nombres de bases de datos, contraseñas de red, puertos de escucha o rutas del sistema de archivos local.
* # Evaluación Grupal - Sistema de Persistencia y Auditoría

## Estructura del Equipo y Asignación de Roles

* **Estudiante 1: Infraestructura Base**
  * **GitHub:** jonecssy castro
  * **Responsabilidad:** Configuración inicial del entorno y arquitectura DDL.

* **Estudiante 2: Lógica de Datos y Criptografía**
  * **GitHub:** angel zavala
  * **Responsabilidad:** Persistencia DML segura, sentencias preparadas y hashing Bcrypt.

* **Estudiante 3: Oficial de Seguridad**
  * **GitHub:** yaxon parada
  * **Responsabilidad:** Control de acceso, validación de Capa 2 y manejo seguro de $_SESSION.

* **Estudiante 4: Ingeniero de Interfaz / UX**
  * **GitHub:** samuel flores
  * **Responsabilidad:** Ergonomía visual, Box Model (border-box) y validación interactiva CSS (:invalid).

* **Estudiante 5: Analista de Optimización**
  * **GitHub:** maraiana maryorga
  * **Responsabilidad:** Optimización DQL (LIMIT/OFFSET), prevención de Full Table Scans y gestión del DAG (Merges).
