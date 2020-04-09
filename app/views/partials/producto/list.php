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
                    <h4 class="record-title"><?php print_lang('lista_de_todos_los_producto'); ?></h4>
                </div>
                <div class="col-sm-3 ">
                    <a  class="btn btn btn-primary my-1" href="<?php print_link("producto/add") ?>">
                        <i class="fa fa-plus"></i>                              
                        <?php print_lang('add_new_producto'); ?> 
                    </a>
                </div>
                <div class="col-sm-4 ">
                    <form  class="search" action="<?php print_link('producto'); ?>" method="get">
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
                                        <a class="text-decoration-none" href="<?php print_link('producto'); ?>">
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
                                        <a class="text-decoration-none" href="<?php print_link('producto'); ?>">
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
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-md-3 comp-grid">
                        <form method="get" action="<?php print_link($current_page) ?>" class="form filter-form">
                            <h3 ><?php print_lang('filtra_por_'); ?></h3>
                            <div class="card mb-3">
                                <div class="card-header h4 h4">Fecha Creacion</div>
                                <div class="p-2">
                                    <input class="form-control datepicker"  value="<?php echo $this->set_field_value('producto_fecha_creacion') ?>" type="datetime"  name="producto_fecha_creacion" placeholder="<?php print_lang(''); ?>" data-enable-time="" data-date-format="Y-m-d" data-alt-format="M j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-header h4 h4">Proveedor</div>
                                    <div class="p-2">
                                        <?php
                                        $producto_fk_proveedor_options = Menu :: $producto_fk_proveedor;
                                        if(!empty($producto_fk_proveedor_options)){
                                        foreach($producto_fk_proveedor_options as $option){
                                        $value = $option['value'];
                                        $label = $option['label'];
                                        //check if current option is checked option
                                        $checked = $this->set_field_checked('producto_fk_proveedor', $value);
                                        ?>
                                        <label class="custom-control custom-radio custom-control-inline">
                                            <input id="" class="custom-control-input" <?php echo $checked ?>  value="<?php echo $value ?>" type="radio" name="producto_fk_proveedor"  />
                                                <span class="custom-control-label"><?php echo $label ?></span>
                                            </label>
                                            <?php
                                            }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="card mb-3">
                                        <div class="card-header h4 h4">Nombre Producto</div>
                                        <div class="p-2">
                                            <?php
                                            $producto_nombre_producto_options = Menu :: $producto_fk_proveedor;
                                            if(!empty($producto_nombre_producto_options)){
                                            foreach($producto_nombre_producto_options as $option){
                                            $value = $option['value'];
                                            $label = $option['label'];
                                            //check if current option is checked option
                                            $checked = $this->set_field_checked('producto_nombre_producto', $value);
                                            ?>
                                            <label class="custom-control custom-checkbox custom-control-inline option-btn">
                                                <input id="" class="custom-control-input" value="<?php echo $value ?>" <?php echo $checked ?> type="checkbox" name="producto_nombre_producto[]" />
                                                    <span class="custom-control-label"><?php echo $label ?></span>
                                                </label>
                                                <?php
                                                }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="card mb-3">
                                            <div class="card-header h4 h4">Peso Producto</div>
                                            <div class="p-2">
                                                <?php 
                                                $to = 10;
                                                $from = 0;
                                                if(!empty($_GET['producto_peso_producto'])){
                                                $range = explode('-', get_value('producto_peso_producto'));
                                                $from = $range[0];
                                                $to = (!empty($range[1]) ? $range[1] : null);
                                                }
                                                ?>
                                                <input class="ion-range" type="text" data-from="<?php echo $from ?>" data-to="<?php echo $to ?>" data-force_edge="true" data-prefix="" data-postfix=""  name="producto_peso_producto" data-step="10" data-type="double" data-min="0"   data-max="1000"   data-grid="true" data-grid-snap="true" /> 
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="form-group text-center">
                                                <button class="btn btn-primary">Filter</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-md-9 comp-grid">
                                        <?php $this :: display_page_errors(); ?>
                                        <div class="filter-tags mb-2">
                                            <?php
                                            if(!empty($_GET['producto_fecha_creacion'])){
                                            ?>
                                            <div class="filter-chip card bg-light">
                                                <b>Producto Fecha Creacion :</b> 
                                                <?php
                                                $date_val = get_value('producto_fecha_creacion');
                                                $formated_date = "";
                                                if(str_contains('to', $date_val)){
                                                //if value is a range date
                                                $vals = explode('to' , str_replace(' ' , '' , $date_val));
                                                $startdate = $vals[0];
                                                $enddate = $vals[1];
                                                $formated_date = format_date($startdate, 'jS F, Y') . ' <span class="text-muted">&#10148;</span> ' . format_date($enddate, 'jS F, Y');
                                                }
                                                elseif(str_contains(',', $date_val)){
                                                //multi date values
                                                $vals = explode(',' , str_replace(' ' , '' , $date_val));
                                                $formated_arrs = array_map(function($date){return format_date($date, 'jS F, Y');}, $vals);
                                                $formated_date = implode(' <span class="text-info">&#11161;</span> ', $formated_arrs);
                                                }
                                                else{
                                                $formated_date = format_date($date_val, 'jS F, Y');
                                                }
                                                echo  $formated_date;
                                                ?>
                                                <a href="<?php print_link(unset_get_value('producto_fecha_creacion')); ?>" class="close-btn">
                                                    &times;
                                                </a>
                                            </div>
                                            <?php
                                            }
                                            ?>
                                            <?php
                                            if(!empty(get_value('producto_fk_proveedor'))){
                                            ?>
                                            <div class="filter-chip card bg-light">
                                                <b>Producto Fk Proveedor :</b> 
                                                <?php 
                                                if(get_value('producto_fk_proveedorlabel')){
                                                echo get_value('producto_fk_proveedorlabel');
                                                }
                                                else{
                                                echo get_value('producto_fk_proveedor');
                                                }
                                                ?>
                                                <a href="<?php print_link(unset_get_value('producto_fk_proveedor')); ?>" class="close-btn">
                                                    &times;
                                                </a>
                                            </div>
                                            <?php
                                            }
                                            ?>
                                            <?php
                                            if(!empty(get_value('producto_nombre_producto'))){
                                            ?>
                                            <div class="filter-chip card bg-light">
                                                <b>Producto Nombre Producto :</b> 
                                                <?php 
                                                if(get_value('producto_nombre_productolabel')){
                                                echo get_value('producto_nombre_productolabel');
                                                }
                                                else{
                                                echo get_value('producto_nombre_producto');
                                                }
                                                ?>
                                                <a href="<?php print_link(unset_get_value('producto_nombre_producto')); ?>" class="close-btn">
                                                    &times;
                                                </a>
                                            </div>
                                            <?php
                                            }
                                            ?>
                                            <?php
                                            if(!empty(get_value('producto_peso_producto'))){
                                            ?>
                                            <div class="filter-chip card bg-light">
                                                <b>Producto Peso Producto :</b> 
                                                <?php 
                                                if(get_value('producto_peso_productolabel')){
                                                echo get_value('producto_peso_productolabel');
                                                }
                                                else{
                                                echo get_value('producto_peso_producto');
                                                }
                                                ?>
                                                <a href="<?php print_link(unset_get_value('producto_peso_producto')); ?>" class="close-btn">
                                                    &times;
                                                </a>
                                            </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div  class=" animated fadeIn page-content">
                                            <div id="producto-list-records">
                                                <div id="page-report-body" class="table-responsive">
                                                    <table class="table  table-striped table-sm text-left">
                                                        <thead class="table-header bg-light">
                                                            <tr>
                                                                <th class="td-checkbox">
                                                                    <label class="custom-control custom-checkbox custom-control-inline">
                                                                        <input class="toggle-check-all custom-control-input" type="checkbox" />
                                                                        <span class="custom-control-label"></span>
                                                                    </label>
                                                                </th>
                                                                <th class="td-sno">#</th>
                                                                <th  class="td-id_producto"> <?php print_lang('id_producto'); ?></th>
                                                                <th  class="td-nombre_producto"> <?php print_lang('nombre_producto'); ?></th>
                                                                <th  class="td-desc_producto"> <?php print_lang('descripci_n'); ?></th>
                                                                <th  class="td-precio_producto"> <?php print_lang('precio'); ?></th>
                                                                <th  class="td-cantidad_producto"> <?php print_lang('cantidad'); ?></th>
                                                                <th  class="td-peso_producto"> <?php print_lang('peso'); ?></th>
                                                                <th  class="td-dimension_producto"> <?php print_lang('dimension'); ?></th>
                                                                <th  class="td-fk_proveedor"> <?php print_lang('proveedor'); ?></th>
                                                                <th  class="td-fk_categoria"> <?php print_lang('categoria'); ?></th>
                                                                <th  class="td-fecha_creacion"> <?php print_lang('fecha_creacion'); ?></th>
                                                                <th  class="td-creadopor_producto"> <?php print_lang('creadopor_producto'); ?></th>
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
                                                            $rec_id = (!empty($data['id_producto']) ? urlencode($data['id_producto']) : null);
                                                            $counter++;
                                                            ?>
                                                            <tr>
                                                                <th class=" td-checkbox">
                                                                    <label class="custom-control custom-checkbox custom-control-inline">
                                                                        <input class="optioncheck custom-control-input" name="optioncheck[]" value="<?php echo $data['id_producto'] ?>" type="checkbox" />
                                                                            <span class="custom-control-label"></span>
                                                                        </label>
                                                                    </th>
                                                                    <th class="td-sno"><?php echo $counter; ?></th>
                                                                    <td class="td-id_producto"><a href="<?php print_link("producto/view/$data[id_producto]") ?>"><?php echo $data['id_producto']; ?></a></td>
                                                                    <td class="td-nombre_producto">
                                                                        <span  data-value="<?php echo $data['nombre_producto']; ?>" 
                                                                            data-pk="<?php echo $data['id_producto'] ?>" 
                                                                            data-url="<?php print_link("producto/editfield/" . urlencode($data['id_producto'])); ?>" 
                                                                            data-name="nombre_producto" 
                                                                            data-title="Producto" 
                                                                            data-placement="left" 
                                                                            data-toggle="click" 
                                                                            data-type="text" 
                                                                            data-mode="popover" 
                                                                            data-showbuttons="left" 
                                                                            class="is-editable" >
                                                                            <?php echo $data['nombre_producto']; ?> 
                                                                        </span>
                                                                    </td>
                                                                    <td class="td-desc_producto">
                                                                        <span  data-value="<?php echo $data['desc_producto']; ?>" 
                                                                            data-pk="<?php echo $data['id_producto'] ?>" 
                                                                            data-url="<?php print_link("producto/editfield/" . urlencode($data['id_producto'])); ?>" 
                                                                            data-name="desc_producto" 
                                                                            data-title="Descripción" 
                                                                            data-placement="left" 
                                                                            data-toggle="click" 
                                                                            data-type="text" 
                                                                            data-mode="popover" 
                                                                            data-showbuttons="left" 
                                                                            class="is-editable" >
                                                                            <?php echo $data['desc_producto']; ?> 
                                                                        </span>
                                                                    </td>
                                                                    <td class="td-precio_producto">
                                                                        <span  data-step="0.1" 
                                                                            data-value="<?php echo $data['precio_producto']; ?>" 
                                                                            data-pk="<?php echo $data['id_producto'] ?>" 
                                                                            data-url="<?php print_link("producto/editfield/" . urlencode($data['id_producto'])); ?>" 
                                                                            data-name="precio_producto" 
                                                                            data-title="Enter Precio Producto" 
                                                                            data-placement="left" 
                                                                            data-toggle="click" 
                                                                            data-type="number" 
                                                                            data-mode="popover" 
                                                                            data-showbuttons="left" 
                                                                            class="is-editable" >
                                                                            <?php echo $data['precio_producto']; ?> 
                                                                        </span>
                                                                    </td>
                                                                    <td class="td-cantidad_producto">
                                                                        <span  data-value="<?php echo $data['cantidad_producto']; ?>" 
                                                                            data-pk="<?php echo $data['id_producto'] ?>" 
                                                                            data-url="<?php print_link("producto/editfield/" . urlencode($data['id_producto'])); ?>" 
                                                                            data-name="cantidad_producto" 
                                                                            data-title="Cantidad Producto" 
                                                                            data-placement="left" 
                                                                            data-toggle="click" 
                                                                            data-type="text" 
                                                                            data-mode="popover" 
                                                                            data-showbuttons="left" 
                                                                            class="is-editable" >
                                                                            <?php echo $data['cantidad_producto']; ?> 
                                                                        </span>
                                                                    </td>
                                                                    <td class="td-peso_producto">
                                                                        <span  data-value="<?php echo $data['peso_producto']; ?>" 
                                                                            data-pk="<?php echo $data['id_producto'] ?>" 
                                                                            data-url="<?php print_link("producto/editfield/" . urlencode($data['id_producto'])); ?>" 
                                                                            data-name="peso_producto" 
                                                                            data-title="Peso" 
                                                                            data-placement="left" 
                                                                            data-toggle="click" 
                                                                            data-type="text" 
                                                                            data-mode="popover" 
                                                                            data-showbuttons="left" 
                                                                            class="is-editable" >
                                                                            <?php echo $data['peso_producto']; ?> 
                                                                        </span>
                                                                    </td>
                                                                    <td class="td-dimension_producto">
                                                                        <span  data-value="<?php echo $data['dimension_producto']; ?>" 
                                                                            data-pk="<?php echo $data['id_producto'] ?>" 
                                                                            data-url="<?php print_link("producto/editfield/" . urlencode($data['id_producto'])); ?>" 
                                                                            data-name="dimension_producto" 
                                                                            data-title="Dimensiones" 
                                                                            data-placement="left" 
                                                                            data-toggle="click" 
                                                                            data-type="text" 
                                                                            data-mode="popover" 
                                                                            data-showbuttons="left" 
                                                                            class="is-editable" >
                                                                            <?php echo $data['dimension_producto']; ?> 
                                                                        </span>
                                                                    </td>
                                                                    <td class="td-fk_proveedor">
                                                                        <a size="sm" class="btn btn-secondary page-modal" href="<?php print_link("proveedor/view/" . urlencode($data['fk_proveedor'])) ?>">
                                                                            <i class="fa fa-plane "></i> <?php echo $data['proveedor_nombre_proveedor'] ?>
                                                                        </a>
                                                                    </td>
                                                                    <td class="td-fk_categoria">
                                                                        <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("categoria/view/" . urlencode($data['fk_categoria'])) ?>">
                                                                            <i class="fa fa-certificate "></i> <?php echo $data['categoria_desc_categoria'] ?>
                                                                        </a>
                                                                    </td>
                                                                    <td class="td-fecha_creacion"> <?php echo $data['fecha_creacion']; ?></td>
                                                                    <td class="td-creadopor_producto">
                                                                        <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("usuario/view/" . urlencode($data['creadopor_producto'])) ?>">
                                                                            <i class="fa fa-eye"></i> <?php echo $data['usuario_user_usuario'] ?>
                                                                        </a>
                                                                    </td>
                                                                    <th class="td-btn">
                                                                        <a class="btn btn-sm btn-success has-tooltip" title="<?php print_lang('view_record'); ?>" href="<?php print_link("producto/view/$rec_id"); ?>">
                                                                            <i class="fa fa-eye"></i> <?php print_lang('view'); ?>
                                                                        </a>
                                                                        <a class="btn btn-sm btn-info has-tooltip" title="<?php print_lang('edit_this_record'); ?>" href="<?php print_link("producto/edit/$rec_id"); ?>">
                                                                            <i class="fa fa-edit"></i> <?php print_lang('edit'); ?>
                                                                        </a>
                                                                        <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" title="<?php print_lang('delete_this_record'); ?>" href="<?php print_link("producto/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                                                                            <i class="fa fa-times"></i>
                                                                            <?php print_lang('delete'); ?>
                                                                        </a>
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
                                                            <i class="fa fa-ban"></i> <?php print_lang('no_record_found'); ?>
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
                                                                    <button data-prompt-msg="<?php print_lang('are_you_sure_you_want_to_delete_these_records_'); ?>" data-display-style="modal" data-url="<?php print_link("producto/delete/{sel_ids}/?csrf_token=$csrf_token&redirect=$current_page"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
                                                                        <i class="fa fa-times"></i> <?php print_lang('delete_selected'); ?>
                                                                    </button>
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
                                            </section>
