# Zyla Labs 
## Test tecnico. Ortega Ayrton Laravel Developer

[![N|Solid](https://laravel.com/img/logotype.min.svg)](https://laravel.com/docs/9.x)

Se realizo API que guarde en una base de datos (MySQL) informacion del clima actual de una ciudad.
Las consultas retorna de una api de terceros proporcioanda por ustedes (https://weatherstack.com/).
En primera instancia consulta a la base de datos su existencia, si no obtenemos informacion realizamos la consulta a weatherstack, guardamos en nuestra base de datos y retornamos dicho valor. Si se consulta por una ciudad que tenemos en nuestra base de datos se verifica que dicha infromacion no sea desactualizada (maximo 1hs) si la informacion es menor a 1 hora se retorna valores de base de datos. si es mayor a una hora se consulta a weatherstack y actualizamos los datos a la base de datos.

##### Funcionalidades utilizadas en este proyecto

- Migraciones. 
- Relaciones
- GroupRoute
- Modelos
- Controladores
- Asignacion Masiva
- From Request
- Carbon
- Guzzle

## Explicacion

Para este Test elegi un modelo de base de datos relacional ya que podemos generar una estructura fuerte y escalable ¿Por que elegi desentralisar la informacion en varias tablas? porque de esta forma nos permite tener una posible escalabiliadad del proyecto y ademas un mayor dominio de datos.
En este caso solo utilizamos el clima actual, pero en un futuro podemos agregar mas, como por ejemplo un historico o un pronostico, por este mismo motivos elegui diferentes relaciones entre tablas.
Para el desarroyo de esta api generamos las tablas de la base de datos a traves de migraciones, y fueron relacionadas tanto a nivel tabla como a nivel modelos. Para el registro de datos se utilizo la validacion a traves del From-Request para seguir con las buenas practicas de laravel, logrando asi mantener los enstandares de codigo limpio y facil de mantener. Con el mismo criterio se decidio realizar asignaciones masivas con filiables en sus respectivos modelos. Como este test es algo simple decidi no realizar la utilizacion de service (ya que las buenas practicas dicen solo usar services en aplicaciones grandes). Pero en caso de que esta API se desee expandir, se recomienta trasladar la logica de negocio (funciones: httpClient, logica, store y update) que se encuentra en sus controladores a un service container.


## Como consumirla


Se puede consumir la api con la siguiente URL.

```sh
url('http://127.0.0.1:8000/api/current/New York');
o 
http://127.0.0.1:8000/api/current
    ? query = New York
```

Devolviento los datos actuales en formato JSON

```sh
{
    "request": {
        "type": "City",
        "query": "New York, United States of America",
        "language": "en",
        "unit": "m"
    },
    "location": {
        "name": "New York",
        "country": "United States of America",
        "region": "New York",
        "lat": "40.714",
        "lon": "-74.006",
        "timezone_id": "America/New_York",
        "localtime": "2019-09-07 08:14",
        "localtime_epoch": 1567844040,
        "utc_offset": "-4.0"
    },
    "current": {
        "observation_time": "12:14 PM",
        "temperature": 13,
        "weather_code": 113,
        "weather_icons": [
            "https://assets.weatherstack.com/images/wsymbols01_png_64/wsymbol_0001_sunny.png"
        ],
        "weather_descriptions": [
            "Sunny"
        ],
        "wind_speed": 0,
        "wind_degree": 349,
        "wind_dir": "N",
        "pressure": 1010,
        "precip": 0,
        "humidity": 90,
        "cloudcover": 0,
        "feelslike": 13,
        "uv_index": 4,
        "visibility": 16
    }
}
```
