# ⏲ TIMERX ⏲

### ¿Que es TIMERX?
TIMERX es una aplicación creada para llevar el registro de entrada y salida del personal de tu empresa, ademas de poder gestionar tu plantilla agregando nuevos empleados o modificandolos.

### 💿 Tecnologias empleadas BACKEND
- [PHP](https://www.php.net/docs.php)
- [Composer](https://getcomposer.org/)
- [Laravel](https://laravel.com/docs/8.x)
- [MySQL](https://www.mysql.com/)


### 📍 Endpoints Disponibles
###### Deploy: https://worklog-app-backend.herokuapp.com/
---
| Metodo | Endpoint |
| ------ | ------ |
| POST | /api/user/register |
|  | /api/user/login |
|  | /api/user/logout |
|  | /api/user/search_one |
|  | /api/log/start/{id} |
| POST, GET | /apilog/showone/ |
| PUT | /api/user/update |
|  | /api/log/update.stop/{id} |
|  | /api/log/update.startpause/{id} |
|  | /api/log/update.endpause/{id} |
| DELETE | /api/admin/delete/{id} |


Licencia
----

MIT


**Software gratuito**