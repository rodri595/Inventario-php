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
                    <h4 class="record-title"><?php print_lang('view_producto2'); ?></h4>
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
                        $rec_id = (!empty($data['id_producto']) ? urlencode($data['id_producto']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-id_producto">
                                        <th class="title"> <?php print_lang('id_producto'); ?>: </th>
                                        <td class="value"> <?php echo $data['id_producto']; ?></td>
                                    </tr>
                                    <tr  class="td-nombre_producto">
                                        <th class="title"> <?php print_lang('nombre_producto'); ?>: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['nombre_producto']; ?>" 
                                                data-pk="<?php echo $data['id_producto'] ?>" 
                                                data-url="<?php print_link("producto2/editfield/" . urlencode($data['id_producto'])); ?>" 
                                                data-name="nombre_producto" 
                                                data-title="Enter Nombre Producto" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['nombre_producto']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-desc_producto">
                                        <th class="title"> <?php print_lang('desc_producto'); ?>: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['desc_producto']; ?>" 
                                                data-pk="<?php echo $data['id_producto'] ?>" 
                                                data-url="<?php print_link("producto2/editfield/" . urlencode($data['id_producto'])); ?>" 
                                                data-name="desc_producto" 
                                                data-title="Enter Desc Producto" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['desc_producto']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-cantidad_producto">
                                        <th class="title"> <?php print_lang('cantidad_producto'); ?>: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['cantidad_producto']; ?>" 
                                                data-pk="<?php echo $data['id_producto'] ?>" 
                                                data-url="<?php print_link("producto2/editfield/" . urlencode($data['id_producto'])); ?>" 
                                                data-name="cantidad_producto" 
                                                data-title="Enter Cantidad Producto" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['cantidad_producto']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-peso_producto">
                                        <th class="title"> <?php print_lang('peso_producto'); ?>: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['peso_producto']; ?>" 
                                                data-pk="<?php echo $data['id_producto'] ?>" 
                                                data-url="<?php print_link("producto2/editfield/" . urlencode($data['id_producto'])); ?>" 
                                                data-name="peso_producto" 
                                                data-title="Enter Peso Producto" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['peso_producto']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-dimension_producto">
                                        <th class="title"> <?php print_lang('dimension_producto'); ?>: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['dimension_producto']; ?>" 
                                                data-pk="<?php echo $data['id_producto'] ?>" 
                                                data-url="<?php print_link("producto2/editfield/" . urlencode($data['id_producto'])); ?>" 
                                                data-name="dimension_producto" 
                                                data-title="Enter Dimension Producto" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['dimension_producto']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-fk_proveedor">
                                        <th class="title"> <?php print_lang('fk_proveedor'); ?>: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['fk_proveedor']; ?>" 
                                                data-pk="<?php echo $data['id_producto'] ?>" 
                                                data-url="<?php print_link("producto2/editfield/" . urlencode($data['id_producto'])); ?>" 
                                                data-name="fk_proveedor" 
                                                data-title="Enter Fk Proveedor" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['fk_proveedor']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-fk_categoria">
                                        <th class="title"> <?php print_lang('fk_categoria'); ?>: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['fk_categoria']; ?>" 
                                                data-pk="<?php echo $data['id_producto'] ?>" 
                                                data-url="<?php print_link("producto2/editfield/" . urlencode($data['id_producto'])); ?>" 
                                                data-name="fk_categoria" 
                                                data-title="Enter Fk Categoria" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['fk_categoria']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-fecha_creacion">
                                        <th class="title"> <?php print_lang('fecha_creacion'); ?>: </th>
                                        <td class="value">
                                            <span  data-flatpickr="{ minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['fecha_creacion']; ?>" 
                                                data-pk="<?php echo $data['id_producto'] ?>" 
                                                data-url="<?php print_link("producto2/editfield/" . urlencode($data['id_producto'])); ?>" 
                                                data-name="fecha_creacion" 
                                                data-title="Enter Fecha Creacion" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['fecha_creacion']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-fecha_ultima_update">
                                        <th class="title"> <?php print_lang('fecha_ultima_update'); ?>: </th>
                                        <td class="value">
                                            <span  data-flatpickr="{ minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['fecha_ultima_update']; ?>" 
                                                data-pk="<?php echo $data['id_producto'] ?>" 
                                                data-url="<?php print_link("producto2/editfield/" . urlencode($data['id_producto'])); ?>" 
                                                data-name="fecha_ultima_update" 
                                                data-title="Enter Fecha Ultima Update" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['fecha_ultima_update']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-fecha_delete">
                                        <th class="title"> <?php print_lang('fecha_delete'); ?>: </th>
                                        <td class="value">
                                            <span  data-flatpickr="{ minDate: '', maxDate: ''}" 
                                                data-value="<?php echo $data['fecha_delete']; ?>" 
                                                data-pk="<?php echo $data['id_producto'] ?>" 
                                                data-url="<?php print_link("producto2/editfield/" . urlencode($data['id_producto'])); ?>" 
                                                data-name="fecha_delete" 
                                                data-title="Enter Fecha Delete" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="flatdatetimepicker" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['fecha_delete']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-isdeleted">
                                        <th class="title"> <?php print_lang('isdeleted'); ?>: </th>
                                        <td class="value">
                                            <span  data-value="<?php echo $data['isdeleted']; ?>" 
                                                data-pk="<?php echo $data['id_producto'] ?>" 
                                                data-url="<?php print_link("producto2/editfield/" . urlencode($data['id_producto'])); ?>" 
                                                data-name="isdeleted" 
                                                data-title="Enter Isdeleted" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" >
                                                <?php echo $data['isdeleted']; ?> 
                                            </span>
                                        </td>
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
                                                <a class="btn btn-sm btn-info"  href="<?php print_link("producto2/edit/$rec_id"); ?>">
                                                    <i class="fa fa-edit"></i> <?php print_lang('edit'); ?>
                                                </a>
                                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("producto2/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
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