<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AlunoDisciplina */

$this->title = 'Create Aluno Disciplina';
$this->params['breadcrumbs'][] = ['label' => 'Aluno Disciplina', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aluno-disciplina-batch">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="widget-content searchable-container list">
        <div class="card card-body">
            <div class="row">
                <div class="col-md-4 col-xl-2">
                    <form data-dashlane-rid="2baf04ac79f6780b" data-form-type="">
                        <input type="text" class="form-control product-search" id="input-search" placeholder="Search Contacts..." data-dashlane-rid="f5cead2e3baf4922" data-form-type="">
                    </form>
                </div>
                <div class="
                    col-md-8 col-xl-10
                    text-end
                    d-flex
                    justify-content-md-end justify-content-center
                    mt-3 mt-md-0
                  ">
                    <div class="action-btn show-btn" style="display: none">
                        <a href="javascript:void(0)" class="
                        delete-multiple
                        btn-light-danger btn
                        me-2
                        text-danger
                        d-flex
                        align-items-center
                        font-weight-medium
                      ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 feather-sm fill-white me-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                            Delete All Row</a>
                    </div>
                    <a href="javascript:void(0)" id="btn-add-contact" class="btn btn-info">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users feather-sm fill-white me-1"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        Add Contact</a>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addContactModal" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center">
                        <h5 class="modal-title">Contact</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="add-contact-box">
                            <div class="add-contact-content">
                                <form id="addContactModalTitle">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3 contact-name">
                                                <input type="text" id="c-name" class="form-control" placeholder="Name">
                                                <span class="validation-text text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3 contact-email">
                                                <input type="text" id="c-email" class="form-control" placeholder="Email">
                                                <span class="validation-text text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3 contact-occupation">
                                                <input type="text" id="c-occupation" class="form-control" placeholder="Occupation">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3 contact-phone">
                                                <input type="text" id="c-phone" class="form-control" placeholder="Phone">
                                                <span class="validation-text text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3 contact-location">
                                                <input type="text" id="c-location" class="form-control" placeholder="Location">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btn-add" class="btn btn-success rounded-pill px-4">
                            Add
                        </button>
                        <button id="btn-edit" class="btn btn-success rounded-pill px-4">
                            Save
                        </button>
                        <button class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal">
                            Discard
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-body">
            <div class="table-responsive">
                <table class="table search-table v-middle">
                    <thead class="header-item">
                    <tr><th>
                            <div class="n-chk align-self-center text-center">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input secondary" id="contact-check-all">
                                    <label class="form-check-label" for="contact-check-all"></label>
                                    <span class="new-control-indicator"></span>
                                </div>
                            </div>
                        </th>
                        <th class="font-weight-medium fs-4">Name</th>
                        <th class="font-weight-medium fs-4">Email</th>
                        <th class="font-weight-medium fs-4">Location</th>
                        <th class="font-weight-medium fs-4">Phone</th>
                        <th class="font-weight-medium fs-4">Action</th>
                    </tr></thead>
                    <tbody>
                    <!-- row -->
                    <tr class="search-items">
                        <td>
                            <div class="n-chk align-self-center text-center">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input contact-chkbox primary" id="checkbox1">
                                    <label class="form-check-label" for="checkbox1"></label>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                          <span class="
                              round
                              rounded-circle
                              text-white
                              d-inline-block
                              text-center
                              bg-info
                            ">EA</span>
                                <div class="ms-3">
                                    <div class="user-meta-info">
                                        <h5 class="user-name mb-0" data-name="Emma Adams">
                                            Emma Adams
                                        </h5>
                                        <small class="user-work text-muted" data-occupation="Web Developer">Web Developer</small>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="usr-email-addr font-weight-medium" data-email="adams@mail.com">adams@mail.com</span>
                        </td>
                        <td>
                            <span class="usr-location font-weight-medium" data-location="Boston, USA">Boston, USA</span>
                        </td>
                        <td>
                            <span class="usr-ph-no font-weight-medium" data-phone="+1 (070) 123-4567">+91 (070) 123-4567</span>
                        </td>
                        <td>
                            <div class="action-btn">
                                <a href="javascript:void(0)" class="text-info edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye feather-sm fill-white"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a>
                                <a href="javascript:void(0)" class="text-dark delete ms-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 feather-sm fill-white"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a>
                            </div>
                        </td>
                    </tr>
                    <!-- /.row -->
                    <!-- row -->
                    <tr class="search-items">
                        <td>
                            <div class="n-chk align-self-center text-center">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input contact-chkbox primary" id="checkbox2">
                                    <label class="form-check-label" for="checkbox2"></label>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="../../assets/images/users/2.jpg" class="rounded-circle" alt="user" width="50">
                                <div class="ms-3">
                                    <div class="user-meta-info">
                                        <h5 class="user-name mb-0" data-name="Olivia Allen">
                                            Olivia Allen
                                        </h5>
                                        <small class="user-work text-muted" data-occupation="Web Designer">Web Designer</small>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="usr-email-addr font-weight-medium" data-email="allen@mail.com">allen@mail.com</span>
                        </td>
                        <td>
                            <span class="usr-location font-weight-medium" data-location="Sydney, Australia">Sydney, Australia</span>
                        </td>
                        <td>
                            <span class="usr-ph-no font-weight-medium" data-phone="+91 (125) 450-1500">+91 (125) 450-1500</span>
                        </td>
                        <td>
                            <div class="action-btn">
                                <a href="javascript:void(0)" class="text-info edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye feather-sm fill-white"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </a>
                                <a href="javascript:void(0)" class="text-dark delete ms-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 feather-sm fill-white"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <!-- /.row -->
                    <!-- row -->
                    <tr class="search-items">
                        <td>
                            <div class="n-chk align-self-center text-center">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input contact-chkbox primary" id="checkbox3">
                                    <label class="form-check-label" for="checkbox3"></label>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                          <span class="
                              round
                              rounded-circle
                              text-white
                              d-inline-block
                              text-center
                              bg-success
                            ">IA</span>
                                <div class="ms-3">
                                    <div class="user-meta-info">
                                        <h5 class="user-name mb-0" data-name="Isabella Anderson">
                                            Isabella Anderson
                                        </h5>
                                        <small class="user-work text-muted" data-occupation="UX/UI Designer">UX/UI Designer</small>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="usr-email-addr font-weight-medium" data-email="anderson@mail.com">anderson@mail.com</span>
                        </td>
                        <td>
                            <span class="usr-location font-weight-medium" data-location="Miami, USA">Miami, USA</span>
                        </td>
                        <td>
                            <span class="usr-ph-no font-weight-medium" data-phone="+91 (100) 154-1254">+91 (100) 154-1254</span>
                        </td>
                        <td>
                            <div class="action-btn">
                                <a href="javascript:void(0)" class="text-info edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye feather-sm fill-white"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a>
                                <a href="javascript:void(0)" class="text-dark delete ms-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 feather-sm fill-white"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a>
                            </div>
                        </td>
                    </tr>
                    <!-- /.row -->
                    <!-- row -->
                    <tr class="search-items">
                        <td>
                            <div class="n-chk align-self-center text-center">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input contact-chkbox primary" id="checkbox4">
                                    <label class="form-check-label" for="checkbox4"></label>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="../../assets/images/users/4.jpg" alt="avatar" class="rounded-circle" width="50">
                                <div class="ms-3">
                                    <div class="user-meta-info">
                                        <h5 class="user-name mb-0" data-name="Amelia Armstrong">
                                            Amelia Armstrong
                                        </h5>
                                        <small class="user-work text-muted" data-occupation="Ethical Hacker">Ethical Hacker</small>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="usr-email-addr font-weight-medium" data-email="armstrong@mail.com">armstrong@mail.com</span>
                        </td>
                        <td>
                            <span class="usr-location font-weight-medium" data-location="Tokyo, Japan">Tokyo, Japan</span>
                        </td>
                        <td>
                            <span class="usr-ph-no font-weight-medium" data-phone="+91 (154) 199- 1540">+91 (154) 199- 1540</span>
                        </td>
                        <td>
                            <div class="action-btn">
                                <a href="javascript:void(0)" class="text-info edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye feather-sm fill-white"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a>
                                <a href="javascript:void(0)" class="text-dark delete ms-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 feather-sm fill-white"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a>
                            </div>
                        </td>
                    </tr>
                    <!-- /.row -->
                    <!-- row -->
                    <tr class="search-items">
                        <td>
                            <div class="n-chk align-self-center text-center">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input contact-chkbox primary" id="checkbox5">
                                    <label class="form-check-label" for="checkbox5"></label>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="../../assets/images/users/5.jpg" alt="avatar" class="rounded-circle" width="50">
                                <div class="ms-3">
                                    <div class="user-meta-info">
                                        <h5 class="user-name mb-0" data-name="Emily Atkinson">
                                            Emily Atkinson
                                        </h5>
                                        <small class="user-work text-muted" data-occupation="Web developer">Web developer</small>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="usr-email-addr font-weight-medium" data-email="atkinson@mail.com">atkinson@mail.com</span>
                        </td>
                        <td>
                            <span class="usr-location font-weight-medium" data-location="Edinburgh, UK">Edinburgh, UK</span>
                        </td>
                        <td>
                            <span class="usr-ph-no font-weight-medium" data-phone="+91 (900) 150- 1500">+91 (900) 150- 1500</span>
                        </td>
                        <td>
                            <div class="action-btn">
                                <a href="javascript:void(0)" class="text-info edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye feather-sm fill-white"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a>
                                <a href="javascript:void(0)" class="text-dark delete ms-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 feather-sm fill-white"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a>
                            </div>
                        </td>
                    </tr>
                    <!-- /.row -->
                    <!-- row -->
                    <tr class="search-items">
                        <td>
                            <div class="n-chk align-self-center text-center">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input contact-chkbox primary" id="checkbox6">
                                    <label class="form-check-label" for="checkbox6"></label>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                          <span class="
                              round
                              rounded-circle
                              text-white
                              d-inline-block
                              text-center
                              bg-info
                            ">SB</span>
                                <div class="ms-3">
                                    <div class="user-meta-info">
                                        <h5 class="user-name mb-0" data-name="Sofia Bailey">
                                            Sofia Bailey
                                        </h5>
                                        <small class="user-work text-muted" data-occupation="UX/UI Designer">UX/UI Designer</small>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="usr-email-addr font-weight-medium" data-email="bailey@mail.com">bailey@mail.com</span>
                        </td>
                        <td>
                            <span class="usr-location font-weight-medium" data-location="New York, USA">New York, USA</span>
                        </td>
                        <td>
                            <span class="usr-ph-no font-weight-medium" data-phone="+91 (001) 160- 1845">+91 (001) 160- 1845</span>
                        </td>
                        <td>
                            <div class="action-btn">
                                <a href="javascript:void(0)" class="text-info edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye feather-sm fill-white"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a>
                                <a href="javascript:void(0)" class="text-dark delete ms-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 feather-sm fill-white"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a>
                            </div>
                        </td>
                    </tr>
                    <!-- /.row -->
                    <!-- row -->
                    <tr class="search-items">
                        <td>
                            <div class="n-chk align-self-center text-center">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input contact-chkbox primary" id="checkbox7">
                                    <label class="form-check-label" for="checkbox7"></label>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="../../assets/images/users/7.jpg" alt="avatar" class="rounded-circle" width="50">
                                <div class="ms-3">
                                    <div class="user-meta-info">
                                        <h5 class="user-name mb-0" data-name="Victoria Sharma">
                                            Victoria Sharma
                                        </h5>
                                        <small class="user-work text-muted" data-occupation="Project Manager">Project Manager"</small>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="usr-email-addr font-weight-medium" data-email="sharma@mail.com">sharma@mail.com</span>
                        </td>
                        <td>
                            <span class="usr-location font-weight-medium" data-location="Miami, USA">Miami, USA</span>
                        </td>
                        <td>
                            <span class="usr-ph-no font-weight-medium" data-phone="+91 (110) 180- 1600">+91 (110) 180- 1600</span>
                        </td>
                        <td>
                            <div class="action-btn">
                                <a href="javascript:void(0)" class="text-info edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye feather-sm fill-white"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a>
                                <a href="javascript:void(0)" class="text-dark delete ms-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 feather-sm fill-white"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a>
                            </div>
                        </td>
                    </tr>
                    <!-- /.row -->
                    <!-- row -->
                    <tr class="search-items">
                        <td>
                            <div class="n-chk align-self-center text-center">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input contact-chkbox primary" id="checkbox8">
                                    <label class="form-check-label" for="checkbox8"></label>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                          <span class="
                              round
                              rounded-circle
                              text-white
                              d-inline-block
                              text-center
                              bg-danger
                            ">PB</span>
                                <div class="ms-3">
                                    <div class="user-meta-info">
                                        <h5 class="user-name mb-0" data-name="Penelope Baker">
                                            Penelope Baker
                                        </h5>
                                        <small class="user-work text-muted" data-occupation="Web Developer">Web Developer"</small>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="usr-email-addr font-weight-medium" data-email="baker@mail.com">baker@mail.com</span>
                        </td>
                        <td>
                            <span class="usr-location font-weight-medium" data-location="Edinburgh, UK">Edinburgh, UK</span>
                        </td>
                        <td>
                            <span class="usr-ph-no font-weight-medium" data-phone="+91 (405) 483- 4512">+91 (405) 483- 4512</span>
                        </td>
                        <td>
                            <div class="action-btn">
                                <a href="javascript:void(0)" class="text-info edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye feather-sm fill-white"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a>
                                <a href="javascript:void(0)" class="text-dark delete ms-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 feather-sm fill-white"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a>
                            </div>
                        </td>
                    </tr>
                    <!-- /.row -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
