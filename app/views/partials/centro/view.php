<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("centro/add");
$can_edit = ACL::is_allowed("centro/edit");
$can_view = ACL::is_allowed("centro/view");
$can_delete = ACL::is_allowed("centro/delete");
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
                    <h4 class="record-title"><?php print_lang('reporte_de_centro'); ?></h4>
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
                        $rec_id = (!empty($data['id_centro']) ? urlencode($data['id_centro']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-Tel_centro">
                                        <th class="title"> <?php print_lang('tel_centro'); ?>: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['Tel_centro']; ?>" 
                                                data-pk="<?php echo $data['id_centro'] ?>" 
                                                data-url="<?php print_link("centro/editfield/" . urlencode($data['id_bodega'])); ?>" 
                                                data-name="Tel_centro" 
                                                data-title="Ingrese Telefono" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['Tel_centro']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-id_centro">
                                        <th class="title"> <?php print_lang('id_centro'); ?>: </th>
                                        <td class="value"> <?php echo $data['id_centro']; ?></td>
                                    </tr>
                                    <tr  class="td-numero_centro">
                                        <th class="title"> <?php print_lang('numero_centro'); ?>: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['numero_centro']; ?>" 
                                                data-pk="<?php echo $data['id_centro'] ?>" 
                                                data-url="<?php print_link("centro/editfield/" . urlencode($data['id_bodega'])); ?>" 
                                                data-name="numero_centro" 
                                                data-title="Referencia" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['numero_centro']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-direccion_centro">
                                        <th class="title"> <?php print_lang('direccion_centro'); ?>: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['direccion_centro']; ?>" 
                                                data-pk="<?php echo $data['id_centro'] ?>" 
                                                data-url="<?php print_link("centro/editfield/" . urlencode($data['id_bodega'])); ?>" 
                                                data-name="direccion_centro" 
                                                data-title="Direccion de Centro Medico" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['direccion_centro']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-Nombre_centro">
                                        <th class="title"> <?php print_lang('nombre_centro'); ?>: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['Nombre_centro']; ?>" 
                                                data-pk="<?php echo $data['id_centro'] ?>" 
                                                data-url="<?php print_link("centro/editfield/" . urlencode($data['id_bodega'])); ?>" 
                                                data-name="Nombre_centro" 
                                                data-title="Ingrese Nombre" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['Nombre_centro']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-fecha_creacion">
                                        <th class="title"> <?php print_lang('fecha_creacion'); ?>: </th>
                                        <td class="value"> <?php echo $data['fecha_creacion']; ?></td>
                                    </tr>
                                    <tr  class="td-user_created">
                                        <th class="title"> <?php print_lang('user_created'); ?>: </th>
                                        <td class="value"> <?php echo $data['user_created']; ?></td>
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
                                                <a class="btn btn-sm btn-info"  href="<?php print_link("centro/edit/$rec_id"); ?>">
                                                    <i class="fa fa-edit"></i> <?php print_lang('edit'); ?>
                                                </a>
                                                <?php } ?>
                                                <?php if($can_delete){ ?>
                                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("centro/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
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
