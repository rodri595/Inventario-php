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
                    <h4 class="record-title"><?php print_lang('view_detalle_registro'); ?></h4>
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
                        $rec_id = (!empty($data['id_detalle_registro']) ? urlencode($data['id_detalle_registro']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-id_detalle_registro">
                                        <th class="title"> <?php print_lang('id_detalle_registro'); ?>: </th>
                                        <td class="value"> <?php echo $data['id_detalle_registro']; ?></td>
                                    </tr>
                                    <tr  class="td-fk_registro">
                                        <th class="title"> <?php print_lang('fk_registro'); ?>: </th>
                                        <td class="value">
                                            <span  data-min="0" 
                                                data-value="<?php echo $data['fk_registro']; ?>" 
                                                data-pk="<?php echo $data['id_detalle_registro'] ?>" 
                                                data-url="<?php print_link("detalle_registro/editfield/" . urlencode($data['id_detalle_registro'])); ?>" 
                                                data-name="fk_registro" 
                                                data-title="Generando..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['fk_registro']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-fk_producto">
                                        <th class="title"> <?php print_lang('fk_producto'); ?>: </th>
                                        <td class="value">
                                            <a size="sm" class="btn btn-sm btn-primary page-modal" href="<?php print_link("producto/view/" . urlencode($data['fk_producto'])) ?>">
                                                <i class="fa fa-check-circle-o "></i> <?php echo $data['producto_nombre_producto'] ?>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr  class="td-fk_cantidad">
                                        <th class="title"> <?php print_lang('fk_cantidad'); ?>: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['fk_cantidad']; ?>" 
                                                data-pk="<?php echo $data['id_detalle_registro'] ?>" 
                                                data-url="<?php print_link("detalle_registro/editfield/" . urlencode($data['id_detalle_registro'])); ?>" 
                                                data-name="fk_cantidad" 
                                                data-title="Enter Cantidad" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['fk_cantidad']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-desc_detalle">
                                        <th class="title"> <?php print_lang('desc_detalle'); ?>: </th>
                                        <td class="value">
                                            <span  data-pk="<?php echo $data['id_detalle_registro'] ?>" 
                                                data-url="<?php print_link("detalle_registro/editfield/" . urlencode($data['id_detalle_registro'])); ?>" 
                                                data-name="desc_detalle" 
                                                data-title="Detalles del producto" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="textarea" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['desc_detalle']; ?> 
                                            </span>
                                        </td>
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
                                    <tr  class="td-producto_fecha_ultima_update">
                                        <th class="title"> <?php print_lang('producto_fecha_ultima_update'); ?>: </th>
                                        <td class="value"> <?php echo $data['producto_fecha_ultima_update']; ?></td>
                                    </tr>
                                    <tr  class="td-producto_fecha_delete">
                                        <th class="title"> <?php print_lang('producto_fecha_delete'); ?>: </th>
                                        <td class="value"> <?php echo $data['producto_fecha_delete']; ?></td>
                                    </tr>
                                    <tr  class="td-producto_isdeleted">
                                        <th class="title"> <?php print_lang('producto_isdeleted'); ?>: </th>
                                        <td class="value"> <?php echo $data['producto_isdeleted']; ?></td>
                                    </tr>
                                    <tr  class="td-producto_precio_producto">
                                        <th class="title"><i class="fa fa-money "></i> <?php print_lang('producto_precio_producto'); ?>: </th>
                                        <td class="value"> <?php echo $data['producto_precio_producto']; ?></td>
                                    </tr>
                                    <tr  class="td-producto_creadopor_producto">
                                        <th class="title"> <?php print_lang('producto_creadopor_producto'); ?>: </th>
                                        <td class="value"> <?php echo $data['producto_creadopor_producto']; ?></td>
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
                                                <a class="btn btn-sm btn-info"  href="<?php print_link("detalle_registro/edit/$rec_id"); ?>">
                                                    <i class="fa fa-edit"></i> <?php print_lang('edit'); ?>
                                                </a>
                                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("detalle_registro/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
                                                    <i class="fa fa-times"></i> <?php print_lang('delete'); ?>
                                                </a>
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
