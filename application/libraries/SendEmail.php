<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class SendEmail{
        public function __construct( $from_mail='becariosunica@ingenieria.unam.mx', $from_text='Programa IT-PRO', $password='G8a#nP%7'){
            
            $this->from_mail = $from_mail;
            $this->from_text = $from_text;
            $this->password = $password;
            $this->CI =& get_instance();
            $this->CI->load->library('email');
            
        }
    
        public function envia_correo($email_destino,$mensaje,$asunto){
            $config = array(
                'protocol'     => 'smtp',
                'smtp_crypto'   => 'ssl',
                'smtp_host'    => 'ingenieria.unam.mx',
                'smtp_port'    => '465',
                'smtp_timeout' => '7',
                'smtp_user'    => $this->from_mail,
                'smtp_pass'    => $this->password,
                'charset'      => 'utf-8',
                'newline'      => "\r\n",
                'mailtype'     => 'html',
                'validation'   => true
            );
            $this->CI->email->clear();
            $this->CI->email->initialize($config);
            $this->CI->email->from($this->from_mail, $this->from_text);
            $this->CI->email->to($email_destino);
            $this->CI->email->subject($asunto);
            $this->CI->email->message($mensaje );

            if ($this->CI->email->send()) {
                return true;
            }

            $this->CI->email->print_debugger();
            throw new Exception ('Error al enviar Email');
        }
 
    }
