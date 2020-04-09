<?php 
/**
 * Producto Page Controller
 * @category  Controller
 */
class ProductoController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "producto";
	}
	/**
     * List page records
     * @param $fieldname (filter record by a field) 
     * @param $fieldvalue (filter field value)
     * @return BaseView
     */
	function index($fieldname = null , $fieldvalue = null){
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$fields = array("producto.id_producto", 
			"producto.nombre_producto", 
			"producto.desc_producto", 
			"producto.precio_producto", 
			"producto.cantidad_producto", 
			"producto.peso_producto", 
			"producto.dimension_producto", 
			"producto.fk_proveedor", 
			"proveedor.nombre_proveedor AS proveedor_nombre_proveedor", 
			"producto.fk_categoria", 
			"categoria.desc_categoria AS categoria_desc_categoria", 
			"producto.fecha_creacion", 
			"producto.creadopor_producto", 
			"usuario.user_usuario AS usuario_user_usuario");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				producto.id_producto LIKE ? OR 
				producto.nombre_producto LIKE ? OR 
				producto.desc_producto LIKE ? OR 
				producto.precio_producto LIKE ? OR 
				producto.cantidad_producto LIKE ? OR 
				producto.peso_producto LIKE ? OR 
				producto.dimension_producto LIKE ? OR 
				producto.fk_proveedor LIKE ? OR 
				producto.fk_categoria LIKE ? OR 
				producto.fecha_creacion LIKE ? OR 
				producto.fecha_ultima_update LIKE ? OR 
				producto.fecha_delete LIKE ? OR 
				producto.isdeleted LIKE ? OR 
				producto.creadopor_producto LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "producto/search.php";
		}
		$db->join("proveedor", "producto.fk_proveedor = proveedor.id_proveedor", "INNER");
		$db->join("categoria", "producto.fk_categoria = categoria.id_categoria", "INNER");
		$db->join("usuario", "producto.creadopor_producto = usuario.id_usuario", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("producto.id_producto", ORDER_TYPE);
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
		}
		if(!empty($request->producto_fecha_creacion)){
			$val = $request->producto_fecha_creacion;
			$db->where("DATE(producto.fecha_creacion)", $val , "=");
		}
		if(!empty($request->producto_fk_proveedor)){
			$val = $request->producto_fk_proveedor;
			$db->where("producto.fk_proveedor", $val , "=");
		}
		if(!empty($request->producto_nombre_producto)){
			$vals = $request->producto_nombre_producto;
			$db->where("producto.nombre_producto", $vals, "IN");
		}
		if(!empty($request->producto_peso_producto)){
			$vals = explode("-", str_replace(" ", "", $request->producto_peso_producto));
			$from = $vals[0];
			$to = $vals[1];
			$db->where("producto.peso_producto BETWEEN $from AND $to");
		}
		$tc = $db->withTotalCount();
		$records = $db->get($tablename, $pagination, $fields);
		$records_count = count($records);
		$total_records = intval($tc->totalCount);
		$page_limit = $pagination[1];
		$total_pages = ceil($total_records / $page_limit);
		$data = new stdClass;
		$data->records = $records;
		$data->record_count = $records_count;
		$data->total_records = $total_records;
		$data->total_page = $total_pages;
		if($db->getLastError()){
			$this->set_page_error();
		}
		$page_title = $this->view->page_title = get_lang('producto');
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("producto/list.php", $data); //render the full page
	}
	/**
     * View record detail 
	 * @param $rec_id (select record by table primary key) 
     * @param $value value (select record by value of field name(rec_id))
     * @return BaseView
     */
	function view($rec_id = null, $value = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = urldecode($rec_id);
		$tablename = $this->tablename;
		$fields = array("producto.id_producto", 
			"producto.nombre_producto", 
			"producto.desc_producto", 
			"producto.cantidad_producto", 
			"producto.peso_producto", 
			"producto.dimension_producto", 
			"producto.fk_proveedor", 
			"proveedor.nombre_proveedor AS proveedor_nombre_proveedor", 
			"producto.fk_categoria", 
			"categoria.desc_categoria AS categoria_desc_categoria", 
			"producto.fecha_creacion", 
			"producto.fecha_ultima_update", 
			"producto.fecha_delete", 
			"producto.isdeleted", 
			"producto.precio_producto", 
			"producto.creadopor_producto", 
			"usuario.user_usuario AS usuario_user_usuario");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("producto.id_producto", $rec_id);; //select record based on primary key
		}
		$db->join("proveedor", "producto.fk_proveedor = proveedor.id_proveedor", "INNER");
		$db->join("categoria", "producto.fk_categoria = categoria.id_categoria", "INNER");
		$db->join("usuario", "producto.creadopor_producto = usuario.id_usuario", "INNER");  
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = get_lang('view_producto');
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		}
		else{
			if($db->getLastError()){
				$this->set_page_error();
			}
			else{
				$this->set_page_error(get_lang('no_record_found'));
			}
		}
		return $this->render_view("producto/view.php", $record);
	}
	/**
     * Insert new record to the database table
	 * @param $formdata array() from $_POST
     * @return BaseView
     */
	function add($formdata = null){
		if($formdata){
			$db = $this->GetModel();
			$tablename = $this->tablename;
			$request = $this->request;
			//fillable fields
			$fields = $this->fields = array("nombre_producto","precio_producto","desc_producto","cantidad_producto","peso_producto","dimension_producto","fk_proveedor","fk_categoria","creadopor_producto");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'nombre_producto' => 'required',
				'precio_producto' => 'required|numeric',
				'desc_producto' => 'required',
				'cantidad_producto' => 'required',
				'peso_producto' => 'required',
				'dimension_producto' => 'required',
				'fk_proveedor' => 'required',
				'fk_categoria' => 'required',
				'creadopor_producto' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'nombre_producto' => 'sanitize_string',
				'precio_producto' => 'sanitize_string',
				'desc_producto' => 'sanitize_string',
				'cantidad_producto' => 'sanitize_string',
				'peso_producto' => 'sanitize_string',
				'dimension_producto' => 'sanitize_string',
				'fk_proveedor' => 'sanitize_string',
				'fk_categoria' => 'sanitize_string',
				'creadopor_producto' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg(get_lang('record_added_successfully'), "success");
					return	$this->redirect("producto");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = get_lang('add_new_producto');
		$this->render_view("producto/add.php");
	}
	/**
     * Update table record with formdata
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit($rec_id = null, $formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id_producto","nombre_producto","precio_producto","desc_producto","cantidad_producto","peso_producto","dimension_producto","fk_proveedor","fk_categoria","creadopor_producto");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'nombre_producto' => 'required',
				'precio_producto' => 'required|numeric',
				'desc_producto' => 'required',
				'cantidad_producto' => 'required',
				'peso_producto' => 'required',
				'dimension_producto' => 'required',
				'fk_proveedor' => 'required',
				'fk_categoria' => 'required',
				'creadopor_producto' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'nombre_producto' => 'sanitize_string',
				'precio_producto' => 'sanitize_string',
				'desc_producto' => 'sanitize_string',
				'cantidad_producto' => 'sanitize_string',
				'peso_producto' => 'sanitize_string',
				'dimension_producto' => 'sanitize_string',
				'fk_proveedor' => 'sanitize_string',
				'fk_categoria' => 'sanitize_string',
				'creadopor_producto' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("producto.id_producto", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg(get_lang('record_updated_successfully'), "success");
					return $this->redirect("producto");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$page_error = get_lang('no_record_updated');
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						return	$this->redirect("producto");
					}
				}
			}
		}
		$db->where("producto.id_producto", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = get_lang('edit_producto');
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("producto/edit.php", $data);
	}
	/**
     * Update single field
	 * @param $rec_id (select record by table primary key)
	 * @param $formdata array() from $_POST
     * @return array
     */
	function editfield($rec_id = null, $formdata = null){
		$db = $this->GetModel();
		$this->rec_id = $rec_id;
		$tablename = $this->tablename;
		//editable fields
		$fields = $this->fields = array("id_producto","nombre_producto","precio_producto","desc_producto","cantidad_producto","peso_producto","dimension_producto","fk_proveedor","fk_categoria","creadopor_producto");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'nombre_producto' => 'required',
				'precio_producto' => 'required|numeric',
				'desc_producto' => 'required',
				'cantidad_producto' => 'required',
				'peso_producto' => 'required',
				'dimension_producto' => 'required',
				'fk_proveedor' => 'required',
				'fk_categoria' => 'required',
				'creadopor_producto' => 'required|numeric',
			);
			$this->sanitize_array = array(
				'nombre_producto' => 'sanitize_string',
				'precio_producto' => 'sanitize_string',
				'desc_producto' => 'sanitize_string',
				'cantidad_producto' => 'sanitize_string',
				'peso_producto' => 'sanitize_string',
				'dimension_producto' => 'sanitize_string',
				'fk_proveedor' => 'sanitize_string',
				'fk_categoria' => 'sanitize_string',
				'creadopor_producto' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("producto.id_producto", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount();
				if($bool && $numRows){
					return render_json(
						array(
							'num_rows' =>$numRows,
							'rec_id' =>$rec_id,
						)
					);
				}
				else{
					if($db->getLastError()){
						$page_error = $db->getLastError();
					}
					elseif(!$numRows){
						$page_error = get_lang('no_record_updated');
					}
					render_error($page_error);
				}
			}
			else{
				render_error($this->view->page_error);
			}
		}
		return null;
	}
	/**
     * Delete record from the database
	 * Support multi delete by separating record id by comma.
     * @return BaseView
     */
	function delete($rec_id = null){
		Csrf::cross_check();
		$request = $this->request;
		$db = $this->GetModel();
		$tablename = $this->tablename;
		$this->rec_id = $rec_id;
		//form multiple delete, split record id separated by comma into array
		$arr_rec_id = array_map('trim', explode(",", $rec_id));
		$db->where("producto.id_producto", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg(get_lang('record_deleted_successfully'), "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("producto");
	}
}
