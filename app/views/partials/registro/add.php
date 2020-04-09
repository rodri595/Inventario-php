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
                    <h4 class="record-title"><?php print_lang('crear_registro'); ?></h4>
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
                        <form id="registro-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="<?php print_link("registro/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="id_registro"><?php print_lang('id_registro'); ?> <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                <input id="ctrl-id_registro"  value="<?php  echo $this->set_field_value('id_registro',""); ?>" type="number" placeholder="<?php print_lang('enter_id_registro'); ?>" step="1"  readonly required="" name="id_registro"  class="form-control " />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="fk_detalle_registro"><?php print_lang('detalle_registro'); ?> <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <select required=""  id="ctrl-fk_detalle_registro" name="fk_detalle_registro"  placeholder="<?php print_lang('select_a_value_'); ?>"    class="custom-select" >
                                                        <option value=""><?php print_lang('select_a_value_'); ?></option>
                                                        <?php 
                                                        $fk_detalle_registro_options = $comp_model -> registro_fk_detalle_registro_option_list();
                                                        if(!empty($fk_detalle_registro_options)){
                                                        foreach($fk_detalle_registro_options as $option){
                                                        $value = (!empty($option['value']) ? $option['value'] : null);
                                                        $label = (!empty($option['label']) ? $option['label'] : $value);
                                                        $selected = $this->set_field_selected('fk_detalle_registro',$value, "");
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
                                                <label class="control-label" for="fk_proveedor"><?php print_lang('proveedor'); ?> <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <select required=""  id="ctrl-fk_proveedor" name="fk_proveedor"  placeholder="<?php print_lang('select_a_value_'); ?>"    class="custom-select" >
                                                        <option value=""><?php print_lang('select_a_value_'); ?></option>
                                                        <?php 
                                                        $fk_proveedor_options = $comp_model -> registro_fk_proveedor_option_list();
                                                        if(!empty($fk_proveedor_options)){
                                                        foreach($fk_proveedor_options as $option){
                                                        $value = (!empty($option['value']) ? $option['value'] : null);
                                                        $label = (!empty($option['label']) ? $option['label'] : $value);
                                                        $selected = $this->set_field_selected('fk_proveedor',$value, "");
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
                </div>
            </div>
        </div>
        <div  class="">
            <div class="container">
                <div class="row ">
                    <div class="col-md-3 comp-grid">
                        <div class=" reset-grids">
                            <?php  
                            $this->render_page("detalle_registro/add"); 
                            ?>
                        </div>
                    </div>
                    <div class="col-md-9 comp-grid">
                        <div class=" ">
                            <?php  
                            $this->render_page("detalle_registro/list?limit_count=20"); 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
