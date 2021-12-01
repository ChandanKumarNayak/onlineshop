<?php include $_SERVER['DOCUMENT_ROOT']."/admin/top-side.php"; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo $page_title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo ADMIN_LANDING_PATH ?>">Home</a></li>
                        <li class="breadcrumb-item active"><?php echo $page_title; ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="card">
            <!-- <div class="card-header">
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div> -->
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="btn-group">
                        <button type="button" class="btn btn-info">Actions</button>
                        <button type="button" class="btn btn-info dropdown-toggle dropdown-hover dropdown-icon"
                            data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                            <a type="button" class="dropdown-item" data-toggle="modal" data-target="#modal-add-cat"><i
                                    class="fa fa-plus"></i>&nbsp;Add
                                Category</a>
                            <a class="dropdown-item btn-download"
                                href="<?php echo ADMIN_LANDING_PATH ?>prod-cat/product_cat_download?type=download_Prod_cat_pdf"><i
                                    class="fa fa-download"></i>&nbsp;Download PDF</a>
                        </div>
                    </div>
                    &nbsp;&nbsp;&nbsp;
                    <div class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search here..."
                            aria-label="Search" id="Search">
                    </div>
                </div>
                <hr>
                <div class="table-responsive" style="height:60vh">
                    <table class="table table-hover table-head-fixed" id="Data">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody id="prod_cat_load"></tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include $_SERVER['DOCUMENT_ROOT']."/admin/bottom.php"; ?>

