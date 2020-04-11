<?php
$comp_model = new SharedController;
$page_element_id = "edit-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id;
$show_header = $this->show_header;
$view_title = $this->view_title;
$redirect_to = $this->redirect_to;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="edit" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title"><?php print_lang('modifica_ficha'); ?></h4>
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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-horizontal needs-validation" action="<?php print_link("ficha/edit/$page_id/?csrf_token=$csrf_token"); ?>" method="post">
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="fk_emisor"><?php print_lang('codigo_de_rastreo_emisor_enviado'); ?> </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                <select  id="ctrl-fk_emisor" name="fk_emisor"  placeholder="<?php print_lang('seleccione_codigo_de_rastreo_enviado_'); ?>"    class="selectize" >
                                                    <option value=""><?php print_lang('seleccione_codigo_de_rastreo_enviado_'); ?></option>
                                                    <?php
                                                    $rec = $data['fk_emisor'];
                                                    $fk_emisor_options = $comp_model -> ficha_fk_emisor_option_list();
                                                    if(!empty($fk_emisor_options)){
                                                    foreach($fk_emisor_options as $option){
                                                    $value = (!empty($option['value']) ? $option['value'] : null);
                                                    $label = (!empty($option['label']) ? $option['label'] : $value);
                                                    $selected = ( $value == $rec ? 'selected' : null );
                                                    ?>
                                                    <option 
                                                        <?php echo $selected; ?> value="<?php echo $value; ?>"><?php echo $label; ?>
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
                                            <label class="control-label" for="fk_receptor"><?php print_lang('codigo_de_rastreo_de_receptor_recibido'); ?> </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="">
                                                <select  id="ctrl-fk_receptor" name="fk_receptor"  placeholder="<?php print_lang('seleccione_codigo_de_rastreo_recibido_'); ?>"    class="selectize" >
                                                    <option value=""><?php print_lang('seleccione_codigo_de_rastreo_recibido_'); ?></option>
                                                    <?php
                                                    $rec = $data['fk_receptor'];
                                                    $fk_receptor_options = $comp_model -> ficha_fk_receptor_option_list();
                                                    if(!empty($fk_receptor_options)){
                                                    foreach($fk_receptor_options as $option){
                                                    $value = (!empty($option['value']) ? $option['value'] : null);
                                                    $label = (!empty($option['label']) ? $option['label'] : $value);
                                                    $selected = ( $value == $rec ? 'selected' : null );
                                                    ?>
                                                    <option 
                                                        <?php echo $selected; ?> value="<?php echo $value; ?>"><?php echo $label; ?>
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
                            <div class="form-ajax-status"></div>
                            <div class="form-group text-center">
                                <button class="btn btn-primary" type="submit">
                                    <?php print_lang('update'); ?>
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
