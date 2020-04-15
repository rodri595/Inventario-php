<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	
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
     * usuario_numero_empleado_value_exist Model Action
     * @return array
     */
	function usuario_numero_empleado_value_exist($val){
		$db = $this->GetModel();
		$db->where("numero_empleado", $val);
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
     * detalle_registro_fk_registro_option_list Model Action
     * @return array
     */
	function detalle_registro_fk_registro_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT id AS value , id AS label FROM ficha ORDER BY label ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * detalle_registro_fk_registro_default_value Model Action
     * @return Value
     */
	function detalle_registro_fk_registro_default_value(){
		$db = $this->GetModel();
		$sqltext = "SELECT (COUNT(*)+1) FROM ficha";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
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
     * producto_nombre_producto_value_exist Model Action
     * @return array
     */
	function producto_nombre_producto_value_exist($val){
		$db = $this->GetModel();
		$db->where("nombre_producto", $val);
		$exist = $db->has("producto");
		return $exist;
	}

	/**
     * producto_fk_proveedor_option_list Model Action
     * @return array
     */
	function producto_fk_proveedor_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id_proveedor AS value,nombre_proveedor AS label FROM proveedor";
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
		$sqltext = "SELECT  DISTINCT id_categoria AS value,desc_categoria AS label FROM categoria";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * enviado_lugar_salida_option_list Model Action
     * @return array
     */
	function enviado_lugar_salida_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id_centro AS value,Nombre_centro AS label FROM centro";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * recibido_lugar_recibido_option_list Model Action
     * @return array
     */
	function recibido_lugar_recibido_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id_centro AS value,Nombre_centro AS label FROM centro";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * ficha_fk_emisor_option_list Model Action
     * @return array
     */
	function ficha_fk_emisor_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT id_enviado AS value , id_enviado AS label FROM enviado ORDER BY label Desc limit 10";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * ficha_fk_receptor_option_list Model Action
     * @return array
     */
	function ficha_fk_receptor_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT DISTINCT id_recibido AS value , id_recibido AS label FROM recibido ORDER BY label Desc limit 10";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * getcount_registrostotales Model Action
     * @return Value
     */
	function getcount_registrostotales(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM ficha";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_ultimoregistro Model Action
     * @return Value
     */
	function getcount_ultimoregistro(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM ficha";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_montoenlps Model Action
     * @return Value
     */
	function getcount_montoenlps(){
		$db = $this->GetModel();
		$sqltext = "SELECT sum(producto.precio_producto) FROM ficha 
INNER JOIN enviado ON ficha.fk_emisor=enviado.id_enviado 
INNER JOIN recibido ON ficha.fk_receptor=recibido.id_recibido 
INNER JOIN centro ON enviado.lugar_salida=centro.id_centro 
INNER JOIN centro AS centro2 ON recibido.lugar_recibido=centro2.id_centro 
INNER JOIN detalle_registro ON ficha.id=detalle_registro.fk_registro 
INNER JOIN producto ON detalle_registro.fk_producto=producto.id_producto ";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_montototallps Model Action
     * @return Value
     */
	function getcount_montototallps(){
		$db = $this->GetModel();
		$sqltext = "    
SELECT sum(producto.precio_producto*detalle_registro.fk_cantidad) FROM ficha 
INNER JOIN enviado ON ficha.fk_emisor=enviado.id_enviado 
INNER JOIN recibido ON ficha.fk_receptor=recibido.id_recibido 
INNER JOIN centro ON enviado.lugar_salida=centro.id_centro 
INNER JOIN centro AS centro2 ON recibido.lugar_recibido=centro2.id_centro 
INNER JOIN detalle_registro ON ficha.id=detalle_registro.fk_registro 
INNER JOIN producto ON detalle_registro.fk_producto=producto.id_producto ";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_fichaacrear Model Action
     * @return Value
     */
	function getcount_fichaacrear(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*)+1 AS num FROM ficha";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
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
