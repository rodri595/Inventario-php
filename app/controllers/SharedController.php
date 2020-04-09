<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	
	/**
     * detalle_registro_fk_registro_option_list Model Action
     * @return array
     */
	function detalle_registro_fk_registro_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT id_registro AS value , id_registro AS label FROM registro ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * detalle_registro_fk_producto_option_list Model Action
     * @return array
     */
	function detalle_registro_fk_producto_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT id_producto AS value , id_producto AS label FROM producto ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * registro_fk_detalle_registro_option_list Model Action
     * @return array
     */
	function registro_fk_detalle_registro_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT id_detalle_registro AS value , id_detalle_registro AS label FROM detalle_registro ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * registro_fk_proveedor_option_list Model Action
     * @return array
     */
	function registro_fk_proveedor_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT id_proveedor AS value , id_proveedor AS label FROM proveedor ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * usuario_user_usuario_value_exist Model Action
     * @return array
     */
	function usuario_user_usuario_value_exist($val){
		$db = $this->GetModel();
		$db->where("user_usuario", $val);
		$exist = $db->has("usuario");
		return $exist;
	}

	/**
     * usuario_correo_value_exist Model Action
     * @return array
     */
	function usuario_correo_value_exist($val){
		$db = $this->GetModel();
		$db->where("correo", $val);
		$exist = $db->has("usuario");
		return $exist;
	}

	/**
     * producto_fk_proveedor_option_list Model Action
     * @return array
     */
	function producto_fk_proveedor_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT id_proveedor AS value , id_proveedor AS label FROM proveedor ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * producto_fk_categoria_option_list Model Action
     * @return array
     */
	function producto_fk_categoria_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT id_categoria AS value , id_categoria AS label FROM categoria ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * producto_creadopor_producto_option_list Model Action
     * @return array
     */
	function producto_creadopor_producto_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT id_usuario AS value , id_usuario AS label FROM usuario ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * getcount_totaldeproductos Model Action
     * @return Value
     */
	function getcount_totaldeproductos(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM producto";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_proveedores Model Action
     * @return Value
     */
	function getcount_proveedores(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM proveedor";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_centromedicos Model Action
     * @return Value
     */
	function getcount_centromedicos(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM centro";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
	* linechart_newchart4 Model Action
	* @return array
	*/
	function linechart_newchart4(){
		
		$db = $this->GetModel();
		$chart_data = array(
			"labels"=> array(),
			"datasets"=> array(),
		);
		
		//set query result for dataset 1
		$sqltext = "select *
from producto;";
		$queryparams = null;
		$dataset1 = $db->rawQuery($sqltext, $queryparams);
		$dataset_data =  array_column($dataset1, 'id_producto');
		$dataset_labels =  array_column($dataset1, 'nombre_producto');
		$chart_data["labels"] = array_unique(array_merge($chart_data["labels"], $dataset_labels));
		$chart_data["datasets"][] = $dataset_data;

		return $chart_data;
	}

	/**
	* radarchart_newchart5 Model Action
	* @return array
	*/
	function radarchart_newchart5(){
		
		$db = $this->GetModel();
		$chart_data = array(
			"labels"=> array(),
			"datasets"=> array(),
		);
		
		//set query result for dataset 1
		$sqltext = "select *
from registro;";
		$queryparams = null;
		$dataset1 = $db->rawQuery($sqltext, $queryparams);
		$dataset_data =  array_column($dataset1, 'id_registro');
		$dataset_labels =  array_column($dataset1, 'fk_detalle_registro');
		$chart_data["labels"] = array_unique(array_merge($chart_data["labels"], $dataset_labels));
		$chart_data["datasets"][] = $dataset_data;

		return $chart_data;
	}

	/**
	* piechart_newchart2 Model Action
	* @return array
	*/
	function piechart_newchart2(){
		
		$db = $this->GetModel();
		$chart_data = array(
			"labels"=> array(),
			"datasets"=> array(),
		);
		
		//set query result for dataset 1
		$sqltext = "select *
from categoria;";
		$queryparams = null;
		$dataset1 = $db->rawQuery($sqltext, $queryparams);
		$dataset_data =  array_column($dataset1, 'id_categoria');
		$dataset_labels =  array_column($dataset1, 'desc_categoria');
		$chart_data["labels"] = array_unique(array_merge($chart_data["labels"], $dataset_labels));
		$chart_data["datasets"][] = $dataset_data;

		return $chart_data;
	}

	/**
	* barchart_newchart1 Model Action
	* @return array
	*/
	function barchart_newchart1(){
		
		$db = $this->GetModel();
		$chart_data = array(
			"labels"=> array(),
			"datasets"=> array(),
		);
		
		//set query result for dataset 1
		$sqltext = "select *
from proveedor;";
		$queryparams = null;
		$dataset1 = $db->rawQuery($sqltext, $queryparams);
		$dataset_data =  array_column($dataset1, 'id_proveedor');
		$dataset_labels =  array_column($dataset1, 'nombre_proveedor');
		$chart_data["labels"] = array_unique(array_merge($chart_data["labels"], $dataset_labels));
		$chart_data["datasets"][] = $dataset_data;

		return $chart_data;
	}

}
