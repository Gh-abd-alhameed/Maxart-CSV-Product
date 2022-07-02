<!-- <script async defer crossorigin="anonymous" src="<?= plugin_dir_url(__FILE__) . 'assets/js/ff.js' ?>"></script> -->
<section class="section-maxart-api-csv">
    <div class="container ">
        <h1>Maxart CSV Product</h1>
        <div class="row py-5">
            <div class="col-12">
                <form action="<?php echo  get_bloginfo('url') . '/wp-admin/maxart-api/v1/product' ?>" method="post">
                    <div class="row">
                        <h3>choose Type:</h3>
                        <div class="col-6 pb-2">
                            <select class="form-select py-1" aria-label="Default select example" name="posttype" id="">
                                <?php if (class_exists('WooCommerce')) :  ?>
                                    <option value="product">product</option>
                                <?php endif;  ?>
                            </select>
                        </div>
                        <div class="col-6 d-flex justify-content-end pb-2">
                            <div class="d-flex flex-column">
                                <input type="text" name="namefile" onkeyup="validateInput()" placeholder="Name File" class="form-control w-100" value="">
                                <small style="color:red;min-height:21px;"></small>
                            </div>
                            <button class="btn btn-outline-dark btn-submit-form"> download </button>
                        </div>
                        <style>
                            .col-form {
                                position: relative;
                                /* border-radius: 15px; */
                                background-color: white !important;
                                border-top: 1px solid black;
                            }

                            .div-btn-add {
                                position: absolute;
                                top: 5px;
                                /* padding: 0 10px; */
                            }

                            .btn-add {
                                /* font-size: 21px; */
                                /* display: flex;
                                justify-content: center;
                                align-items: center; */
                                cursor: pointer;
                                padding: 9px 15px !important;
                                font-size: 12px !important;
                                justify-content: center;
                                align-items: center;
                                display: flex;
                                line-height: 1;
                            }

                            .div-input-form {
                                justify-content: flex-start;
                                align-items: center;
                                flex-wrap: wrap;
                            }
                        </style>
                        <div class="col-12 d-flex flex-column justify-content-center col-form py-5">
                            <div class="d-flex w-100 justify-content-center py-2 gap-4 div-btn-add">
                                <a class="btn-add btn  btn-outline-dark" onclick="onClickAdd_SKU()">SKU</a>
                                <a class="btn-add btn  btn-outline-dark" onclick="onClickAdd_regular_price()">Regular Price</a>
                                <a class="btn-add btn  btn-outline-dark" onclick="onClickAdd_sale_price()">Sale Price</a>
                                <a class="btn-add btn  btn-outline-dark" onclick="onClickAdd_stock_status()">Stock Status</a>
                                <a class="btn-add btn  btn-outline-dark" onclick="onClickAdd_sale_price_dates_to()">Sale Price Dates To</a>
                                <a class="btn-add btn  btn-outline-dark" onclick="onClickAdd_sale_price_dates_from()">Sale Price Dates From</a>
                            </div>

                            <div class=" d-flex flex-column justify-content-center div-input-form">
                                <!-- <input type="text" name="value_choose[]" hidden> -->
                                <div id="add-field-new" class="d-flex row py-3 div-input-form">
                                    <div class="d-flex pt-2 col-4 align-content-start align-items-start">
                                        <div class="d-flex flex-column w-100">
                                            <input type="text" onkeyup="validateInput()" placeholder="title" class="form-control" name="title_id" value="ID">
                                            <small style="color:red;min-height:21px;"></small>
                                        </div>
                                        <span class="input-group-text">ID</span>
                                        <select name="ID" id="" hidden>
                                            <option selected value="ID">ID</option>
                                        </select>
                                    </div>
                                    <div class="d-flex pt-2 col-4 align-content-start align-items-start">
                                        <div class="d-flex flex-column w-100">
                                            <input type="text" placeholder="" onkeyup="validateInput()" class="form-control" name="title_name" value="Title">
                                            <small style="color:red;min-height:21px;"></small>
                                        </div>
                                        <span class="input-group-text">product name</span>
                                        <select name="post_title" hidden id="">
                                            <option selected value="post_title">product name</option>
                                        </select>
                                    </div>
                                    <div class="d-flex pt-2 col-4 align-content-start align-items-start">
                                        <div class="d-flex flex-column w-100">
                                            <input type="text" placeholder="title" onkeyup="validateInput()" class="form-control" name="title_description" value="Description">
                                            <small style="color:red;min-height:21px;"></small>
                                        </div>
                                        <span class="input-group-text">Description</span>
                                        <select name="post_content" id="" hidden>
                                            <option selected value="post_content">Description</option>
                                        </select>
                                    </div>
                                    <div class="d-flex align-content-start align-items-start pt-2 col-4">
                                        <div class="d-flex flex-column w-100">
                                            <input type="text" placeholder="title" onkeyup="validateInput()" class="form-control" name="title_image" value="Image">
                                            <small style="color:red;min-height:21px;"></small>
                                        </div>
                                        <span class="input-group-text">Image</span>
                                        <select name="post_thumbnail" hidden id="">
                                            <option selected value="post_thumbnail">Image</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="py-2">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>