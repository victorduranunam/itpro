<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AccesoModel extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->ip=$this->getIP();
        date_default_timezone_set('America/Mexico_City');
    }


    public function login_usuario($usuario,$contrasena){
        $this->db->start_cache();
        $usuario = $this->db->
            select('id_usuario, usuario, nombre,apellido_paterno,apellido_materno,tipo_usuario')
            ->from('usuario')
            ->join('cat_tipo_usuario', 'usuario.id_tipo_usuario = cat_tipo_usuario.id_tipo_usuario')
            ->where('usuario',$usuario)
            ->where('contrasena', sha1($contrasena))
            ->get();
        if ($usuario->num_rows() ==1){
            $usuario = $usuario->result();
            $this->db->stop_cache();
            $this->db->flush_cache();

            return $usuario[0];
        }
        $this->db->stop_cache();
        $this->db->flush_cache();

        throw new Exception ('Datos de acceso incorrectos');
    }


    /*Para validar los intentos de acceso de los usuarios*/
    private function getIP(){
        if (isset($_SERVER["HTTP_CLIENT_IP"])){
            return $_SERVER["HTTP_CLIENT_IP"];
        }elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        }elseif (isset($_SERVER["HTTP_X_FORWARDED"])){
            return $_SERVER["HTTP_X_FORWARDED"];
        }elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])){
            return $_SERVER["HTTP_FORWARDED_FOR"];
        }elseif (isset($_SERVER["HTTP_FORWARDED"])){
            return $_SERVER["HTTP_FORWARDED"];
        }else{
            return $_SERVER["REMOTE_ADDR"];
        }
    }  


    //agrega un intento fallido de inicio de sesión, 
	public function addLoginAttempt() {
        //Increase number of attempts. Set last login attempt if required.
        $this->db->start_cache();
        $intento = $this->db 
            ->where ('ip', $this->ip)
            ->get('logginattempts');
        $this->db->stop_cache();
        $this->db->flush_cache();

        $this->db->start_cache();
        if ($intento->num_rows() == 1){
                
            $intentos = $intento->result();
            
            $intentos = $intentos[0]->attempts + 1;
            $this->db
                ->set('attempts', $intentos)
                ->where('ip', $this->ip);
            if($intentos==3) {
                $this->db->set('lastlogin',date("Y-m-d H:i:s"));             
            }
            $this->db->update('logginattempts');
        }else {
            $this->db
                ->set('attempts', 1)
                ->set('ip', $this->ip)
                ->set('lastlogin',date("Y-m-d H:i:s"))
                ->insert('logginattempts');
        }
        
        $lineas_afectadas = $this->db->affected_rows() ;
        $this->db->stop_cache();
        $this->db->flush_cache();
    }	

    public function clearLoginAttempts() {
        $this->db->start_cache();
        $this->db
            ->set('attempts',0)
            ->where('ip', $this->ip)
            ->update('logginattempts');
        if ($this->db->affected_rows() == 1){
            $this->db->stop_cache();
            $this->db->flush_cache();

            return true;
        }
        $this->db->stop_cache();
        $this->db->flush_cache();

        return false;
    }

    public function confirmIPAddress() { 
        $this->db->start_cache();
        $q = "SELECT attempts, (CASE when lastlogin is not NULL and (lastlogin + INTERVAL '2 minute'>NOW()) then 1 else 0 end) as denied FROM logginattempts WHERE ip = '".$this->ip."';"; 
       
        $result = $this->db->query($q);
        
        $data = $result-> result();
        if (count ($data)==0){
            return true;
        }
        $data=$data[0];
        
        if ($data->attempts >= 3) { 
            
            if($data->denied == 1) { 
                return false; 
            }else{ 
                $this->db->stop_cache();
                $this->db->flush_cache();

                $this->clearLoginAttempts(); 
                return true; 
            } 
        } 
        $this->db->stop_cache();
        $this->db->flush_cache();

        return true; 
    } 
    
}