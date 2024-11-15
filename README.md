# TP API-REST
# Integrantes:
Magalí Agustina Cejas Mazzocchi (B)

Ayelen Nataly Garcia Uriarte (A)
**En este trabajo se utilizará la tabla Actividades**
#ENDPOINTS

**GET**

-Para obtener un listado completo de actividades= https://localhost/Xsports-APIREST/api/actividad
-Para obtener una actividad en específico= https://localhost/Xsports-APIREST/api/actividad/2 . (El id de la actividad se puede visualizar en el GET para listar observando el ID_Actividad)

**DELETE**

-Para eliminar una actividad= https://localhost/Xsports-APIREST/api/actividad/2 . (El id de la actividad se puede visualizar en el GET para listar observando el ID_Actividad)

**PUT**

-Para editar una actividad= https://localhost/Xsports-APIREST/api/actividad/2 . (El id de la actividad se puede visualizar en el GET para listar observando el ID_Actividad)

Los campos a editar son: horario,fecha,ID_Club(8=efectivo,9=débito,10=crédito) y Calificación.
Ejemplo: se edita en la seccion body

{
  "horario": "17:00:00",
  
  "fecha": "2024-09-16",
  
  "ID_Club": 8,
  
  "Calificación": 4
}

**POST**
-Para agregar una actividad= https://localhost/Xsports-APIREST/api/actividad . 
Los campos a editar son: deporte,horario,fecha,ID_Club(8=efectivo,9=débito,10=crédito),ID_Categoria(1=Deportes acuáticos,2=Deportes de fuerza,3=Deportes en grupo,4=Danza,5=Deportes al aire libre,6=Atletismo,8=Hockey,26=Lucha Libre) ,suspendidad=0 ,img y Calificación.
Ejemplo: se edita en la seccion body
{
  "deporte": "Water-Polo",
  
  "horario": "18:00:00",
  
  "fecha": "2024-11-16",
  
  "Profesor": "Franco Gilona",
  
  "ID_Club": 8,
  
  "ID_Categoria": 1,
  
  "suspendida": 0,
  
  "img": "",
  
  "Calificación": 5
}

#OPCIONALES
