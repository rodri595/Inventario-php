<?php 
/**
 * Account Page Controller
 * @category  Controller
 */
class AccountController extends SecureController{
	function __construct(){
		parent::__construct(); 
		$this->tablename = "usuario";
	}
	/**
		* Index Action
		* @return null
		*/
	function index(){
		$db = $this->GetModel();
		$rec_id = $this->rec_id = USER_ID; //get current user id from session
		$db->where ("id_usuario", $rec_id);
		$tablename = $this->tablename;
		$fields = array("id_usuario", 
			"user_usuario", 
			"nombre", 
			"apellido", 
			"correo", 
			"fecha_creacion_usuario", 
			"numero_empleado");
		$user = $db->getOne($tablename , $fields);
		if(!empty($user)){
			$page_title = $this->view->page_title = get_lang('my_account');
			$this->render_view("account/view.php", $user);
		}
		else{
			$this->set_page_error();
			$this->render_view("account/view.php");
		}
	}
	/**
     * Update user account record with formdata
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit($formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = USER_ID;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id_usuario","user_usuario","nombre","apellido","numero_empleado");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$this->rules_array = array(
				'user_usuario' => 'required',
				'nombre' => 'required',
				'numero_empleado' => 'numeric',
			);
			$this->sanitize_array = array(
				'user_usuario' => 'sanitize_string',
				'nombre' => 'sanitize_string',
				'apellido' => 'sanitize_string',
				'numero_empleado' => 'sanitize_string',
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
					$db->where ("id_usuario", $rec_id);
					$user = $db->getOne($tablename , "*");
					set_session("user_data", $user);// update session with new user data
					return $this->redirect("account");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$this->set_flash_msg(get_lang('no_record_updated'), "warning");
						return	$this->redirect("account");
					}
				}
			}
		}
		$db->where("usuario.id_usuario", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = get_lang('my_account');
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("account/edit.php", $data);
	}
	/**
     * Change account email
     * @return BaseView
     */
	function change_email($formdata = null){
		if($formdata){
			$email = trim($formdata['correo']);
			$db = $this->GetModel();
			$rec_id = $this->rec_id = USER_ID; //get current user id from session
			$tablename = $this->tablename;
			$db->where ("id_usuario", $rec_id);
			$result = $db->update($tablename, array('correo' => $email ));
			if($result){
				$this->set_flash_msg(get_lang('email_address_changed_successfully'), "success");
				$this->redirect("account");
			}
			else{
				$this->set_page_error(get_lang('email_not_changed'));
			}
		}
		return $this->render_view("account/change_email.php");
	}
}
