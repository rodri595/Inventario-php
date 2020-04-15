<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("ficha/add");
$can_edit = ACL::is_allowed("ficha/edit");
$can_view = ACL::is_allowed("ficha/view");
$can_delete = ACL::is_allowed("ficha/delete");
?>
<?php
$comp_model = new SharedController;
$page_element_id = "list-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data From Controller
$view_data = $this->view_data;
$records = $view_data->records;
$record_count = $view_data->record_count;
$total_records = $view_data->total_records;
$field_name = $this->route->field_name;
$field_value = $this->route->field_value;
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_footer = $this->show_footer;
$show_pagination = $this->show_pagination;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="list" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container-fluid">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title"><?php print_lang('registro_total_de_fichas'); ?></h4>
                </div>
                <div class="col-sm-3 ">
                    <?php if($can_add){ ?>
                    <a  class="btn btn btn-primary my-1" href="<?php print_link("ficha/add") ?>">
                        <i class="fa fa-plus"></i>                              
                        <?php print_lang('nueva_ficha'); ?> 
                    </a>
                    <?php } ?>
                </div>
                <div class="col-sm-4 ">
                    <form  class="search" action="<?php print_link('ficha'); ?>" method="get">
                        <div class="input-group">
                            <input value="<?php echo get_value('search'); ?>" class="form-control" type="text" name="search"  placeholder="<?php print_lang('search'); ?>" />
                                <div class="input-group-append">
                                    <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12 comp-grid">
                        <div class="">
                            <!-- Page bread crumbs components-->
                            <?php
                            if(!empty($field_name) || !empty($_GET['search'])){
                            ?>
                            <hr class="sm d-block d-sm-none" />
                            <nav class="page-header-breadcrumbs mt-2" aria-label="breadcrumb">
                                <ul class="breadcrumb m-0 p-1">
                                    <?php
                                    if(!empty($field_name)){
                                    ?>
                                    <li class="breadcrumb-item">
                                        <a class="text-decoration-none" href="<?php print_link('ficha'); ?>">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <?php echo (get_value("tag") ? get_value("tag")  :  make_readable($field_name)); ?>
                                    </li>
                                    <li  class="breadcrumb-item active text-capitalize font-weight-bold">
                                        <?php echo (get_value("label") ? get_value("label")  :  make_readable(urldecode($field_value))); ?>
                                    </li>
                                    <?php 
                                    }   
                                    ?>
                                    <?php
                                    if(get_value("search")){
                                    ?>
                                    <li class="breadcrumb-item">
                                        <a class="text-decoration-none" href="<?php print_link('ficha'); ?>">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item text-capitalize">
                                        <?php print_lang('search'); ?>
                                    </li>
                                    <li  class="breadcrumb-item active text-capitalize font-weight-bold"><?php echo get_value("search"); ?></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </nav>
                            <!--End of Page bread crumbs components-->
                            <?php
                            }
                            ?>
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
                    <div class="col-sm-3 comp-grid">
                        <h6 ><?php print_lang('para_mas_detalles_dale_click_al_numero_del_registro'); ?></h6>
                    </div>
                </div>
            </div>
        </div>
        <div  class="">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-md-12 comp-grid">
                        <?php $this :: display_page_errors(); ?>
                        <div  class=" animated fadeIn page-content">
                            <div id="ficha-list-records">
                                <div id="page-report-body" class="table-responsive">
                                    <table class="table  table-striped table-sm text-left">
                                        <thead class="table-header bg-light">
                                            <tr>
                                                <?php if($can_delete){ ?>
                                                <th class="td-checkbox">
                                                    <label class="custom-control custom-checkbox custom-control-inline">
                                                        <input class="toggle-check-all custom-control-input" type="checkbox" />
                                                        <span class="custom-control-label"></span>
                                                    </label>
                                                </th>
                                                <?php } ?>
                                                <th class="td-sno">#</th>
                                                <th  <?php echo (get_value('orderby')=='id' ? 'class="sortedby td-id"' : null); ?>>
                                                    <i class="fa fa-chevron-circle-down "></i>
                                                    <?php Html :: get_field_order_link('id', get_lang('registro')); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='fecha' ? 'class="sortedby td-fecha"' : null); ?>>
                                                    <i class="fa fa-calendar-plus-o "></i>
                                                    <?php Html :: get_field_order_link('fecha', get_lang('fecha_registro_creado')); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='producto_nombre_producto' ? 'class="sortedby td-producto_nombre_producto"' : null); ?>>
                                                    <?php Html :: get_field_order_link('producto_nombre_producto', get_lang('producto')); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='detalle_registro_fk_cantidad' ? 'class="sortedby td-detalle_registro_fk_cantidad"' : null); ?>>
                                                    <?php Html :: get_field_order_link('detalle_registro_fk_cantidad', get_lang('cantidad_enviada')); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='producto_cantidad_producto' ? 'class="sortedby td-producto_cantidad_producto"' : null); ?>>
                                                    <?php Html :: get_field_order_link('producto_cantidad_producto', get_lang('cantidad_en_almacen')); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='enviado_id_enviado' ? 'class="sortedby td-enviado_id_enviado"' : null); ?>>
                                                    <?php Html :: get_field_order_link('enviado_id_enviado', get_lang('_rastreo_salida')); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='enviado_fecha_enviado' ? 'class="sortedby td-enviado_fecha_enviado"' : null); ?>>
                                                    <?php Html :: get_field_order_link('enviado_fecha_enviado', get_lang('fecha_salida')); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='centro_Nombre_centro' ? 'class="sortedby td-centro_Nombre_centro"' : null); ?>>
                                                    <?php Html :: get_field_order_link('centro_Nombre_centro', get_lang('salio_de')); ?>
                                                </th>
                                                <th  class="td-enviado_png"> <?php print_lang('img_docs'); ?></th>
                                                <th  <?php echo (get_value('orderby')=='recibido_id_recibido' ? 'class="sortedby td-recibido_id_recibido"' : null); ?>>
                                                    <?php Html :: get_field_order_link('recibido_id_recibido', get_lang('_rastreo_llegada')); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='recibido_fecha_recibido' ? 'class="sortedby td-recibido_fecha_recibido"' : null); ?>>
                                                    <?php Html :: get_field_order_link('recibido_fecha_recibido', get_lang('fecha_llegada')); ?>
                                                </th>
                                                <th  <?php echo (get_value('orderby')=='centro2_Nombre_centro' ? 'class="sortedby td-centro2_Nombre_centro"' : null); ?>>
                                                    <i class="fa fa-building-o "></i>
                                                    <?php Html :: get_field_order_link('centro2_Nombre_centro', get_lang('llego_a')); ?>
                                                </th>
                                                <th  class="td-recibido_png"> <?php print_lang('img_docs'); ?></th>
                                                <th class="td-btn"></th>
                                            </tr>
                                        </thead>
                                        <?php
                                        if(!empty($records)){
                                        ?>
                                        <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                            <!--record-->
                                            <?php
                                            $counter = 0;
                                            foreach($records as $data){
                                            $rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
                                            $counter++;
                                            ?>
                                            <tr>
                                                <?php if($can_delete){ ?>
                                                <th class=" td-checkbox">
                                                    <label class="custom-control custom-checkbox custom-control-inline">
                                                        <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['id'] ?>" type="checkbox" />
                                                            <span class="custom-control-label"></span>
                                                        </label>
                                                    </th>
                                                    <?php } ?>
                                                    <th class="td-sno"><?php echo $counter; ?></th>
                                                    <td class="td-id"><a href="<?php print_link("ficha/view/$data[id]") ?>"><?php echo $data['id']; ?></a></td>
                                                    <td class="td-fecha"> <?php echo $data['fecha']; ?></td>
                                                    <td class="td-producto_nombre_producto">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['producto_nombre_producto']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("producto/editfield/" . urlencode($data['id_producto'])); ?>" 
                                                            data-name="nombre_producto" 
                                                            data-title="Nombre" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['producto_nombre_producto']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-detalle_registro_fk_cantidad">
                                                        <span <?php if($can_edit){ ?> data-min="0" 
                                                            data-step="0.1" 
                                                            data-value="<?php echo $data['detalle_registro_fk_cantidad']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("detalle_registro/editfield/" . urlencode($data['id_detalle_registro'])); ?>" 
                                                            data-name="fk_cantidad" 
                                                            data-title="Cantidad a ser Enviada" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="number" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['detalle_registro_fk_cantidad']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-producto_cantidad_producto">
                                                        <span <?php if($can_edit){ ?> data-min="0" 
                                                            data-step="0.1" 
                                                            data-value="<?php echo $data['producto_cantidad_producto']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("producto/editfield/" . urlencode($data['id_producto'])); ?>" 
                                                            data-name="cantidad_producto" 
                                                            data-title="Cantidad" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="number" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['producto_cantidad_producto']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-enviado_id_enviado"> <?php echo $data['enviado_id_enviado']; ?></td>
                                                    <td class="td-enviado_fecha_enviado">
                                                        <span <?php if($can_edit){ ?> data-flatpickr="{ minDate: '', maxDate: ''}" 
                                                            data-value="<?php echo $data['enviado_fecha_enviado']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("enviado/editfield/" . urlencode($data['id_enviado'])); ?>" 
                                                            data-name="fecha_enviado" 
                                                            data-title="Enter Fecha Enviado" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="flatdatetimepicker" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['enviado_fecha_enviado']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-centro_Nombre_centro">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['centro_Nombre_centro']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("centro/editfield/" . urlencode($data['id_bodega'])); ?>" 
                                                            data-name="Nombre_centro" 
                                                            data-title="Ingrese Nombre" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['centro_Nombre_centro']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-enviado_png"><?php Html :: page_img($data['enviado_png'],50,50,1); ?></td>
                                                    <td class="td-recibido_id_recibido"> <?php echo $data['recibido_id_recibido']; ?></td>
                                                    <td class="td-recibido_fecha_recibido">
                                                        <span <?php if($can_edit){ ?> data-flatpickr="{ minDate: '', maxDate: ''}" 
                                                            data-value="<?php echo $data['recibido_fecha_recibido']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("recibido/editfield/" . urlencode($data['id_recibido'])); ?>" 
                                                            data-name="fecha_recibido" 
                                                            data-title="Enter Fecha Recibido" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="flatdatetimepicker" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['recibido_fecha_recibido']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-centro2_Nombre_centro">
                                                        <span <?php if($can_edit){ ?> data-value="<?php echo $data['centro2_Nombre_centro']; ?>" 
                                                            data-pk="<?php echo $data['id'] ?>" 
                                                            data-url="<?php print_link("centro/editfield/" . urlencode($data['id_bodega'])); ?>" 
                                                            data-name="Nombre_centro" 
                                                            data-title="Ingrese Nombre" 
                                                            data-placement="left" 
                                                            data-toggle="click" 
                                                            data-type="text" 
                                                            data-mode="popover" 
                                                            data-showbuttons="left" 
                                                            class="is-editable" <?php } ?>>
                                                            <?php echo $data['centro2_Nombre_centro']; ?> 
                                                        </span>
                                                    </td>
                                                    <td class="td-recibido_png"><?php Html :: page_img($data['recibido_png'],50,50,1); ?></td>
                                                    <th class="td-btn">
                                                        <?php if($can_view){ ?>
                                                        <a class="btn btn-sm btn-success has-tooltip" title="<?php print_lang('view_record'); ?>" href="<?php print_link("ficha/view/$rec_id"); ?>">
                                                            <i class="fa fa-eye"></i> <?php print_lang('view'); ?>
                                                        </a>
                                                        <?php } ?>
                                                        <?php if($can_edit){ ?>
                                                        <a class="btn btn-sm btn-info has-tooltip" title="<?php print_lang('edit_this_record'); ?>" href="<?php print_link("ficha/edit/$rec_id"); ?>">
                                                            <i class="fa fa-edit"></i> <?php print_lang('edit'); ?>
                                                        </a>
                                                        <?php } ?>
                                                        <?php if($can_delete){ ?>
                                                        <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="<?php print_lang('delete_this_record'); ?>" href="<?php print_link("ficha/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                                                            <i class="fa fa-times"></i>
                                                            <?php print_lang('delete'); ?>
                                                        </a>
                                                        <?php } ?>
                                                    </th>
                                                </tr>
                                                <?php 
                                                }
                                                ?>
                                                <!--endrecord-->
                                            </tbody>
                                            <tbody class="search-data" id="search-data-<?php echo $page_element_id; ?>"></tbody>
                                            <?php
                                            }
                                            ?>
                                        </table>
                                        <?php 
                                        if(empty($records)){
                                        ?>
                                        <h4 class="bg-light text-center border-top text-muted animated bounce  p-3">
                                            <i class="fa fa-ban"></i> <?php print_lang('0_records'); ?>
                                        </h4>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                    if( $show_footer && !empty($records)){
                                    ?>
                                    <div class=" border-top mt-2">
                                        <div class="row justify-content-center">    
                                            <div class="col-md-auto justify-content-center">    
                                                <div class="p-3 d-flex justify-content-between">    
                                                    <?php if($can_delete){ ?>
                                                    <button data-prompt-msg="<?php print_lang('are_you_sure_you_want_to_delete_these_records_'); ?>" data-display-style="modal" data-url="<?php print_link("ficha/delete/{sel_ids}/?csrf_token=$csrf_token&redirect=$current_page"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
                                                        <i class="fa fa-times"></i> <?php print_lang('delete_selected'); ?>
                                                    </button>
                                                    <?php } ?>
                                                    <div class="dropup export-btn-holder mx-1">
                                                        <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-save"></i> <?php print_lang('export'); ?>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <?php $export_print_link = $this->set_current_page_link(array('format' => 'print')); ?>
                                                            <a class="dropdown-item export-link-btn" data-format="print" href="<?php print_link($export_print_link); ?>" target="_blank">
                                                                <img src="<?php print_link('assets/images/print.png') ?>" class="mr-2" /> PRINT
                                                                </a>
                                                                <?php $export_pdf_link = $this->set_current_page_link(array('format' => 'pdf')); ?>
                                                                <a class="dropdown-item export-link-btn" data-format="pdf" href="<?php print_link($export_pdf_link); ?>" target="_blank">
                                                                    <img src="<?php print_link('assets/images/pdf.png') ?>" class="mr-2" /> PDF
                                                                    </a>
                                                                    <?php $export_word_link = $this->set_current_page_link(array('format' => 'word')); ?>
                                                                    <a class="dropdown-item export-link-btn" data-format="word" href="<?php print_link($export_word_link); ?>" target="_blank">
                                                                        <img src="<?php print_link('assets/images/doc.png') ?>" class="mr-2" /> WORD
                                                                        </a>
                                                                        <?php $export_csv_link = $this->set_current_page_link(array('format' => 'csv')); ?>
                                                                        <a class="dropdown-item export-link-btn" data-format="csv" href="<?php print_link($export_csv_link); ?>" target="_blank">
                                                                            <img src="<?php print_link('assets/images/csv.png') ?>" class="mr-2" /> CSV
                                                                            </a>
                                                                            <?php $export_excel_link = $this->set_current_page_link(array('format' => 'excel')); ?>
                                                                            <a class="dropdown-item export-link-btn" data-format="excel" href="<?php print_link($export_excel_link); ?>" target="_blank">
                                                                                <img src="<?php print_link('assets/images/xsl.png') ?>" class="mr-2" /> EXCEL
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col">   
                                                                    <?php
                                                                    if($show_pagination == true){
                                                                    $pager = new Pagination($total_records, $record_count);
                                                                    $pager->route = $this->route;
                                                                    $pager->show_page_count = true;
                                                                    $pager->show_record_count = true;
                                                                    $pager->show_page_limit =true;
                                                                    $pager->limit_count = $this->limit_count;
                                                                    $pager->show_page_number_list = true;
                                                                    $pager->pager_link_range=5;
                                                                    $pager->render();
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div  class="">
                                    <div class="container">
                                        <div class="row ">
                                            <div class="col-md-4 comp-grid">
                                                <h4 ><?php print_lang('suma_total_'); ?></h4>
                                            </div>
                                            <div class="col-sm-3 comp-grid">
                                                <?php $rec_count = $comp_model->getcount_montoenlps();  ?>
                                                <a class="animated slideInLeft record-count card bg-light text-dark"  href="<?php print_link("ficha/") ?>">
                                                    <div class="row">
                                                        <div class="col-2">
                                                            <i class="fa fa-money "></i>
                                                        </div>
                                                        <div class="col-10">
                                                            <div class="flex-column justify-content align-center">
                                                                <div class="title"> Monto en Lps.</div>
                                                                <small class=""></small>
                                                            </div>
                                                        </div>
                                                        <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-sm-3 comp-grid">
                                                <?php $rec_count = $comp_model->getcount_montototallps();  ?>
                                                <a class="animated rubberBand record-count card bg-light text-dark"  href="<?php print_link("ficha/") ?>">
                                                    <div class="row">
                                                        <div class="col-2">
                                                            <i class="fa fa-money "></i>
                                                        </div>
                                                        <div class="col-10">
                                                            <div class="flex-column justify-content align-center">
                                                                <div class="title">Monto Total Lps.</div>
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
                                <div  class="">
                                    <div class="container">
                                        <div class="row ">
                                            <div class="col-md-6 comp-grid">
                                                <button data-toggle="modal" data-target="#Modal-1-Page1" class="btn btn-primary"><i class='fa fa-truck '></i>  Rastreo de Envio</button>
                                                <div data-backdrop="true" class="modal fade" id="Modal-1-Page1" tabindex="-1" role="dialog" aria-labelledby="Modal1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle"><i class='fa fa-truck '></i>  Registros</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body p-0 reset-grids">
                                                                <div class=" ">
                                                                    <?php  
                                                                    $this->render_page("enviado/list?limit_count=20"); 
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 comp-grid">
                                                <button data-toggle="modal" data-target="#Modal-1-Page1" class="btn btn-primary"><i class='fa fa-truck '></i>  Rastreo de Llegada</button>
                                                <div data-backdrop="true" class="modal fade" id="Modal-1-Page1" tabindex="-1" role="dialog" aria-labelledby="Modal1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle"><i class='fa fa-truck '></i>  Registros</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body p-0 reset-grids">
                                                                <div class=" ">
                                                                    <?php  
                                                                    $this->render_page("recibido/list?limit_count=20"); 
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
