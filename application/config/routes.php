<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'LoginBecariosWeb';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['translate_uri_dashes'] = FALSE;

$route['prebecario'] = 'RegistroPrebecarioAPI/solicitud_prebecario';
$route['solicitudRegistro'] = 'RegistroPrebecarioAPI/solicitud_registro';

$route['cargaSolicitudRegistro']='RegistroPrebecarioWEB/solicitud/';
$route['registro_exitoso']='RegistroPrebecarioWEB/registro_exitoso';
$route['registrar_solicitud']='RegistroPrebecarioWEB/registrar_solicitud';


/********************************************
    RUTAS PARA EL  SISTEMA DE BECARIOS
********************************************/

//API
/*
$route['api/ingreso']='becarios/LoginAPI/datos_usuario_sesion';
$route['api/generaciones']='becarios/GeneracionesAPI/obten_generaciones_descendente';
$route['api/generacion/(:num)/alumnos_cursos']='becarios/ElementosDependientesGeneracionAPI/obten_alumnos_cursos_generacion/id_generacion/$1';
$route['api/solicitud_prebecario']='becarios/ElementosDependientesGeneracionAPI/datos_solicitud';

$route['api/generaciones/(:num)/solicitudes_becarios/(:num)']='becarios/SeccionPersonalesAlumnoAPI/obten_solicitud_personal_alumno/id_alumno/$2/id_generacion/$1';

$route['api/nota_solicitud']='becarios/SeccionPersonalesAlumnoAPI/nota_solicitud';
*/
//  Requeridas por Emmanuel Rodríguez sistema Valhalla
//Obtienen la última solicitud ingresada por el/los alumnos
$route['api/alumnos/(:num)/solicitud']='SolicitudesAPI/ultima_solicitud_alumno/numero_cuenta/$1';
$route['api/solicitud']='SolicitudesAPI/ultima_solicitud';

//WEB
$route['login'] = 'becarios/LoginBecariosWeb';
$route['ingreso'] = 'becarios/LoginBecariosWeb/datos_usuario_sesion';
$route['logout'] = 'becarios/LoginBecariosWeb/teminar_sesion';
$route['bienvenido'] = 'becarios/LoginBecariosWeb/bienvenido';

    //Para administrador
$route['seleccion_generacion'] = 'becarios/administrador/SolicitudesGeneracionesWeb/seleccion_generacion';
$route['generacion/(:num)/alumnos_cursos']='becarios/administrador/SolicitudesGeneracionesWeb/obten_solicitudes_generacion/$1';
$route['actualiza_datos_solicitud']='becarios/administrador/SolicitudesGeneracionesWeb/actualiza_solicitud_generacion';
$route['generaciones/(:num)/solicitudes_becarios/(:num)']='becarios/administrador/SolicitudesGeneracionesWeb/obten_solicitud_alumno_generacion/$1/$2';
$route['generaciones/(:num)/solicitudes_becarios/(:num)/impresion']='becarios/administrador/SolicitudesGeneracionesWeb/imprime_solicitud_alumno_generacion/$1/$2';
$route['alumnos/(:num)/post_historial_academico'] = 'becarios/administrador/AlumnoWeb/post_historial/$1';

$route['actualiza_nota_solicitud']='becarios/administrador/SolicitudesGeneracionesWeb/actualiza_nota_solicitud';