    <?php
    $comp_model = new SharedController;
    $view_data = $this->view_data; //array of all  data passed from controller
    $field_name = $view_data['field_name'];
    $field_value = $view_data['field_value'];
    $form_data = $this->form_data; //request pass to the page as form fields values
    $page_id = random_str(6);
    ?>
    <div class="master-detail-page">
        <div class="card-header p-0 pt-2 px-2">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a data-toggle="tab" href="#producto_proveedor_View_<?php echo $page_id ?>" class="nav-link active">
                        View
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="tab" href="#producto_proveedor_Add_<?php echo $page_id ?>" class="nav-link ">
                        Add
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade show active show" id="producto_proveedor_View_<?php echo $page_id ?>" role="tabpanel">
                <?php $this->render_page("proveedor/view/$field_value"); ?>
            </div>
            <div class="tab-pane fade show " id="producto_proveedor_Add_<?php echo $page_id ?>" role="tabpanel">
                <?php $this->render_page("proveedor/add/?id_proveedor=$field_value", array('id_proveedor' => get_value('id_proveedor'))); ?>
            </div>
        </div>
    </div>
    