<?php 
/**
 * Detalle_registro Page Controller
 * @category  Controller
 */
class Detalle_registroController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "detalle_registro";
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
		$fields = array("detalle_registro.id_detalle_registro", 
			"detalle_registro.fk_registro", 
			"detalle_registro.fk_producto", 
			"producto.nombre_producto AS producto_nombre_producto", 
			"detalle_registro.desc_detalle", 
			"detalle_registro.fk_cantidad");
		$pagination = $this->get_pagination(25); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				detalle_registro.id_detalle_registro LIKE ? OR 
				detalle_registro.fk_registro LIKE ? OR 
				detalle_registro.fk_producto LIKE ? OR 
				detalle_registro.desc_detalle LIKE ? OR 
				detalle_registro.fk_cantidad LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "detalle_registro/search.php";
		}
		$db->join("producto", "detalle_registro.fk_producto = producto.id_producto", "INNER");
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("detalle_registro.id_detalle_registro", ORDER_TYPE);
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
		$page_title = $this->view->page_title = get_lang('lista_de_productos_en_todos_los_registros');
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("detalle_registro/list.php", $data); //render the full page
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
			$fields = $this->fields = array("fk_registro","fk_producto","fk_cantidad","desc_detalle");
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'fk_registro' => 'required|numeric|min_numeric,0',
				'fk_producto' => 'required',
				'fk_cantidad' => 'numeric|min_numeric,0',
			);
			$this->sanitize_array = array(
				'fk_registro' => 'sanitize_string',
				'fk_producto' => 'sanitize_string',
				'fk_cantidad' => 'sanitize_string',
				'desc_detalle' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg(get_lang('record_agregado_a_registro'), "success");
					return	$this->redirect("ficha/add");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = get_lang('agregar_producto_en_registro');
		$this->render_view("detalle_registro/add.php");
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
		$fields = $this->fields = array("id_detalle_registro","fk_registro","fk_producto","fk_cantidad","desc_detalle");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'fk_registro' => 'required|numeric|min_numeric,0',
				'fk_producto' => 'required',
				'fk_cantidad' => 'numeric|min_numeric,0',
			);
			$this->sanitize_array = array(
				'fk_registro' => 'sanitize_string',
				'fk_producto' => 'sanitize_string',
				'fk_cantidad' => 'sanitize_string',
				'desc_detalle' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("detalle_registro.id_detalle_registro", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg(get_lang('record_updated_successfully'), "success");
					return $this->redirect("detalle_registro");
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
						return	$this->redirect("detalle_registro");
					}
				}
			}
		}
		$db->where("detalle_registro.id_detalle_registro", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = get_lang('edit_detalle_registro');
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("detalle_registro/edit.php", $data);
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
		$fields = $this->fields = array("id_detalle_registro","fk_registro","fk_producto","fk_cantidad","desc_detalle");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'fk_registro' => 'required|numeric|min_numeric,0',
				'fk_producto' => 'required',
				'fk_cantidad' => 'numeric|min_numeric,0',
			);
			$this->sanitize_array = array(
				'fk_registro' => 'sanitize_string',
				'fk_producto' => 'sanitize_string',
				'fk_cantidad' => 'sanitize_string',
				'desc_detalle' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			if($this->validated()){
				$db->where("detalle_registro.id_detalle_registro", $rec_id);;
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
		$db->where("detalle_registro.id_detalle_registro", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg(get_lang('record_deleted_successfully'), "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("detalle_registro");
	}
}
