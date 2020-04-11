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
                    <h4 class="record-title"><?php print_lang('productos_a_agregar_a_ficha'); ?></h4>
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
                        <form id="detalle_registro-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="<?php print_link("detalle_registro/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="fk_registro"><?php print_lang('producto_en_registro_'); ?> <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input id="ctrl-fk_registro"  value="<?php echo $comp_model->detalle_registro_fk_registro_default_value() ?>" type="number" placeholder="<?php print_lang('generando_'); ?>" min="0" step="1" list="fk_registro_list"  required="" name="fk_registro"  class="form-control " />
                                                    <datalist id="fk_registro_list">
                                                        <?php 
                                                        $fk_registro_options = $comp_model -> detalle_registro_fk_registro_option_list();
                                                        if(!empty($fk_registro_options)){
                                                        foreach($fk_registro_options as $option){
                                                        $value = (!empty($option['value']) ? $option['value'] : null);
                                                        $label = (!empty($option['label']) ? $option['label'] : $value);
                                                        ?>
                                                        <option value="<?php echo $value; ?>"><?php echo $label; ?></option>
                                                        <?php
                                                        }
                                                        }
                                                        ?>
                                                    </datalist>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fa fa-check-square "></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="fk_producto"><?php print_lang('producto'); ?> <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <select required=""  id="ctrl-fk_producto" name="fk_producto"  placeholder="<?php print_lang('select_a_value_'); ?>"    class="selectize" >
                                                        <option value=""><?php print_lang('select_a_value_'); ?></option>
                                                        <?php 
                                                        $fk_producto_options = $comp_model -> detalle_registro_fk_producto_option_list();
                                                        if(!empty($fk_producto_options)){
                                                        foreach($fk_producto_options as $option){
                                                        $value = (!empty($option['value']) ? $option['value'] : null);
                                                        $label = (!empty($option['label']) ? $option['label'] : $value);
                                                        $selected = $this->set_field_selected('fk_producto',$value, "");
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
                                                <label class="control-label" for="fk_cantidad"><?php print_lang('cantidad_a_ser_enviada'); ?> </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input id="ctrl-fk_cantidad"  value="<?php  echo $this->set_field_value('fk_cantidad',"0"); ?>" type="number" placeholder="<?php print_lang('cantidad_a_ser_enviada'); ?>" min="0" step="0.1"  name="fk_cantidad"  class="form-control " />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="desc_detalle"><?php print_lang('mensaje'); ?> </label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <input id="ctrl-desc_detalle"  value="<?php  echo $this->set_field_value('desc_detalle',""); ?>" type="text" placeholder="<?php print_lang('detalles_del_producto'); ?>"  name="desc_detalle"  class="form-control " />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group form-submit-btn-holder text-center mt-3">
                                            <div class="form-ajax-status"></div>
                                            <button class="btn btn-primary" type="submit">
                                                <?php print_lang('agregar'); ?>
                                                <i class="fa fa-send"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
