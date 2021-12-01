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
                            <a type="button" class="dropdown-item" data-toggle="modal" data-target="#modal-add-brand"><i
                                    class="fa fa-plus"></i>&nbsp;Add Brand</a>
                            <a class="dropdown-item btn-download"
                                href="<?php echo ADMIN_LANDING_PATH ?>brand/brand_download?type=download_brand_pdf"><i
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
                                <th>Logo</th>
                                <th>Name</th>
                                <th>Exporter Of</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody id="brand_load"></tbody>
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

<!-- Add brand modal -->
<div class="modal fade" id="modal-add-brand">
    <div class="modal-dialog modal-lg">
        <form id="brand_form" enctype="multipart/form-data">
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
                            <h3 class="card-title">Add Brand</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Logo <span style="color: red;">*</span> </label>
                                        <input type="file" class="form-control-file" id="brand_logo" name="brand_logo"
                                            accept="image/*" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Name <span style="color: red;">*</span> </label>
                                        <input type="text" class="form-control" id="brand_name"
                                            placeholder="Example: TATA Pvt. Ltd." name="brand_name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Exporter Of <span style="color: red;">*</span> </label>
                                        <select class="form-control chosen-select" name="brand_exporter_of[]"
                                            data-placeholder="Select category..." id="select_exp_of" multiple>
                                            <?php 
                                $sql_show_cat = "SELECT * FROM product_cat ORDER BY cat_name ASC";
                                $query_show_cat = mysqli_query($db,$sql_show_cat);  
                                if(mysqli_num_rows($query_show_cat) > 0)
                                while($row = mysqli_fetch_assoc($query_show_cat)) { ?>
                                            <option value="<?php echo get_safe_value($row['cat_id']) ?>">
                                                <?php echo get_safe_value($row['cat_name']) ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Status <span style="color: red;">*</span> </label>
                                        <select class="form-control" name="brand_status">
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
                    <button type="submit" class="btn btn-primary" id="brand_form_submit"
                        name="add_brand">Submit</button>
                    <input type="hidden" name="type" value="add_brand" />
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit brand modal -->
<div class="modal fade" id="modal-edit-brand">
    <div class="modal-dialog modal-lg">
        <form id="brand_form_edit" enctype="multipart/form-data">
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
                            <h3 class="card-title">Edit Brand</h3>
                        </div>
                        <div class="card-body" id="brandDataFetch"></div>
                    </div>
                    <div class="success-msg"></div>
                    <div class="error-msg"></div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="brand_form_update"
                        name="update_brand">Submit</button>
                    <input type="hidden" name="type" value="update_brand" />
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Product Brand Ajax & jQuery-->
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

    //    load brand tbl
    function loadBrandTbl() {

        $.ajax({
            url: 'brand_tbl',
            type: 'POST',
            success: function(brandShow) {
                $('#brand_load').html(brandShow);
            }
        });
    }
    loadBrandTbl();

    // add brand
    $('#brand_form').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: 'brand_add',
            type: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforesend: $('#brand_form_submit').attr('disabled', true).html(loading),
            success: function(addBrand) {
                $('#brand_form_submit').attr('disabled', false).html('Submit');
                var data = $.parseJSON(addBrand);
                if (data.status == 'exist-error') {
                    Toast.fire({
                        icon: 'error',
                        title: data.msg
                    })
                    $('#brand_name').css({
                        'border': '2px solid red'
                    });
                } else {
                    $('#brand_name').css('border', '');
                }
                if (data.status == 'empty-error') {
                    Toast.fire({
                        icon: 'error',
                        title: data.msg
                    })
                }
                if (data.status == 'xtn-error') {
                    $('#brand_logo').css({
                        'border': '2px solid red'
                    });
                    Toast.fire({
                        icon: 'error',
                        title: data.msg
                    })
                } else {
                    $('#brand_logo').css('border', '');
                }
                if (data.status == 'brand-success') {
                    $('#brand_form').trigger('reset');
                    $('#modal-add-brand,.modal-backdrop, .error-msg').hide();
                    Toast.fire({
                        icon: 'success',
                        title: data.msg
                    })
                    loadBrandTbl();
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

    // Delete Brand
    $(document).on('click', '.btn-brand-dlt', function() {

        var brand_id = $(this).data('id');
        var type = $('.btn-brand-dlt').data('type');
        var element = this;
        Swal.fire({
            title: 'Are you sure?',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, remove it!'
        }).then((brandDlt) => {
            if (brandDlt.value) {
                $.ajax({
                    url: 'brand_dlt',
                    type: 'POST',
                    data: {
                        brand_id: brand_id,
                        type: type
                    },
                    success: function(dltBrand) {
                        if (dltBrand == 1) {
                            $(element).closest('tr').fadeOut(3000);
                            Toast.fire({
                                icon: 'success',
                                title: 'Deleted successfully.'
                            })
                            loadBrandTbl();
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

    // Change brand status

    $(document).on('click', '.btn-brand-status', function() {
        var brand_id = $(this).data('id');
        var brand_status = $('.btn-brand-status').data('type');
        Swal.fire({
            title: 'Are you sure?',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, change it!'
        }).then(function(brandy) {
            if (brandy.value) {

                $.ajax({
                    url: 'brand_status',
                    type: 'POST',
                    data: {
                        id: brand_id,
                        type: brand_status
                    },
                    success: function(brandStatus) {
                        if (brandStatus == 1) {
                            loadBrandTbl();
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

    // fetch brand form data
    $(document).on('click', '.btn-brand-edit', function() {
        var brand_id = $(this).data('id');
        var type = $('.btn-brand-edit').data('type');
        $.ajax({
            url: 'brand_fetch',
            type: 'POST',
            data: {
                id: brand_id,
                type: type
            },
            success: function(editBrand) {
                $('#brandDataFetch').html(editBrand);
            }

        });
    });

    // Product brand update
    $('#brand_form_edit').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: 'brand_update',
            type: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforesend: $('#brand_form_update').attr('disabled', true).html(loading),
            success: function(updateBrand) {
                $('#brand_form_update').attr('disabled', false).html('Submit');
                var dataUpdate = $.parseJSON(updateBrand);
                if (dataUpdate.status == 'brand-error') {
                    Toast.fire({
                        icon: 'error',
                        title: dataUpdate.msg
                    })
                    $('#brandDataFetch #brand_name').css({
                        'border': '2px solid red'
                    });
                } else {
                    $('#brandDataFetch #brand_name').css('border', '');
                }
                if (dataUpdate.status == 'empty-error') {
                    Toast.fire({
                        icon: 'error',
                        title: dataUpdate.msg
                    })
                }
                if (dataUpdate.status == 'xtn-error') {
                    $('#brandDataFetch #brand_logo').css({
                        'border': '2px solid red'
                    });
                    Toast.fire({
                        icon: 'error',
                        title: dataUpdate.msg
                    })
                } else {
                    $('#brandDataFetch #brand_logo').css('border', '');
                }
                if (dataUpdate.status == 'brand-success') {
                    $('#modal-edit-brand,.modal-backdrop, .error-msg').hide();
                    Toast.fire({
                        icon: 'success',
                        title: dataUpdate.msg
                    })
                    loadBrandTbl();
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

<script>
$('#select_exp_of').chosen({
    width: "100%",
    no_results_text: "Oops, nothing found!"
});
</script>