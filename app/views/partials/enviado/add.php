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
                    <h4 class="record-title"><?php print_lang('agregar_movimiento_envio'); ?></h4>
                </div>
                <div class="col-md-3 comp-grid">
                    <?php $rec_count = $comp_model->getcount_registrostotales();  ?>
                    <a class="animated swing record-count card bg-light text-dark"  href="<?php print_link("registro/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-check-circle-o "></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Registros Totales</div>
                                    <small class=""></small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
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
                <div class="col-md-6 comp-grid">
                    <h4 ><?php print_lang('movimiento_envio'); ?></h4>
                    <?php $this :: display_page_errors(); ?>
                    <div  class="bg-light p-3 animated fadeIn page-content">
                        <form id="enviado-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="<?php print_link("enviado/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="fecha_enviado"><?php print_lang('fecha_enviado'); ?> <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input id="ctrl-fecha_enviado" class="form-control datepicker  datepicker" required="" value="<?php  echo $this->set_field_value('fecha_enviado',date_now()); ?>" type="datetime"  name="fecha_enviado" placeholder="<?php print_lang('enter_fecha_enviado'); ?>" data-enable-time="true" data-min-date="" data-max-date="" data-date-format="Y-m-d H:i:S" data-alt-format="F j, Y - H:i" data-inline="false" data-no-calendar="false" data-mode="single" /> 
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="lugar_salida"><?php print_lang('lugar_salida'); ?> <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <select required=""  id="ctrl-lugar_salida" name="lugar_salida"  placeholder="<?php print_lang('seleccion_lugar_de_salida'); ?>"    class="selectize" >
                                                        <option value=""><?php print_lang('seleccion_lugar_de_salida'); ?></option>
                                                        <?php 
                                                        $lugar_salida_options = $comp_model -> enviado_lugar_salida_option_list();
                                                        if(!empty($lugar_salida_options)){
                                                        foreach($lugar_salida_options as $option){
                                                        $value = (!empty($option['value']) ? $option['value'] : null);
                                                        $label = (!empty($option['label']) ? $option['label'] : $value);
                                                        $selected = $this->set_field_selected('lugar_salida',$value, "");
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
                                                <label class="control-label" for="png"><?php print_lang('imagen_documentos'); ?> </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <div class="dropzone " input="#ctrl-png" fieldname="png"    data-multiple="true" dropmsg="<?php print_lang('choose_files_or_drag_and_drop_files_to_upload'); ?>"    btntext="<?php print_lang('browse'); ?>" filesize="3" maximum="1">
                                                        <input name="png" id="ctrl-png" class="dropzone-input form-control" value="<?php  echo $this->set_field_value('png',""); ?>" type="text"  />
                                                            <!--<div class="invalid-feedback animated bounceIn text-center"><?php print_lang('please_a_choose_file'); ?></div>-->
                                                            <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                        </div>
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
                        <div class="col-md-6 comp-grid">
                            <div class=" reset-grids">
                                <?php  
                                $this->render_page("centro/add"); 
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
