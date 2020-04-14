<?php 
/**
 * Usuario Page Controller
 * @category  Controller
 */
class UsuarioController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "usuario";
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
		$fields = array("id_usuario", 
			"user_usuario", 
			"nombre", 
			"apellido", 
			"correo", 
			"fecha_creacion_usuario", 
			"numero_empleado", 
			"rol");
		$pagination = $this->get_pagination(MAX_RECORD_COUNT); // get current pagination e.g array(page_number, page_limit)
		//search table record
		if(!empty($request->search)){
			$text = trim($request->search); 
			$search_condition = "(
				usuario.id_usuario LIKE ? OR 
				usuario.user_usuario LIKE ? OR 
				usuario.nombre LIKE ? OR 
				usuario.apellido LIKE ? OR 
				usuario.correo LIKE ? OR 
				usuario.fecha_creacion_usuario LIKE ? OR 
				usuario.password LIKE ? OR 
				usuario.numero_empleado LIKE ? OR 
				usuario.rol LIKE ?
			)";
			$search_params = array(
				"%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%","%$text%"
			);
			//setting search conditions
			$db->where($search_condition, $search_params);
			 //template to use when ajax search
			$this->view->search_template = "usuario/search.php";
		}
		if(!empty($request->orderby)){
			$orderby = $request->orderby;
			$ordertype = (!empty($request->ordertype) ? $request->ordertype : ORDER_TYPE);
			$db->orderBy($orderby, $ordertype);
		}
		else{
			$db->orderBy("usuario.id_usuario", ORDER_TYPE);
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
		$page_title = $this->view->page_title = get_lang('usuario');
		$this->view->report_filename = date('Y-m-d') . '-' . $page_title;
		$this->view->report_title = $page_title;
		$this->view->report_layout = "report_layout.php";
		$this->view->report_paper_size = "A4";
		$this->view->report_orientation = "portrait";
		$this->render_view("usuario/list.php", $data); //render the full page
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
		$fields = array("id_usuario", 
			"user_usuario", 
			"nombre", 
			"apellido", 
			"correo", 
			"fecha_creacion_usuario", 
			"numero_empleado", 
			"rol");
		if($value){
			$db->where($rec_id, urldecode($value)); //select record based on field name
		}
		else{
			$db->where("usuario.id_usuario", $rec_id);; //select record based on primary key
		}
		$record = $db->getOne($tablename, $fields );
		if($record){
			$page_title = $this->view->page_title = get_lang('view_usuario');
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
		return $this->render_view("usuario/view.php", $record);
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
			$fields = $this->fields = array("user_usuario","nombre","apellido","correo","fecha_creacion_usuario","password","numero_empleado","rol");
			$postdata = $this->format_request_data($formdata);
			$cpassword = $postdata['confirm_password'];
			$password = $postdata['password'];
			if($cpassword != $password){
				$this->view->page_error[] = get_lang('your_password_confirmation_is_not_consistent');
			}
			$this->rules_array = array(
				'user_usuario' => 'required',
				'nombre' => 'required',
				'correo' => 'required|valid_email',
				'password' => 'required',
				'numero_empleado' => 'numeric',
				'rol' => 'required',
			);
			$this->sanitize_array = array(
				'user_usuario' => 'sanitize_string',
				'nombre' => 'sanitize_string',
				'apellido' => 'sanitize_string',
				'correo' => 'sanitize_string',
				'numero_empleado' => 'sanitize_string',
				'rol' => 'sanitize_string',
			);
			$this->filter_vals = true; //set whether to remove empty fields
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$password_text = $modeldata['password'];
			//update modeldata with the password hash
			$modeldata['password'] = $this->modeldata['password'] = password_hash($password_text , PASSWORD_DEFAULT);
			$modeldata['fecha_creacion_usuario'] = datetime_now();
			//Check if Duplicate Record Already Exit In The Database
			$db->where("user_usuario", $modeldata['user_usuario']);
			if($db->has($tablename)){
				$this->view->page_error[] = $modeldata['user_usuario'].get_lang('_already_exist_');
			}
			//Check if Duplicate Record Already Exit In The Database
			$db->where("correo", $modeldata['correo']);
			if($db->has($tablename)){
				$this->view->page_error[] = $modeldata['correo'].get_lang('_already_exist_');
			}
			//Check if Duplicate Record Already Exit In The Database
			$db->where("numero_empleado", $modeldata['numero_empleado']);
			if($db->has($tablename)){
				$this->view->page_error[] = $modeldata['numero_empleado'].get_lang('_already_exist_');
			} 
			if($this->validated()){
				$rec_id = $this->rec_id = $db->insert($tablename, $modeldata);
				if($rec_id){
					$this->set_flash_msg(get_lang('record_added_successfully'), "success");
					return	$this->redirect("usuario");
				}
				else{
					$this->set_page_error();
				}
			}
		}
		$page_title = $this->view->page_title = get_lang('add_new_usuario');
		$this->render_view("usuario/add.php");
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
		$fields = $this->fields = array("id_usuario","user_usuario","nombre","apellido","numero_empleado","rol");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'user_usuario' => 'required',
				'nombre' => 'required',
				'numero_empleado' => 'numeric',
				'rol' => 'required',
			);
			$this->sanitize_array = array(
				'user_usuario' => 'sanitize_string',
				'nombre' => 'sanitize_string',
				'apellido' => 'sanitize_string',
				'numero_empleado' => 'sanitize_string',
				'rol' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			//Check if Duplicate Record Already Exit In The Database
			if(isset($modeldata['user_usuario'])){
				$db->where("user_usuario", $modeldata['user_usuario'])->where("id_usuario", $rec_id, "!=");
				if($db->has($tablename)){
					$this->view->page_error[] = $modeldata['user_usuario'].get_lang('_already_exist_');
				}
			}
			//Check if Duplicate Record Already Exit In The Database
			if(isset($modeldata['numero_empleado'])){
				$db->where("numero_empleado", $modeldata['numero_empleado'])->where("id_usuario", $rec_id, "!=");
				if($db->has($tablename)){
					$this->view->page_error[] = $modeldata['numero_empleado'].get_lang('_already_exist_');
				}
			} 
			if($this->validated()){
				$db->where("usuario.id_usuario", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg(get_lang('record_updated_successfully'), "success");
					return $this->redirect("usuario");
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
						return	$this->redirect("usuario");
					}
				}
			}
		}
		$db->where("usuario.id_usuario", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = get_lang('edit_usuario');
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("usuario/edit.php", $data);
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
		$fields = $this->fields = array("id_usuario","user_usuario","nombre","apellido","numero_empleado","rol");
		$page_error = null;
		if($formdata){
			$postdata = array();
			$fieldname = $formdata['name'];
			$fieldvalue = $formdata['value'];
			$postdata[$fieldname] = $fieldvalue;
			$postdata = $this->format_request_data($postdata);
			$this->rules_array = array(
				'user_usuario' => 'required',
				'nombre' => 'required',
				'numero_empleado' => 'numeric',
				'rol' => 'required',
			);
			$this->sanitize_array = array(
				'user_usuario' => 'sanitize_string',
				'nombre' => 'sanitize_string',
				'apellido' => 'sanitize_string',
				'numero_empleado' => 'sanitize_string',
				'rol' => 'sanitize_string',
			);
			$this->filter_rules = true; //filter validation rules by excluding fields not in the formdata
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			//Check if Duplicate Record Already Exit In The Database
			if(isset($modeldata['user_usuario'])){
				$db->where("user_usuario", $modeldata['user_usuario'])->where("id_usuario", $rec_id, "!=");
				if($db->has($tablename)){
					$this->view->page_error[] = $modeldata['user_usuario'].get_lang('_already_exist_');
				}
			}
			//Check if Duplicate Record Already Exit In The Database
			if(isset($modeldata['numero_empleado'])){
				$db->where("numero_empleado", $modeldata['numero_empleado'])->where("id_usuario", $rec_id, "!=");
				if($db->has($tablename)){
					$this->view->page_error[] = $modeldata['numero_empleado'].get_lang('_already_exist_');
				}
			} 
			if($this->validated()){
				$db->where("usuario.id_usuario", $rec_id);;
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
		$db->where("usuario.id_usuario", $arr_rec_id, "in");
		$bool = $db->delete($tablename);
		if($bool){
			$this->set_flash_msg(get_lang('record_deleted_successfully'), "success");
		}
		elseif($db->getLastError()){
			$page_error = $db->getLastError();
			$this->set_flash_msg($page_error, "danger");
		}
		return	$this->redirect("usuario");
	}
}
