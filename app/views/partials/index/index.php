        <?php 
        $page_id = null;
        $comp_model = new SharedController;
        ?>
        <div  class=" py-5">
            <div class="container">
                <div class="row ">
                    <div class="col-md-8 comp-grid">
                        <div class="">
                            <div class="fadeIn animated mb-4">
                                <div class="text-capitalize">
                                    <h2 class="text-capitalize">Sistema de Inventario</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 comp-grid">
                        <?php $this :: display_page_errors(); ?>
                        
                        <div  class="bg-light p-3 animated fadeIn page-content">
                            <div>
                                <h4><i class="fa fa-key"></i> <?php print_lang('user_login'); ?></h4>
                                <hr />
                                <?php 
                                $this :: display_page_errors(); 
                                ?>
                                <form name="loginForm" action="<?php print_link('index/login/?csrf_token=' . Csrf::$token); ?>" class="needs-validation form page-form" method="post">
                                    <div class="input-group form-group">
                                        <input placeholder="<?php print_lang('username'); ?>" name="username"  required="required" class="form-control" type="text"  />
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="form-control-feedback fa fa-user"></i></span>
                                            </div>
                                        </div>
                                        <div class="input-group form-group">
                                            <input  placeholder="<?php print_lang('password'); ?>" required="required" v-model="user.password" name="password" class="form-control " type="password" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><i class="form-control-feedback fa fa-key"></i></span>
                                                </div>
                                            </div>
                                            <div class="row clearfix mt-3 mb-3">
                                                <div class="col-6">
                                                    <label class="">
                                                        <input value="true" type="checkbox" name="rememberme" />
                                                        <?php print_lang('remember_me'); ?>
                                                    </label>
                                                </div>
                                                <div class="col-6">
                                                    <a href="<?php print_link('passwordmanager') ?>" class="text-danger"> <?php print_lang('reset_password_'); ?></a>
                                                </div>
                                            </div>
                                            <div class="form-group text-center">
                                                <button class="btn btn-primary btn-block btn-md" type="submit"> 
                                                    <i class="load-indicator">
                                                        <clip-loader :loading="loading" color="#fff" size="20px"></clip-loader> 
                                                    </i>
                                                    <?php print_lang('login'); ?> <i class="fa fa-key"></i>
                                                </button>
                                            </div>
                                            <hr />
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 comp-grid">
                                <a  class="btn btn-primary" href="<?php print_link("index") ?>">
                                    <?php print_lang('button'); ?> 
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                