# TP API-REST
# Integrantes:
Magalí Agustina Cejas Mazzocchi (B)

Ayelen Nataly Garcia Uriarte (A)

**En este trabajo se utilizará la tabla Actividades**
# ENDPOINTS

**GET**

-Para obtener un listado completo de actividades= https://localhost/Xsports-APIREST/api/actividad

-Para ORDENAR un campo de la tabla= https://localhost/Xsports-APIREST/api/actividad?orderBy=Calificación&orderDirection=DESC . (Si no se pone nada en orderDirection por defecto es ascendente)

-Para obtener una actividad en específico= https://localhost/Xsports-APIREST/api/actividad/2 . (El id de la actividad se puede visualizar en el GET para el listado completo observando el ID_Actividad)

**DELETE**

-Para eliminar una actividad= https://localhost/Xsports-APIREST/api/actividad/2 . (El id de la actividad se puede visualizar en el GET para el listado completo observando el ID_Actividad)

**PUT**

-Para editar una actividad= https://localhost/Xsports-APIREST/api/actividad/2 . (El id de la actividad se puede visualizar en el GET para el listado completo observando el ID_Actividad)

Los campos a editar son: horario,fecha,ID_Club(8=efectivo,9=débito,10=crédito) y Calificación.

Ejemplo: se edita en la seccion body

{
  "horario": "17:00:00",
  
  "fecha": "2024-09-16",
  
  "ID_Club": 8,
  
  "Calificación": 4
}

**POST**

-Para agregar una actividad= https://localhost/Xsports-APIREST/api/actividad 

Los campos a editar son: deporte,horario,fecha,ID_Club(8=efectivo,9=débito,10=crédito),ID_Categoria(1=Deportes acuáticos,2=Deportes de fuerza,3=Deportes en grupo,4=Danza,5=Deportes al aire libre,6=Atletismo,8=Hockey,26=Lucha Libre) ,suspendida=0 ,img(url) y Calificación.

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

# OPCIONALES
*Todas con verbo GET*

**Ordenamiento por cualquier campo de la tabla**

-Campos para ordenar:ID_Actividad,deporte,horario,fecha,Profesor,ID_Club,ID_Categoria,suspendida(siempre va a ser 0),img,Calificación,nombreCate y formaPago.

-Los campos de tipo varchar son ordenados alfabéticamente y  los de tipo int numéricamente

ej:https://localhost/Xsports-APIREST/api/actividad?orderBy=formaPago&orderDirection=DESC

(Si no se pone el orderDirection se ordena por defecto de manera Ascendente)

**Filtro por algún campo**

-Campos para filtrar= ID_Actividad,deporte,horario,fecha,Profesor,Calificación,nombreCate y formaPago.

-Valores= se recomienda fijarse de que tipo es el campo(varchar o int), y luego insertar el valor buscado. A continuación se observan algunos ejemplos para utilizar el filtrado.

ej ID_Actividad:https://localhost/Xsports-APIREST/api/actividad?filtrar=ID_Actividad&valor=20

ej deporte:https://localhost/Xsports-APIREST/api/actividad?filtrar=deporte&valor=Ritmos

ej horario:https://localhost/Xsports-APIREST/api/actividad?filtrar=horario&valor=17:00:00

ej Profesor:https://localhost/Xsports-APIREST/api/actividad?filtrar=Profesor&valor=Tomas Diaz

ej fecha: https://localhost/Xsports-APIREST/api/actividad?filtrar=fecha&valor=2024-09-16


**Paginación**

La paginación funciona de una manera similar a los filtros, solo que la página y el limite se miden mediante números(int) hasta que no haya más actividades.


ejemplo: https://localhost/Xsports-APIREST/api/actividad?pagina=1&limite=10  (La página 1 mostrara 10 actividades)

