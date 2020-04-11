<?php
$comp_model = new SharedController;
$page_element_id = "add-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$show_header = $this->show_header;
$view_title = $this->view_title;
$redirect_to = $this->redirect_to;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="add" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title"><?php print_lang('nuevo_producto'); ?></h4>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-7 comp-grid">
                    <?php $this :: display_page_errors(); ?>
                    <div  class="bg-light p-3 animated fadeIn page-content">
                        <form id="producto-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="<?php print_link("producto/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="nombre_producto"><?php print_lang('nombre_producto'); ?> <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                <input id="ctrl-nombre_producto"  value="<?php  echo $this->set_field_value('nombre_producto',""); ?>" type="text" placeholder="<?php print_lang('nombre'); ?>"  required="" name="nombre_producto"  data-url="api/json/producto_nombre_producto_value_exist/" data-loading-msg="<?php print_lang('checking_availability_'); ?>" data-available-msg="<?php print_lang('available'); ?>" data-unavailable-msg="<?php print_lang('not_available'); ?>" class="form-control  ctrl-check-duplicate" />
                                                    <div class="check-status"></div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="desc_producto"><?php print_lang('descripci_n'); ?> </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <textarea placeholder="<?php print_lang('detalles'); ?>" id="ctrl-desc_producto"  rows="5" name="desc_producto" class=" form-control"><?php  echo $this->set_field_value('desc_producto',""); ?></textarea>
                                                    <!--<div class="invalid-feedback animated bounceIn text-center"><?php print_lang('please_enter_text'); ?></div>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="cantidad_producto"><?php print_lang('cantidad'); ?> <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input id="ctrl-cantidad_producto"  value="<?php  echo $this->set_field_value('cantidad_producto',"0.00"); ?>" type="number" placeholder="<?php print_lang('cantidad'); ?>" min="0" step="0.1"  required="" name="cantidad_producto"  class="form-control " />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="peso_producto"><?php print_lang('peso'); ?> </label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <input id="ctrl-peso_producto"  value="<?php  echo $this->set_field_value('peso_producto',""); ?>" type="text" placeholder="<?php print_lang('peso_en_kilogramos_sino_especificar_en_descripci_n_'); ?>" minlength="0"  name="peso_producto"  class="form-control " />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="dimension_producto"><?php print_lang('dimensiones'); ?> </label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="">
                                                            <input id="ctrl-dimension_producto"  value="<?php  echo $this->set_field_value('dimension_producto',""); ?>" type="text" placeholder="<?php print_lang('dimensiones'); ?>"  name="dimension_producto"  class="form-control " />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="fk_proveedor"><?php print_lang('proveedor'); ?> </label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                <select  id="ctrl-fk_proveedor" name="fk_proveedor"  placeholder="<?php print_lang('seleccione_proveedor_'); ?>"    class="selectize" >
                                                                    <option value=""><?php print_lang('seleccione_proveedor_'); ?></option>
                                                                    <?php 
                                                                    $fk_proveedor_options = $comp_model -> producto_fk_proveedor_option_list();
                                                                    if(!empty($fk_proveedor_options)){
                                                                    foreach($fk_proveedor_options as $option){
                                                                    $value = (!empty($option['value']) ? $option['value'] : null);
                                                                    $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                    $selected = $this->set_field_selected('fk_proveedor',$value, "n/a");
                                                                    ?>
                                                                    <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                                                        <?php echo $label; ?>
                                                                    </option>
                                                                    <?php
                                                                    }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="fk_categoria"><?php print_lang('categoria'); ?> </label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                <select  id="ctrl-fk_categoria" name="fk_categoria"  placeholder="<?php print_lang('seleccione_categoria_'); ?>"    class="selectize" >
                                                                    <option value=""><?php print_lang('seleccione_categoria_'); ?></option>
                                                                    <?php 
                                                                    $fk_categoria_options = $comp_model -> producto_fk_categoria_option_list();
                                                                    if(!empty($fk_categoria_options)){
                                                                    foreach($fk_categoria_options as $option){
                                                                    $value = (!empty($option['value']) ? $option['value'] : null);
                                                                    $label = (!empty($option['label']) ? $option['label'] : $value);
                                                                    $selected = $this->set_field_selected('fk_categoria',$value, "0");
                                                                    ?>
                                                                    <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                                                        <?php echo $label; ?>
                                                                    </option>
                                                                    <?php
                                                                    }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="precio_producto"><?php print_lang('precio_si_tiene_'); ?> </label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                <input id="ctrl-precio_producto"  value="<?php  echo $this->set_field_value('precio_producto',"0"); ?>" type="number" placeholder="<?php print_lang('precio'); ?>" min="0" step="0.1"  name="precio_producto"  class="form-control " />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group form-submit-btn-holder text-center mt-3">
                                                    <div class="form-ajax-status"></div>
                                                    <button class="btn btn-primary" type="submit">
                                                        <?php print_lang('submit'); ?>
                                                        <i class="fa fa-send"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-md-5 comp-grid">
                                        <div class=" reset-grids">
                                            <?php  
                                            $this->render_page("categoria/add"); 
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div  class="">
                            <div class="container">
                                <div class="row ">
                                    <div class="col-md-12 comp-grid">
                                        <div class=" ">
                                            <?php  
                                            $this->render_page("categoria/list?limit_count=20"); 
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
