<?php
require_once 'App/Models/model.php';
require_once 'App/Views/jsonView.php';

Class ApiController{
    private $modelo;
    private $vista;

    public function __construct() {
        $this->modelo = new TaskModel();
        $this->vista = new JSONView();
    }

    //GET
    public function getAllActividades($req,$res){
        
           $filtrar= null;
           if(isset($req->query->filtrar)) {
            $filtrar = $req->query->filtrar;

             switch($filtrar){
                    case 'deporte':
                        $filtrar = $req->query->filtrar;break;
                    case 'ID_Actividad':
                        $filtrar = $req->query->filtrar;break;
                    case 'horario':
                        $filtrar = $req->query->filtrar;break;
                    case 'fecha':
                            $filtrar = $req->query->filtrar;break;
                    case 'Profesor':
                        $filtrar = $req->query->filtrar;break;
                               
                    case 'Calificación':
                        $filtrar = $req->query->filtrar;break;
                    case 'nombreCate':
                        $filtrar = $req->query->filtrar;break;
                    case 'formaPago':
                        $filtrar = $req->query->filtrar;break;
                                        
                                
                   default: return $this->vista->response("El campo cargado es erróneo", 400);
            } 
           }
        
            $valor= null;
            if(isset($req->query->valor)) {
            $valor = $req->query->valor;
                 if($valor < 0) {
                return $this->vista->response("El número debe ser positivo", 400);
            }
             }
            

            $orderDirection = 'ASC';
            if (isset($req->query->orderDirection)) {
                $orderDirection = $req->query->orderDirection;
            }
        
           $orderBy = false;
        if(isset($req->query->orderBy)){
           $orderBy = $req->query->orderBy;
            
           switch($orderBy){
                case 'deporte':
                    $orderBy = $req->query->orderBy;break;
                case 'ID_Actividad':
                    $orderBy = $req->query->orderBy;break;
                case 'horario':
                    $orderBy= $req->query->orderBy;break;
                case 'fecha':
                    $orderBy = $req->query->orderBy;break;
                case 'Profesor':
                    $orderBy = $req->query->orderBy;break;
                case 'ID_Club':
                    $orderBy = $req->query->orderBy;break;
                 case 'ID_Categoria':
                    $orderBy = $req->query->orderBy;break;  
                case 'img':
                    $orderBy = $req->query->orderBy;break;   
                case 'suspendida':
                    $orderBy = $req->query->orderBy;break;
                case 'Calificación':
                    $orderBy = $req->query->orderBy;break;
                case 'nombreCate':
                    $orderBy = $req->query->orderBy;break;
                case 'formaPago':
                    $orderBy = $req->query->orderBy;break;
                                    
                            
               default: return $this->vista->response("El campo cargado es erróneo", 400);
        } 
        
        }
           

        
           $pagina = 1;
               if(isset($req->query->pagina)) {
                   $pagina = $req->query->pagina;
                    if($pagina < 0) {
                    return $this->vista->response("El número debe ser positivo", 400);
               }
           }
   
           $limite=null;
              if(isset($req->query->limite)) {
                $limite = $req->query->limite;
                   if($limite < 0) {
                    return $this->vista->response("El número debe ser positivo", 400);
            }
        }
        
        $tasks = $this->modelo->getItems($orderBy,$filtrar,$orderDirection,$valor,$pagina,$limite);
        
        // mando las tareas a la vista
        return $this->vista->response($tasks);

    }
     
    //GET/:id
    public function getActividad($req, $res) {
       
        $id = $req->params->id;

        $task = $this->modelo->getActividad($id);

        if(!$task) {
            return $this->vista->response("La actividad con el id=$id no existe", 404);
        }

        return $this->vista->response($task);
    }
    
    //DELETE
    public function eliminar($req, $res) {
        $id= $req->params->id;

        $acti = $this->modelo->getActividad($id);

        if(!$acti){
            return $this->vista->response("La actividad con el id=$id no existe", 404);
        }

        $this->modelo->borrarActividad($id);
        $this->vista->response("La actividad con el id=$id se eliminó con éxito", 200);
    }

    //POST
    public function agregar($req, $res) {
        if(
          empty($req->body->deporte) || empty($req->body->horario)  ||
          empty($req->body->fecha)   || empty($req->body->Profesor) || 
          empty($req->body->ID_Club) || empty($req->body->ID_Categoria) || 
          empty($req->body->Calificación)
        ) 
        {
            return $this->vista->response("Faltan completar datos", 400); 
        }

    
        $deporte = $req->body->deporte;
        $horario = $req->body->horario;
        $fecha= $req->body->fecha;
        $profe = $req->body->Profesor;
        $idClub = $req->body->ID_Club;
        $idcategoria = $req->body->ID_Categoria;
        $suspendida = $req->body->suspendida;
        $img = $req->body->img;
        $calificacion = $req->body->Calificación;
        


        $idNuevo = $this->modelo->insertActividad($deporte,$horario,$fecha,$profe,$idClub,$idcategoria,$suspendida,$img,$calificacion);

        if (!$idNuevo) {
            return $this->vista->response("Error al insertar la tarea", 500);
        }

        $producto = $this->modelo->getActividad($idNuevo);
        return $this->vista->response($producto, 201);
    }


    //PUT
    public function modificar($req,$res){
        $id = $req->params->id; 

        $task = $this->modelo->getActividad($id);

        if (!$task) {
            return $this->vista->response("La activdad con el id=$id no existe", 404);
        }

         if (empty($req->body->horario) || empty($req->body->fecha)|| empty($req->body->ID_Club) || empty($req->body->Calificación)) {
            return $this->vista->response('Faltan completar datos', 400);
        }

        $horario = $req->body->horario;       
        $dia = $req->body->fecha;       
        $pago = $req->body->ID_Club;
        $cali = $req->body->Calificación;

        $this->modelo->editarActi($horario,$dia,$pago,$cali,$id);

        $task = $this->modelo->getActividad($id);
        $this->vista->response($task, 200);
       

    }


}

