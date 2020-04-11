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
                    <h4 class="record-title"><?php print_lang('nuevo_proveedor'); ?></h4>
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
                        <form id="proveedor-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="<?php print_link("proveedor/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="nombre_proveedor"><?php print_lang('nombre_proveedor'); ?> <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                <input id="ctrl-nombre_proveedor"  value="<?php  echo $this->set_field_value('nombre_proveedor',""); ?>" type="text" placeholder="<?php print_lang('ingrese_nombre_proveedor'); ?>"  required="" name="nombre_proveedor"  class="form-control " />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="desc_proveedor"><?php print_lang('desc_proveedor'); ?> </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input id="ctrl-desc_proveedor"  value="<?php  echo $this->set_field_value('desc_proveedor',""); ?>" type="text" placeholder="<?php print_lang('descripcion'); ?>"  name="desc_proveedor"  class="form-control " />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="asignado_proveedor"><?php print_lang('asignado_proveedor'); ?> </label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <input id="ctrl-asignado_proveedor"  value="<?php  echo $this->set_field_value('asignado_proveedor',""); ?>" type="text" placeholder="<?php print_lang('nombre_de_responsable_o_asignado'); ?>"  name="asignado_proveedor"  class="form-control " />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="tel_proveedor"><?php print_lang('tel_proveedor'); ?> </label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="">
                                                            <input id="ctrl-tel_proveedor"  value="<?php  echo $this->set_field_value('tel_proveedor',""); ?>" type="text" placeholder="<?php print_lang('telefono'); ?>"  name="tel_proveedor"  class="form-control " />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="direccion_proveedor"><?php print_lang('direcci_n'); ?> </label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="">
                                                                <input id="ctrl-direccion_proveedor"  value="<?php  echo $this->set_field_value('direccion_proveedor',""); ?>" type="text" placeholder="<?php print_lang('dirrecci_n_del_proveedor'); ?>"  name="direccion_proveedor"  class="form-control " />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label class="control-label" for="rtn_proveedor"><?php print_lang('rtn'); ?> </label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <div class="">
                                                                    <input id="ctrl-rtn_proveedor"  value="<?php  echo $this->set_field_value('rtn_proveedor',""); ?>" type="text" placeholder="<?php print_lang('rtn'); ?>"  name="rtn_proveedor"  class="form-control " />
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
