<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("usuario/add");
$can_edit = ACL::is_allowed("usuario/edit");
$can_view = ACL::is_allowed("usuario/view");
$can_delete = ACL::is_allowed("usuario/delete");
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
                    <h4 class="record-title"><?php print_lang('reporte_usuario'); ?></h4>
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
                        $rec_id = (!empty($data['id_usuario']) ? urlencode($data['id_usuario']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-id_usuario">
                                        <th class="title"> <?php print_lang('id_usuario'); ?>: </th>
                                        <td class="value"> <?php echo $data['id_usuario']; ?></td>
                                    </tr>
                                    <tr  class="td-user_usuario">
                                        <th class="title"> <?php print_lang('user_usuario'); ?>: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['user_usuario']; ?>" 
                                                data-pk="<?php echo $data['id_usuario'] ?>" 
                                                data-url="<?php print_link("usuario/editfield/" . urlencode($data['id_usuario'])); ?>" 
                                                data-name="user_usuario" 
                                                data-title="Ingrese Su Usuario" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['user_usuario']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-nombre">
                                        <th class="title"> <?php print_lang('nombre'); ?>: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['nombre']; ?>" 
                                                data-pk="<?php echo $data['id_usuario'] ?>" 
                                                data-url="<?php print_link("usuario/editfield/" . urlencode($data['id_usuario'])); ?>" 
                                                data-name="nombre" 
                                                data-title="Primer Nombre" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['nombre']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-apellido">
                                        <th class="title"> <?php print_lang('apellido'); ?>: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['apellido']; ?>" 
                                                data-pk="<?php echo $data['id_usuario'] ?>" 
                                                data-url="<?php print_link("usuario/editfield/" . urlencode($data['id_usuario'])); ?>" 
                                                data-name="apellido" 
                                                data-title="Primer Apellido" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="text" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['apellido']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-correo">
                                        <th class="title"> <?php print_lang('correo'); ?>: </th>
                                        <td class="value"> <?php echo $data['correo']; ?></td>
                                    </tr>
                                    <tr  class="td-fecha_creacion_usuario">
                                        <th class="title"> <?php print_lang('fecha_creacion_usuario'); ?>: </th>
                                        <td class="value"> <?php echo $data['fecha_creacion_usuario']; ?></td>
                                    </tr>
                                    <tr  class="td-numero_empleado">
                                        <th class="title"> <?php print_lang('numero_empleado'); ?>: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-value="<?php echo $data['numero_empleado']; ?>" 
                                                data-pk="<?php echo $data['id_usuario'] ?>" 
                                                data-url="<?php print_link("usuario/editfield/" . urlencode($data['id_usuario'])); ?>" 
                                                data-name="numero_empleado" 
                                                data-title=" Empleado" 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="number" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['numero_empleado']; ?> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr  class="td-rol">
                                        <th class="title"> <?php print_lang('rol'); ?>: </th>
                                        <td class="value">
                                            <span <?php if($can_edit){ ?> data-source='<?php echo json_encode_quote(Menu :: $rol); ?>' 
                                                data-value="<?php echo $data['rol']; ?>" 
                                                data-pk="<?php echo $data['id_usuario'] ?>" 
                                                data-url="<?php print_link("usuario/editfield/" . urlencode($data['id_usuario'])); ?>" 
                                                data-name="rol" 
                                                data-title="Select a value ..." 
                                                data-placement="left" 
                                                data-toggle="click" 
                                                data-type="select" 
                                                data-mode="popover" 
                                                data-showbuttons="left" 
                                                class="is-editable" <?php } ?>>
                                                <?php echo $data['rol']; ?> 
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
                                                <?php if($can_edit){ ?>
                                                <a class="btn btn-sm btn-info"  href="<?php print_link("usuario/edit/$rec_id"); ?>">
                                                    <i class="fa fa-edit"></i> <?php print_lang('edit'); ?>
                                                </a>
                                                <?php } ?>
                                                <?php if($can_delete){ ?>
                                                <a class="btn btn-sm btn-danger record-delete-btn mx-1"  href="<?php print_link("usuario/delete/$rec_id/?csrf_token=$csrf_token&redirect=$current_page"); ?>" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal">
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
