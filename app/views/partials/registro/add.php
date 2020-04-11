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
        <div class="container-fluid">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title"><?php print_lang('crear_nuevo_registro'); ?></h4>
                </div>
                <div class="col-md-3 comp-grid">
                    <?php $rec_count = $comp_model->getcount_crearregistro();  ?>
                    <a class="animated slideInRight record-count card bg-light text-dark"  href="<?php print_link("registro/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-check-circle-o "></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Crear Registro #</div>
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
                <div class="col-md-12 comp-grid">
                    <div class=" reset-grids">
                        <?php  
                        $this->render_page("detalle_registro/add"); 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div  class="py-1">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <button data-toggle="modal" data-target="#Modal-1-Page1" class="btn btn-primary"><i class='fa fa-check-circle-o '></i>  Productos en Movimiento</button>
                    <div data-backdrop="true" class="modal fade" id="Modal-1-Page1" tabindex="-1" role="dialog" aria-labelledby="Modal1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle"><i class='fa fa-check-circle-o '></i>  Contenido</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body p-0 reset-grids">
                                    <div class="card reset-grids">
                                        <?php  
                                        $this->render_page("detalle_registro/list?limit_count=25" , array( 'show_header' => false,'show_footer' => false )); 
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $this :: display_page_errors(); ?>
                    <div  class="bg-light p-3 animated fadeIn page-content">
                        <form id="registro-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-vertical needs-validation" action="<?php print_link("registro/add?csrf_token=$csrf_token") ?>" method="post">
                            <div>
                                <div class="form-group ">
                                    <label class="control-label" for="fecha_creacion"><?php print_lang('fecha_creacion'); ?> <span class="text-danger">*</span></label>
                                    <div id="ctrl-fecha_creacion-holder" class="input-group"> 
                                        <input id="ctrl-fecha_creacion" class="form-control datepicker  datepicker" required="" value="<?php  echo $this->set_field_value('fecha_creacion',datetime_now()); ?>" type="datetime"  name="fecha_creacion" placeholder="<?php print_lang('enter_fecha_creacion'); ?>" data-enable-time="true" data-min-date="" data-max-date="" data-date-format="Y-m-d H:i:S" data-alt-format="F j, Y - H:i" data-inline="false" data-no-calendar="false" data-mode="single" /> 
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-calendar-check-o "></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="control-label" for="emisor"><?php print_lang('emisor'); ?> <span class="text-danger">*</span></label>
                                        <div id="ctrl-emisor-holder" class=""> 
                                            <input id="ctrl-emisor"  value="<?php  echo $this->set_field_value('emisor',""); ?>" type="number" placeholder="<?php print_lang('enter_emisor'); ?>" step="1"  required="" name="emisor"  class="form-control " />
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <label class="control-label" for="recepetr"><?php print_lang('recepetr'); ?> <span class="text-danger">*</span></label>
                                            <div id="ctrl-recepetr-holder" class=""> 
                                                <input id="ctrl-recepetr"  value="<?php  echo $this->set_field_value('recepetr',""); ?>" type="number" placeholder="<?php print_lang('enter_recepetr'); ?>" step="1"  required="" name="recepetr"  class="form-control " />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group form-submit-btn-holder text-center mt-3">
                                            <div class="form-ajax-status"></div>
                                            <button class="btn btn-primary" type="submit">
                                                <?php print_lang('confirmar_registro'); ?>
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
