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
			'path' => 'registro', 
			'label' => 'Registro', 
			'icon' => '<i class="fa fa-calendar "></i>','submenu' => array(
		array(
			'path' => 'registro/Index', 
			'label' => 'Registro Actual', 
			'icon' => '<i class="fa fa-calendar-check-o "></i>'
		),
		
		array(
			'path' => 'registro/add', 
			'label' => 'Crear Registro', 
			'icon' => '<i class="fa fa-calendar-plus-o "></i>'
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
			'label' => 'Productos', 
			'icon' => '<i class="fa fa-dashcube "></i>','submenu' => array(
		array(
			'path' => 'producto', 
			'label' => 'Lista de Productos', 
			'icon' => '<i class="fa fa-cubes "></i>'
		),
		
		array(
			'path' => 'producto/add', 
			'label' => 'Nuevo Producto', 
			'icon' => '<i class="fa fa-cube "></i>'
		),
		
		array(
			'path' => 'categoria', 
			'label' => 'Categoria de Productos', 
			'icon' => '<i class="fa fa-book "></i>','submenu' => array(
		array(
			'path' => 'categoria', 
			'label' => 'Lista de Categorias', 
			'icon' => '<i class="fa fa-bookmark "></i>'
		),
		
		array(
			'path' => 'categoria/add', 
			'label' => 'Nueva Categoria', 
			'icon' => '<i class="fa fa-bookmark-o "></i>'
		)
	)
		)
	)
		)
	);
		
	
	
			public static $producto_fk_proveedor = array();
		
}