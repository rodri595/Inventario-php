<?php 
/**
 * Ficha Page Controller
 * @category  Controller
 */
class FichaController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "ficha";
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
		$fields = array("ficha.id", 
			"ficha.fecha", 
			"producto.nombre_producto AS producto_nombre_producto", 
			"detalle_registro.fk_cantidad AS detalle_registro_fk_cantidad", 
			"producto.cantidad_producto AS producto_cantidad_producto", 
			"enviado.id_enviado AS enviado_id_enviado", 
			"enviado.fecha_enviado AS enviado_fecha_enviado", 
			"centro.Nombre_centro AS centro_Nombre_centro", 
			"enviado.png AS enviado_png", 
			"recibido.id_recibido AS recibido_id_recibido", 
			"recibido.fecha_recibido AS recibido_fecha_recibido", 
			"centro2.Nombre_centro AS centro2_Nombre_centro", 
			"recibido.png AS recibido_png", 
			"ficha.fk_receptor", 
			"recibido.lugar_recibido AS recibido_lugar_recibido", 
			"ficha.fk_emisor", 
			"enviado.lugar_salida AS enviado_lugar_salida");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				ficha.id LIKE ? OR 
				ficha.fecha LIKE ? OR 
				producto.nombre_producto LIKE ? OR 
				detalle_registro.fk_cantidad LIKE ? OR 
				producto.cantidad_producto LIKE ? OR 
				enviado.id_enviado LIKE ? OR 
				enviado.fecha_enviado LIKE ? OR 
				centro.Nombre_centro LIKE ? OR 
				enviado.png LIKE ? OR 
				recibido.id_recibido LIKE ? OR 
				recibido.fecha_recibido LIKE ? OR 
				centro2.Nombre_centro LIKE ? OR 
				recibido.png LIKE ? OR 
				ficha.fk_receptor LIKE ? OR 
				centro2.Tel_centro LIKE ? OR 
				ficha.fk_emisor LIKE ? OR 
				centro2.id_centro LIKE ? OR 
				centro2.numero_centro LIKE ? OR 
				centro2.direccion_centro LIKE ? OR 
				centro2.fecha_creacion LIKE ? OR 
				ficha.user_created LIKE ? OR 
				enviado.lugar_salida LIKE ? OR 
				enviado.creacion LIKE ? OR 
				enviado.user_created LIKE ? OR 
				recibido.lugar_recibido LIKE ? OR 
				recibido.creacion LIKE ? OR 
				recibido.user_created LIKE ? OR 
				producto.id_producto LIKE ? OR 
				centro.Tel_centro LIKE ? OR 
				centro.id_centro LIKE ? OR 
				centro.numero_centro LIKE ? OR 
				centro.direccion_centro LIKE ? OR 
				centro.fecha_creacion LIKE ? OR 
				centro.user_created LIKE ? OR 
				centro2.user_created LIKE ? OR 
				detalle_registro.id_detalle_registro LIKE ? OR 
				detalle_registro.fk_registro LIKE ? OR 
				detalle_registro.fk_producto LIKE ? OR 
				detalle_registro.desc_detalle LIKE ? OR 
				detalle_registro.user_created LIKE ? OR 
				producto.desc_producto LIKE ? OR 
				producto.peso_producto LIKE ? OR 
				producto.dimension_producto LIKE ? OR 
				producto.fk_proveedor LIKE ? OR 
				producto.fk_categoria LIKE ? OR 
				producto.fecha_creacion LIKE ? OR 
				producto.precio_producto LIKE ? OR 
				producto.user_created LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "ficha/search.php";
		}
		$db->join("enviado", "ficha.fk_emisor = enviado.id_enviado", "INNER");
		$db->join("recibido", "ficha.fk_receptor = recibido.id_recibido", "INNER");
		$db->join("centro", "enviado.lugar_salida = centro.id_centro", "INNER");
		$db->join("centro AS centro2", "recibido.lugar_recibido = centro2.id_centro", "INNER");
		$db->join("detalle_registro", "ficha.id = detalle_registro.fk_registro", "INNER");
		$db->join("producto", "detalle_registro.fk_producto = producto.id_producto", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("ficha.id", ORDER_TYPE);
		}
		if($fieldname){
			$db->where($fieldname , $fieldvalue); //filter by a single field name
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
		$page_title = $this->view->page_title = get_lang('registro_');
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("ficha/list.php", $data); //render the full page
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
		$fields = array("ficha.id", 
			"ficha.fecha", 
			"ficha.fk_receptor", 
			"recibido.lugar_recibido AS recibido_lugar_recibido", 
			"enviado.id_enviado AS enviado_id_enviado", 
			"enviado.fecha_enviado AS enviado_fecha_enviado", 
			"enviado.png AS enviado_png", 
			"centro.Nombre_centro AS centro_Nombre_centro", 
			"centro.Tel_centro AS centro_Tel_centro", 
			"centro.direccion_centro AS centro_direccion_centro", 
			"centro.numero_centro AS centro_numero_centro", 
			"ficha.fk_emisor", 
			"enviado.lugar_salida AS enviado_lugar_salida", 
			"recibido.id_recibido AS recibido_id_recibido", 
			"recibido.fecha_recibido AS recibido_fecha_recibido", 
			"recibido.png AS recibido_png", 
			"centro2.Nombre_centro AS centro2_Nombre_centro", 
			"centro2.Tel_centro AS centro2_Tel_centro", 
			"centro2.direccion_centro AS centro2_direccion_centro", 
			"centro2.numero_centro AS centro2_numero_centro", 
			"producto.nombre_producto AS producto_nombre_producto", 
			"producto.precio_producto AS producto_precio_producto", 
			"detalle_registro.fk_cantidad AS detalle_registro_fk_cantidad", 
			"producto.cantidad_producto AS producto_cantidad_producto", 
			"producto.dimension_producto AS producto_dimension_producto", 
			"producto.peso_producto AS producto_peso_producto", 
			"producto.desc_producto AS producto_desc_producto", 
			"producto.fk_categoria AS producto_fk_categoria", 
			"producto.fk_proveedor AS producto_fk_proveedor", 
			"ficha.user_created");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("ficha.id", $rec_id);; //select record based on primary key
		}
		$db->join("enviado", "ficha.fk_emisor = enviado.id_enviado", "INNER ");
		$db->join("recibido", "ficha.fk_receptor = recibido.id_recibido", "INNER ");
		$db->join("centro", "enviado.lugar_salida = centro.id_centro", "INNER ");
		$db->join("centro AS centro2", "recibido.lugar_recibido = centro2.id_centro", "INNER ");
		$db->join("detalle_registro", "ficha.id = detalle_registro.fk_registro", "INNER ");
		$db->join("producto", "detalle_registro.fk_producto = producto.id_producto", "INNER ");  
		$record = $db->getOne($tablename, $fields );
		if($record){
			$this->write_to_log("view", "true");
			$page_title = $this->view->page_title = get_lang('view_ficha');
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
			$this->write_to_log("view", "false");
		}
		return $this->render_view("ficha/view.php", $record);
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
			$fields = $this->fields = array("fecha","fk_emisor","fk_receptor","user_created");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
			);
			$this->sanitize_array = array(
				'fk_emisor' => 'sanitize_string',
				'fk_receptor' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$modeldata['fecha'] = datetime_now();
$modeldata['user_created'] = USER_ID;
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->write_to_log("add", "true");
					$this->set_flash_msg(get_lang('record_added_successfully'), "success");
					return	$this->redirect("ficha");
				}
				else{
					$this->set_page_error();
					$this->write_to_log("add", "false");
				}
			}
		}
		$page_title = $this->view->page_title = get_lang('add_new_ficha');
		$this->render_view("ficha/add.php");
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
		$fields = $this->fields = array("id","fk_emisor","fk_receptor");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
			);
			$this->sanitize_array = array(
				'fk_emisor' => 'sanitize_string',
				'fk_receptor' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("ficha.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->write_to_log("edit", "true");
					$this->set_flash_msg(get_lang('record_updated_successfully'), "success");
					return $this->redirect("ficha");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
						$this->write_to_log("edit", "false");
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$page_error = get_lang('no_record_updated');
						$this->set_page_error($page_error);
						$this->set_flash_msg($page_error, "warning");
						$this->write_to_log("edit", "false");
						return	$this->redirect("ficha");
					}
				}
			}
		}
		$db->where("ficha.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = get_lang('modifcar_ficha');
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("ficha/edit.php", $data);
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
		$fields = $this->fields = array("id","fk_emisor","fk_receptor");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
			);
			$this->sanitize_array = array(
				'fk_emisor' => 'sanitize_string',
				'fk_receptor' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("ficha.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount();
				if($bool && $numRows){
					$this->write_to_log("edit", "true");
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
					$this->write_to_log("edit", "false");
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
		$db->where("ficha.id", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->write_to_log("delete", "true");
			$this->set_flash_msg(get_lang('record_deleted_successfully'), "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
			$this->write_to_log("delete", "false");
		}
		return	$this->redirect("ficha");
	}
}
