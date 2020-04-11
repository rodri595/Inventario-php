<?php
/**
 * Menu Items
 * All Project Menu
 * @category  Menu List
 */

class Menu{
	
	
			public static $navbartopleft = array(
		array(
			'path' => 'home', 
			'label' => 'Home', 
			'icon' => '<i class="fa fa-home "></i>'
		),
		
		array(
			'path' => 'ficha', 
			'label' => 'Ficha', 
			'icon' => '<i class="fa fa-calendar "></i>','submenu' => array(
		array(
			'path' => 'ficha', 
			'label' => 'Lista de Fichas', 
			'icon' => '<i class="fa fa-calendar-check-o "></i>'
		),
		
		array(
			'path' => 'ficha/add', 
			'label' => 'Crear Ficha', 
			'icon' => '<i class="fa fa-calendar-o "></i>'
		)
	)
		),
		
		array(
			'path' => 'proveedor', 
			'label' => 'Proveedor', 
			'icon' => '<i class="fa fa-plane "></i>','submenu' => array(
		array(
			'path' => 'proveedor', 
			'label' => 'Lista de Proveedores', 
			'icon' => '<i class="fa fa-paper-plane "></i>'
		),
		
		array(
			'path' => 'proveedor/add', 
			'label' => 'Nuevo Proveedor', 
			'icon' => '<i class="fa fa-paper-plane-o "></i>'
		)
	)
		),
		
		array(
			'path' => 'usuario', 
			'label' => 'Usuario', 
			'icon' => '<i class="fa fa-user "></i>','submenu' => array(
		array(
			'path' => 'usuario', 
			'label' => 'Lista de Usuario', 
			'icon' => '<i class="fa fa-users "></i>'
		),
		
		array(
			'path' => 'usuario/add', 
			'label' => 'Crear Usuario', 
			'icon' => '<i class="fa fa-user-plus "></i>'
		)
	)
		),
		
		array(
			'path' => 'centro', 
			'label' => 'Centro Medico', 
			'icon' => '<i class="fa fa-simplybuilt "></i>','submenu' => array(
		array(
			'path' => 'centro', 
			'label' => 'Lista de Centros', 
			'icon' => '<i class="fa fa-building "></i>'
		),
		
		array(
			'path' => 'centro/add', 
			'label' => 'Crear Centro', 
			'icon' => '<i class="fa fa-building-o "></i>'
		)
	)
		),
		
		array(
			'path' => 'producto', 
			'label' => 'Producto', 
			'icon' => '<i class="fa fa-dashcube "></i>','submenu' => array(
		array(
			'path' => 'producto', 
			'label' => 'Lista de Productos', 
			'icon' => '<i class="fa fa-cubes "></i>'
		),
		
		array(
			'path' => 'producto/add', 
			'label' => 'Crear Nuevo Producto', 
			'icon' => '<i class="fa fa-cube "></i>'
		)
	)
		),
		
		array(
			'path' => 'movmientos', 
			'label' => 'Movimientos', 
			'icon' => '<i class="fa fa-truck "></i>','submenu' => array(
		array(
			'path' => 'envio', 
			'label' => 'Envios', 
			'icon' => '<i class="fa fa-send-o "></i>','submenu' => array(
		array(
			'path' => 'enviado', 
			'label' => 'Lista de Envios', 
			'icon' => '<i class="fa fa-list "></i>'
		),
		
		array(
			'path' => 'enviado/add', 
			'label' => 'Crear Movimiento de Envio', 
			'icon' => '<i class="fa fa-truck "></i>'
		)
	)
		),
		
		array(
			'path' => 'recibido', 
			'label' => 'Recibido', 
			'icon' => '<i class="fa fa-inbox "></i>','submenu' => array(
		array(
			'path' => 'recibido', 
			'label' => 'Lista de Recibido', 
			'icon' => '<i class="fa fa-list-alt "></i>'
		),
		
		array(
			'path' => 'recibido/add', 
			'label' => 'Crear Movimiento de Recibidos', 
			'icon' => '<i class="fa fa-truck "></i>'
		)
	)
		)
	)
		)
	);
		
	
	
}