<!-- Add category modal -->
<div class="modal fade" id="modal-add-cat">
    <div class="modal-dialog modal-lg">
        <form id="product_cat_form" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo $page_title; ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Category</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Image <span style="color: red;">*</span> </label>
                                        <input type="file" class="form-control-file" id="cat_img" name="cat_img"
                                            accept="image/*" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Name <span style="color: red;">*</span> </label>
                                        <input type="text" class="form-control" id="cat_name" placeholder="Example: Grocery"
                                            name="cat_name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Status <span style="color: red;">*</span> </label>
                                        <select class="form-control" name="cat_status">
                                            <option value="Active" selected>Active</option>
                                            <option value="Deactive">Deactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="success-msg"></div>
                    <div class="error-msg"></div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="product_cat_form_submit"
                        name="add_cat">Submit</button>
                    <input type="hidden" name="type" value="add_cat" />
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit cat modal -->
<div class="modal fade" id="modal-edit-cat">
    <div class="modal-dialog modal-lg">
        <form id="product_cat_form_edit" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo $page_title; ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Category</h3>
                        </div>
                        <div class="card-body" id="catDataFetch"></div>
                    </div>
                    <div class="success-msg"></div>
                    <div class="error-msg"></div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="product_cat_form_update"
                        name="update_cat">Submit</button>
                    <input type="hidden" name="type" value="update_cat" />
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Product Category Ajax & jQuery-->
<script>
$(document).ready(function() {

    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 7000
    });
    var error = 'Something went wrong.';
    var loading = '<img width="20" height="20" alt="loading" src="<?php echo USER_IMAGE_PATH ?>loading.gif">';

    //    load product tbl
    function loadProdCatTbl() {

        $.ajax({
            url: 'product_cat_tbl',
            type: 'POST',
            success: function(prodCat) {
                $('#prod_cat_load').html(prodCat);
            }
        });
    }
    loadProdCatTbl();

    // add product cat
    $('#product_cat_form').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: 'product_cat_add',
            type: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforesend: $('#product_cat_form_submit').attr('disabled', true).html(loading),
            success: function(addCat) {
                $('#product_cat_form_submit').attr('disabled', false).html('Submit');
                var data = $.parseJSON(addCat);
                if (data.status == 'exist-error') {
                    Toast.fire({
                        icon: 'error',
                        title: data.msg
                    })
                    $('#cat_name').css({
                        'border': '2px solid red'
                    });
                } else {
                    $('#cat_name').css('border', '');
                }
                if (data.status == 'empty-error') {
                    Toast.fire({
                        icon: 'error',
                        title: data.msg
                    })
                }
                if (data.status == 'xtn-error') {
                    $('#cat_img').css({
                        'border': '2px solid red'
                    });
                    Toast.fire({
                        icon: 'error',
                        title: data.msg
                    })
                } else {
                    $('#cat_img').css('border', '');
                }
                if (data.status == 'cat-success') {
                    $('#product_cat_form').trigger('reset');
                    $('#modal-add-cat,.modal-backdrop, .error-msg').hide();
                    Toast.fire({
                        icon: 'success',
                        title: data.msg
                    })
                    loadProdCatTbl();
                }
                if (data.status == 'failed-error') {
                    Toast.fire({
                        icon: 'error',
                        title: data.msg
                    })
                }
            }
        });

    });

    // Delete Product Cat
    $(document).on('click', '.btn-cat-dlt', function() {

        var cat_id = $(this).data('id');
        var type = $('.btn-cat-dlt').data('type');
        var element = this;
        Swal.fire({
            title: 'Are you sure?',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, remove it!'
        }).then((catDlt) => {
            if (catDlt.value) {
                $.ajax({
                    url: 'product_cat_dlt',
                    type: 'POST',
                    data: {
                        cat_id: cat_id,
                        type: type
                    },
                    success: function(dltCat) {
                        if (dltCat == 1) {
                            $(element).closest('tr').fadeOut(3000);
                            Toast.fire({
                                icon: 'success',
                                title: 'Deleted successfully.'
                            })
                            loadProdCatTbl();
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: error
                            })
                        }

                    }

                });
            }
        })

    });

    // Change prod cat status

    $(document).on('click', '.btn-cat-status', function() {
        var cat_id = $(this).data('id');
        var cat_status = $('.btn-cat-status').data('type');
        Swal.fire({
            title: 'Are you sure?',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, change it!'
        }).then(function(caty) {
            if (caty.value) {

                $.ajax({
                    url: 'product_cat_status',
                    type: 'POST',
                    data: {
                        id: cat_id,
                        type: cat_status
                    },
                    success: function(catStatus) {
                        if (catStatus == 1) {
                            loadProdCatTbl();
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: error
                            })
                        }
                    }

                });

            }
        })
    });

    // fetch product cat form data
    $(document).on('click', '.btn-cat-edit', function() {
        var cat_id = $(this).data('id');
        var type = $('.btn-cat-edit').data('type');
        $.ajax({
            url: 'product_cat_fetch',
            type: 'POST',
            data: {
                id: cat_id,
                type: type
            },
            success: function(editCat) {
                $('#catDataFetch').html(editCat);
            }

        });
    });

    // Product cat update
    $('#product_cat_form_edit').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: 'product_cat_update',
            type: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforesend: $('#product_cat_form_update').attr('disabled', true).html(loading),
            success: function(updateCat) {
                $('#product_cat_form_update').attr('disabled', false).html('Submit');
                var dataUpdate = $.parseJSON(updateCat);
                if (dataUpdate.status == 'cat-error') {
                    Toast.fire({
                        icon: 'error',
                        title: dataUpdate.msg
                    })
                    $('#catDataFetch #cat_name').css({
                        'border': '2px solid red'
                    });
                } else {
                    $('#catDataFetch #cat_name').css('border', '');
                }
                if (dataUpdate.status == 'empty-error') {
                    Toast.fire({
                        icon: 'error',
                        title: dataUpdate.msg
                    })
                }
                if (dataUpdate.status == 'xtn-error') {
                    $('#catDataFetch #cat_img').css({
                        'border': '2px solid red'
                    });
                    Toast.fire({
                        icon: 'error',
                        title: dataUpdate.msg
                    })
                } else {
                    $('#catDataFetch #cat_img').css('border', '');
                }
                if (dataUpdate.status == 'cat-success') {
                    $('#modal-edit-cat,.modal-backdrop, .error-msg').hide();
                    Toast.fire({
                        icon: 'success',
                        title: dataUpdate.msg
                    })
                    loadProdCatTbl();
                }
                if (dataUpdate.status == 'failed-error') {
                    Toast.fire({
                        icon: 'error',
                        title: dataUpdate.msg
                    })
                }
            }
        });

    });

    //Download PDF
    $('.btn-download').on('click', function(e) {
        e.preventDefault();
        var href = $(this).attr('href');
        Swal.fire({
            title: 'Are you sure?',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Download!'
        }).then(function(dwnld) {
            if (dwnld.value) {
                document.location.href = href;
            }
        })
    });

    // Filter search
    $('#Search').on('keyup', function(e) {
        var value = $(this).val();
        var spacesAndDashes = /\s|-/g;
        value = value.replace(spacesAndDashes, "");
        var patt = new RegExp(value, "i");
        var sw = 0;
        var counter = 0;
        $('#Data tbody').find('tr').each(function() {
            counter++;
            if (!($(this).find('td').text().replace(spacesAndDashes, "").search(patt) >= 0)) {
                $(this).not('#header').hide();
                sw++;
            } else if (($(this).find('td').text().replace(spacesAndDashes, "").search(patt) >=
                    0)) {
                $(this).show();
            }
        });
    });

    // ready end
});
</script>