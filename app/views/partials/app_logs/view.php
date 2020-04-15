<?php 
//check if current user role is allowed access to the pages
$can_add = ACL::is_allowed("app_logs/add");
$can_edit = ACL::is_allowed("app_logs/edit");
$can_view = ACL::is_allowed("app_logs/view");
$can_delete = ACL::is_allowed("app_logs/delete");
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
                    <h4 class="record-title"><?php print_lang('view_app_logs'); ?></h4>
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
                        $rec_id = (!empty($data['log_id']) ? urlencode($data['log_id']) : null);
                        $counter++;
                        ?>
                        <div id="page-report-body" class="">
                            <table class="table table-hover table-borderless table-striped">
                                <!-- Table Body Start -->
                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                    <tr  class="td-log_id">
                                        <th class="title"> <?php print_lang('log_id'); ?>: </th>
                                        <td class="value"> <?php echo $data['log_id']; ?></td>
                                    </tr>
                                    <tr  class="td-Timestamp">
                                        <th class="title"> <?php print_lang('timestamp'); ?>: </th>
                                        <td class="value"> <?php echo $data['Timestamp']; ?></td>
                                    </tr>
                                    <tr  class="td-Action">
                                        <th class="title"> <?php print_lang('action'); ?>: </th>
                                        <td class="value"> <?php echo $data['Action']; ?></td>
                                    </tr>
                                    <tr  class="td-TableName">
                                        <th class="title"> <?php print_lang('tablename'); ?>: </th>
                                        <td class="value"> <?php echo $data['TableName']; ?></td>
                                    </tr>
                                    <tr  class="td-RecordID">
                                        <th class="title"> <?php print_lang('recordid'); ?>: </th>
                                        <td class="value"> <?php echo $data['RecordID']; ?></td>
                                    </tr>
                                    <tr  class="td-SqlQuery">
                                        <th class="title"> <?php print_lang('sqlquery'); ?>: </th>
                                        <td class="value"> <?php echo $data['SqlQuery']; ?></td>
                                    </tr>
                                    <tr  class="td-UserID">
                                        <th class="title"> <?php print_lang('userid'); ?>: </th>
                                        <td class="value"> <?php echo $data['UserID']; ?></td>
                                    </tr>
                                    <tr  class="td-ServerIP">
                                        <th class="title"> <?php print_lang('serverip'); ?>: </th>
                                        <td class="value"> <?php echo $data['ServerIP']; ?></td>
                                    </tr>
                                    <tr  class="td-RequestUrl">
                                        <th class="title"> <?php print_lang('requesturl'); ?>: </th>
                                        <td class="value"> <?php echo $data['RequestUrl']; ?></td>
                                    </tr>
                                    <tr  class="td-RequestData">
                                        <th class="title"> <?php print_lang('requestdata'); ?>: </th>
                                        <td class="value"> <?php echo $data['RequestData']; ?></td>
                                    </tr>
                                    <tr  class="td-RequestCompleted">
                                        <th class="title"> <?php print_lang('requestcompleted'); ?>: </th>
                                        <td class="value"> <?php echo $data['RequestCompleted']; ?></td>
                                    </tr>
                                    <tr  class="td-RequestMsg">
                                        <th class="title"> <?php print_lang('requestmsg'); ?>: </th>
                                        <td class="value"> <?php echo $data['RequestMsg']; ?></td>
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
