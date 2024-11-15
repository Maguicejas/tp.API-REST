<?php
require_once 'App/Models/config.php';
class TaskModel {
    protected $db;

    public function __construct() {
       $this->db = new PDO("mysql:host=".MYSQL_HOST .
        ";dbname=".MYSQL_DB.";charset=utf8", 
        MYSQL_USER, MYSQL_PASS);
        $this->deploy();
    }
    private function deploy() {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
            if(count($tables) == 0) {
                $sql =<<<END

            END;
        $this->db->query($sql);
    }
    }

    //GET
    public function getItems($orderBy , $filtrar, $orderDirection,$valor,$pagina,$limite) {
        
        $sql= 
        'SELECT actividad.*, categoria.nombreCate, club.formaPago
            FROM actividad
            JOIN categoria ON actividad.ID_Categoria = categoria.ID_Categoria
            JOIN club ON actividad.ID_Club = club.ID_Club';
     
            $params=[];

        if($filtrar && $valor)
              {
                 $sql .= " WHERE $filtrar = ?";
                    $params[] = $valor;
              }

        if (strtoupper($orderDirection) === 'DESC') 
            {
                $orderDirection = 'DESC';
            } else {
                $orderDirection = 'ASC'; 
            }        


        if($orderBy) //ordena cualquier campo de la tabla
            { 
                $sql .= " ORDER BY $orderBy " . $orderDirection; 
            }

           
        //paginacion
        if($pagina !==null && $limite !==null   ) 
        {
            $desplazamiento = ($pagina - 1) * $limite;
            $sql .= ' LIMIT ' .(int)$limite . ' OFFSET ' . (int)$desplazamiento; //asegura que los valores sean números enteros
        }
        


        $query= $this->db->prepare($sql);
        $query->execute($params);
        
        $tasks = $query->fetchAll(PDO::FETCH_OBJ); 
        
        return $tasks;
}


    public function getActividad($id) {    
        $query = $this->db->prepare('SELECT actividad.*, categoria.nombreCate, club.formaPago
            FROM actividad
            JOIN categoria ON actividad.ID_Categoria = categoria.ID_Categoria
            JOIN club ON actividad.ID_Club = club.ID_Club
            WHERE ID_Actividad = ?');

        $query->execute([$id]);   
    
        $task = $query->fetch(PDO::FETCH_OBJ);
    
        return $task;
    }
  


    //POST
    public function insertActividad($depor,$hora,$dia,$profe,$pago,$cate,$suspendida= false,$imagen,$cali) { 
        $query = $this->db->prepare('INSERT INTO actividad(deporte,horario,fecha,Profesor,ID_Club,ID_Categoria,suspendida,img,Calificación) VALUES (?,?,?,?,?,?,?,?,?)');
        
        $query->execute([$depor,$hora,$dia,$profe,$pago, $cate,$suspendida,$imagen,$cali]);
    
        $id = $this->db->lastInsertId();
    
       return $id;
       
    }
    
   //DELETE
    public function borrarActividad($id) {
        $query = $this->db->prepare('DELETE FROM actividad WHERE ID_Actividad = ?');

        $query->execute([$id]);
    }
    
    //PUT
     public function editarActi($hora,$dia,$pago,$cali,$id){

        $query=$this->db->prepare('UPDATE  actividad
        SET horario= ? , fecha=? , ID_Club=? , Calificación =?
        WHERE ID_Actividad= ?');

        $query->execute([$hora,$dia,$pago,$cali, $id]);
        
        }
    
    }


