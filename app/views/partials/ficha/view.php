<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("ficha/add");
$can_edit = ACL::is_allowed("ficha/edit");
$can_view = ACL::is_allowed("ficha/view");
$can_delete = ACL::is_allowed("ficha/delete");
?>
<?php
$comp_model = new SharedController;
$page_element_id = "view-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data Information from Controller
$data = $this->view_data;
//$rec_id = $data['__tableprimarykey'];
$page_id = $this->route->page_id; //Page id from url
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_edit_btn = $this->show_edit_btn;
$show_delete_btn = $this->show_delete_btn;
$show_export_btn = $this->show_export_btn;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="view" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title"><?php print_lang('reporte_de_ficha'); ?></h4>
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
                    <?php $this :: display_page_errors(); ?>
                    <div  class="card animated fadeIn page-content">
                        <?php
                        $counter = 0;
                        if(!empty($data)){
                        $rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-id">
                                        <th class="title"><i class="fa fa-chevron-circle-down "></i> <?php print_lang('id_de_ficha_de_registro'); ?>: </th>
                                        <td class="value"> <?php echo $data['id']; ?></td>
                                    </tr>
                                    <tr  class="td-fecha">
                                        <th class="title"><i class="fa fa-calendar-plus-o "></i> <?php print_lang('fecha_creacion_de_ficha'); ?>: </th>
                                        <td class="value"> <?php echo $data['fecha']; ?></td>
                                    </tr>
                                    <tr  class="td-fk_receptor">
                                        <th class="title"> <?php print_lang('codigo_de_lugar_de_recibido'); ?>: </th>
                                        <td class="value">
                                            <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("recibido/view/" . urlencode($data['fk_receptor'])) ?>">
                                                <i class="fa fa-building-o "></i> <?php echo $data['recibido_lugar_recibido'] ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr  class="td-centro2_Nombre_centro">
                                        <th class="title"><i class="fa fa-building-o "></i> <?php print_lang('lugar_de_salida'); ?>: </th>
                                        <td class="value"> <?php echo $data['centro2_Nombre_centro']; ?></td>
                                    </tr>
                                    <tr  class="td-centro2_Tel_centro">
                                        <th class="title"> <?php print_lang('telefono_de_lugar'); ?>: </th>
                                        <td class="value"> <?php echo $data['centro2_Tel_centro']; ?></td>
                                    </tr>
                                    <tr  class="td-centro2_direccion_centro">
                                        <th class="title"> <?php print_lang('direccion_de_salida'); ?>: </th>
                                        <td class="value"> <?php echo $data['centro2_direccion_centro']; ?></td>
                                    </tr>
                                    <tr  class="td-centro2_numero_centro">
                                        <th class="title"> <?php print_lang('referencia_sala_bodega_salida'); ?>: </th>
                                        <td class="value"> <?php echo $data['centro2_numero_centro']; ?></td>
                                    </tr>
                                    <tr  class="td-fk_emisor">
                                        <th class="title"> <?php print_lang('codigo_de_lugar_de_envio'); ?>: </th>
                                        <td class="value">
                                            <a size="sm" class="btn btn-secondary page-modal" href="<?php print_link("enviado/view/" . urlencode($data['fk_emisor'])) ?>">
                                                <i class="fa fa-building "></i> <?php echo $data['enviado_lugar_salida'] ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr  class="td-enviado_id_enviado">
                                        <th class="title"> <?php print_lang('enviado_id_enviado'); ?>: </th>
                                        <td class="value"> <?php echo $data['enviado_id_enviado']; ?></td>
                                    </tr>
                                    <tr  class="td-enviado_fecha_enviado">
                                        <th class="title"> <?php print_lang('enviado_fecha_enviado'); ?>: </th>
                                        <td class="value"> <?php echo $data['enviado_fecha_enviado']; ?></td>
                                    </tr>
                                    <tr  class="td-enviado_lugar_salida">
                                        <th class="title"> <?php print_lang('enviado_lugar_salida'); ?>: </th>
                                        <td class="value"> <?php echo $data['enviado_lugar_salida']; ?></td>
                                    </tr>
                                    <tr  class="td-enviado_png">
                                        <th class="title"> <?php print_lang('enviado_png'); ?>: </th>
                                        <td class="value"> <?php echo $data['enviado_png']; ?></td>
                                    </tr>
                                    <tr  class="td-enviado_creacion">
                                        <th class="title"> <?php print_lang('enviado_creacion'); ?>: </th>
                                        <td class="value"> <?php echo $data['enviado_creacion']; ?></td>
                                    </tr>
                                    <tr  class="td-recibido_id_recibido">
                                        <th class="title"> <?php print_lang('recibido_id_recibido'); ?>: </th>
                                        <td class="value"> <?php echo $data['recibido_id_recibido']; ?></td>
                                    </tr>
                                    <tr  class="td-recibido_fecha_recibido">
                                        <th class="title"> <?php print_lang('recibido_fecha_recibido'); ?>: </th>
                                        <td class="value"> <?php echo $data['recibido_fecha_recibido']; ?></td>
                                    </tr>
                                    <tr  class="td-recibido_lugar_recibido">
                                        <th class="title"> <?php print_lang('recibido_lugar_recibido'); ?>: </th>
                                        <td class="value"> <?php echo $data['recibido_lugar_recibido']; ?></td>
                                    </tr>
                                    <tr  class="td-recibido_png">
                                        <th class="title"> <?php print_lang('recibido_png'); ?>: </th>
                                        <td class="value"> <?php echo $data['recibido_png']; ?></td>
                                    </tr>
                                    <tr  class="td-recibido_creacion">
                                        <th class="title"> <?php print_lang('recibido_creacion'); ?>: </th>
                                        <td class="value"> <?php echo $data['recibido_creacion']; ?></td>
                                    </tr>
                                    <tr  class="td-centro_Tel_centro">
                                        <th class="title"> <?php print_lang('centro_tel_centro'); ?>: </th>
                                        <td class="value"> <?php echo $data['centro_Tel_centro']; ?></td>
                                    </tr>
                                    <tr  class="td-centro_id_centro">
                                        <th class="title"> <?php print_lang('centro_id_centro'); ?>: </th>
                                        <td class="value"> <?php echo $data['centro_id_centro']; ?></td>
                                    </tr>
                                    <tr  class="td-centro_numero_centro">
                                        <th class="title"> <?php print_lang('centro_numero_centro'); ?>: </th>
                                        <td class="value"> <?php echo $data['centro_numero_centro']; ?></td>
                                    </tr>
                                    <tr  class="td-centro_direccion_centro">
                                        <th class="title"> <?php print_lang('centro_direccion_centro'); ?>: </th>
                                        <td class="value"> <?php echo $data['centro_direccion_centro']; ?></td>
                                    </tr>
                                    <tr  class="td-centro_Nombre_centro">
                                        <th class="title"> <?php print_lang('centro_nombre_centro'); ?>: </th>
                                        <td class="value"> <?php echo $data['centro_Nombre_centro']; ?></td>
                                    </tr>
                                    <tr  class="td-centro_fecha_creacion">
                                        <th class="title"> <?php print_lang('centro_fecha_creacion'); ?>: </th>
                                        <td class="value"> <?php echo $data['centro_fecha_creacion']; ?></td>
                                    </tr>
                                    <tr  class="td-detalle_registro_id_detalle_registro">
                                        <th class="title"> <?php print_lang('detalle_registro_id_detalle_registro'); ?>: </th>
                                        <td class="value"> <?php echo $data['detalle_registro_id_detalle_registro']; ?></td>
                                    </tr>
                                    <tr  class="td-detalle_registro_fk_registro">
                                        <th class="title"> <?php print_lang('detalle_registro_fk_registro'); ?>: </th>
                                        <td class="value"> <?php echo $data['detalle_registro_fk_registro']; ?></td>
                                    </tr>
                                    <tr  class="td-detalle_registro_fk_producto">
                                        <th class="title"> <?php print_lang('detalle_registro_fk_producto'); ?>: </th>
                                        <td class="value"> <?php echo $data['detalle_registro_fk_producto']; ?></td>
                                    </tr>
                                    <tr  class="td-detalle_registro_fk_cantidad">
                                        <th class="title"> <?php print_lang('detalle_registro_fk_cantidad'); ?>: </th>
                                        <td class="value"> <?php echo $data['detalle_registro_fk_cantidad']; ?></td>
                                    </tr>
                                    <tr  class="td-detalle_registro_desc_detalle">
                                        <th class="title"> <?php print_lang('detalle_registro_desc_detalle'); ?>: </th>
                                        <td class="value"> <?php echo $data['detalle_registro_desc_detalle']; ?></td>
                                    </tr>
                                    <tr  class="td-producto_id_producto">
                                        <th class="title"> <?php print_lang('producto_id_producto'); ?>: </th>
                                        <td class="value"> <?php echo $data['producto_id_producto']; ?></td>
                                    </tr>
                                    <tr  class="td-producto_nombre_producto">
                                        <th class="title"> <?php print_lang('producto_nombre_producto'); ?>: </th>
                                        <td class="value"> <?php echo $data['producto_nombre_producto']; ?></td>
                                    </tr>
                                    <tr  class="td-producto_desc_producto">
                                        <th class="title"> <?php print_lang('producto_desc_producto'); ?>: </th>
                                        <td class="value"> <?php echo $data['producto_desc_producto']; ?></td>
                                    </tr>
                                    <tr  class="td-producto_cantidad_producto">
                                        <th class="title"> <?php print_lang('producto_cantidad_producto'); ?>: </th>
                                        <td class="value"> <?php echo $data['producto_cantidad_producto']; ?></td>
                                    </tr>
                                    <tr  class="td-producto_peso_producto">
                                        <th class="title"> <?php print_lang('producto_peso_producto'); ?>: </th>
                                        <td class="value"> <?php echo $data['producto_peso_producto']; ?></td>
                                    </tr>
                                    <tr  class="td-producto_dimension_producto">
                                        <th class="title"> <?php print_lang('producto_dimension_producto'); ?>: </th>
                                        <td class="value"> <?php echo $data['producto_dimension_producto']; ?></td>
                                    </tr>
                                    <tr  class="td-producto_fk_proveedor">
                                        <th class="title"> <?php print_lang('producto_fk_proveedor'); ?>: </th>
                                        <td class="value"> <?php echo $data['producto_fk_proveedor']; ?></td>
                                    </tr>
                                    <tr  class="td-producto_fk_categoria">
                                        <th class="title"> <?php print_lang('producto_fk_categoria'); ?>: </th>
                                        <td class="value"> <?php echo $data['producto_fk_categoria']; ?></td>
                                    </tr>
                                    <tr  class="td-producto_fecha_creacion">
                                        <th class="title"> <?php print_lang('producto_fecha_creacion'); ?>: </th>
                                        <td class="value"> <?php echo $data['producto_fecha_creacion']; ?></td>
                                    </tr>
                                    <tr  class="td-producto_precio_producto">
                                        <th class="title"> <?php print_lang('producto_precio_producto'); ?>: </th>
                                        <td class="value"> <?php echo $data['producto_precio_producto']; ?></td>
                                    </tr>
                                </tbody>
                                <!-- Table Body End -->
                            </table>
                        </div>
                        <div class="p-3 d-flex">
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
                                                <?php if($can_edit){ ?>
                                                <a class="btn btn-sm btn-info"  href="<?php print_link("ficha/edit/$rec_id"); ?>">
                                                    <i class="fa fa-edit"></i> <?php print_lang('edit'); ?>
                                                </a>
                                                <?php } ?>
                                                <?php if($can_delete){ ?>
                                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("ficha/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                                                    <i class="fa fa-times"></i> <?php print_lang('delete'); ?>
                                                </a>
                                                <?php } ?>
                                            </div>
                                            <?php
                                            }
                                            else{
                                            ?>
                                            <!-- Empty Record Message -->
                                            <div class="text-muted p-3">
                                                <i class="fa fa-ban"></i> <?php print_lang('no_record_found'); ?>
                                            </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
