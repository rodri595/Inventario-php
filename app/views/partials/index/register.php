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
                    <h4 class="record-title"><?php print_lang('user_registration'); ?></h4>
                </div>
                <div class="col-sm-6 comp-grid">
                    <div class="">
                        <div class="text-center">
                            <?php print_lang('already_have_an_account_'); ?>  <a class="btn btn-primary" href="<?php print_link('') ?>"> <?php print_lang('login'); ?></a>
                        </div>
                    </div>
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
                        <form id="usuario-userregister-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="<?php print_link("index/register?csrf_token=$csrf_token") ?>" method="post">
                            <!--[main-form-start]-->
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="user_usuario"><?php print_lang('user_usuario'); ?> <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                <input id="ctrl-user_usuario"  value="<?php  echo $this->set_field_value('user_usuario',""); ?>" type="text" placeholder="<?php print_lang('enter_user_usuario'); ?>"  required="" name="user_usuario"  data-url="api/json/usuario_user_usuario_value_exist/" data-loading-msg="<?php print_lang('checking_availability_'); ?>" data-available-msg="<?php print_lang('available'); ?>" data-unavailable-msg="<?php print_lang('not_available'); ?>" class="form-control  ctrl-check-duplicate" />
                                                    <div class="check-status"></div> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label class="control-label" for="nombre"><?php print_lang('nombre'); ?> <span class="text-danger">*</span></label>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="">
                                                    <input id="ctrl-nombre"  value="<?php  echo $this->set_field_value('nombre',""); ?>" type="text" placeholder="<?php print_lang('enter_nombre'); ?>"  required="" name="nombre"  class="form-control " />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label class="control-label" for="apellido"><?php print_lang('apellido'); ?> <span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="">
                                                        <input id="ctrl-apellido"  value="<?php  echo $this->set_field_value('apellido',""); ?>" type="text" placeholder="<?php print_lang('enter_apellido'); ?>"  required="" name="apellido"  class="form-control " />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label class="control-label" for="correo"><?php print_lang('correo'); ?> <span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-sm-8">
                                                        <div class="">
                                                            <input id="ctrl-correo"  value="<?php  echo $this->set_field_value('correo',""); ?>" type="email" placeholder="<?php print_lang('enter_correo'); ?>"  required="" name="correo"  data-url="api/json/usuario_correo_value_exist/" data-loading-msg="<?php print_lang('checking_availability_'); ?>" data-available-msg="<?php print_lang('available'); ?>" data-unavailable-msg="<?php print_lang('not_available'); ?>" class="form-control  ctrl-check-duplicate" />
                                                                <div class="check-status"></div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <label class="control-label" for="fecha_creacion_usuario"><?php print_lang('fecha_creacion_usuario'); ?> <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <div class="input-group">
                                                                <input id="ctrl-fecha_creacion_usuario" class="form-control datepicker  datepicker"  required="" value="<?php  echo $this->set_field_value('fecha_creacion_usuario',""); ?>" type="datetime" name="fecha_creacion_usuario" placeholder="<?php print_lang('enter_fecha_creacion_usuario'); ?>" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
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
                                                                <label class="control-label" for="password"><?php print_lang('password'); ?> <span class="text-danger">*</span></label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <div class="input-group">
                                                                    <input id="ctrl-password"  value="<?php  echo $this->set_field_value('password',""); ?>" type="password" placeholder="<?php print_lang('enter_password'); ?>"  required="" name="password"  class="form-control  password password-strength" />
                                                                        <div class="input-group-append cursor-pointer btn-toggle-password">
                                                                            <span class="input-group-text"><i class="fa fa-eye"></i></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="password-strength-msg">
                                                                        <small class="font-weight-bold"><?php print_lang('should_contain'); ?></small>
                                                                        <small class="length chip">6 <?php print_lang('characters_minimum'); ?></small>
                                                                        <small class="caps chip"><?php print_lang('capital_letter'); ?></small>
                                                                        <small class="number chip"><?php print_lang('number'); ?></small>
                                                                        <small class="special chip"><?php print_lang('symbol'); ?></small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <label class="control-label" for="confirm_password"><?php print_lang('confirm_password'); ?> <span class="text-danger">*</span></label>
                                                                </div>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group">
                                                                        <input id="ctrl-password-confirm" data-match="#ctrl-password"  class="form-control password-confirm " type="password" name="confirm_password" required placeholder="<?php print_lang('confirm_password'); ?>" />
                                                                            <div class="input-group-append cursor-pointer btn-toggle-password">
                                                                                <span class="input-group-text"><i class="fa fa-eye"></i></span>
                                                                            </div>
                                                                            <div class="invalid-feedback">
                                                                                Password does not match
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group ">
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <label class="control-label" for="numero_empleado"><?php print_lang('numero_empleado'); ?> <span class="text-danger">*</span></label>
                                                                    </div>
                                                                    <div class="col-sm-8">
                                                                        <div class="">
                                                                            <input id="ctrl-numero_empleado"  value="<?php  echo $this->set_field_value('numero_empleado',""); ?>" type="number" placeholder="<?php print_lang('enter_numero_empleado'); ?>" step="1"  required="" name="numero_empleado"  class="form-control " />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group ">
                                                                    <div class="row">
                                                                        <div class="col-sm-4">
                                                                            <label class="control-label" for="fk_rol"><?php print_lang('fk_rol'); ?> <span class="text-danger">*</span></label>
                                                                        </div>
                                                                        <div class="col-sm-8">
                                                                            <div class="">
                                                                                <input id="ctrl-fk_rol"  value="<?php  echo $this->set_field_value('fk_rol',""); ?>" type="text" placeholder="<?php print_lang('enter_fk_rol'); ?>"  required="" name="fk_rol"  class="form-control " />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--[main-form-end]-->
                                                                <div class="form-group form-submit-btn-holder text-center mt-3">
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
                                    </section>
                                    