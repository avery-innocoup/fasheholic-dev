<?php include 'includes/header.php' ?>
        <div class="xs-hidden sm-hidden col-md-2">
            
        </div>
        <div class="main-body col-md-8 col-sm-12 col-xs-12">
            <div class="col-xs-12 add-product-area" style="cursor: pointer">
                <div class="col-xs-12 plus-sign">+</div>
                <div class="add-product">ADD PRODUCT</div>
            </div>
            <div class="col-xs-12 add-display-container" style="display: none">
                <div class="col-sm-3 col-xs-12 plus-container">
                    <div class=" round-circle-plus">
                        <div class="col-xs-12">
                            +
                        </div>
                        
                    </div>
                    <div class="col-xs-12 round-circle-plus-text">
                            ADD DISPLAY
                        </div>
                </div>
                <div class="col-sm-9 col-xs-12">
                    <div class="col-xs-12 each-prop">
                        <label class="col-sm-4 col-xs-12">
                            Product Name
                        </label>
                        <input type="text" class="form-control1 col-sm-8 col-xs-12" placeholder="required*" />
                    </div>
                    <div class="col-xs-12 each-prop">
                        <label class="col-sm-4 col-xs-12">
                            Product Category
                        </label>
                        <select class="form-control1 col-sm-8 col-xs-12" >
                            <option value="">--select---</option>
                        </select>
                    </div>
                    <div class="col-xs-12 each-prop">
                        <label class="col-sm-4 col-xs-12">
                            Local Price
                        </label>
                        <div class="col-sm-8 col-xs-12 no-padding">
                            <select class="form-control1 col-xs-4" style="border-top-right-radius: 0px;border-bottom-right-radius: 0px">
                                <option value="">MYR</option>
                            </select>
                            <input type="text" class="form-control1 col-xs-8" placeholder="required*" style="border-top-left-radius: 0px;border-bottom-left-radius: 0px" />
                        </div>
                        
                    </div>
                    <div class="col-xs-12 each-prop">
                        <label class="col-sm-4 col-xs-12">
                            International price
                        </label>
                        <div class="col-sm-8 col-xs-12 no-padding">
                            <select class="form-control1 col-xs-4" style="border-top-right-radius: 0px;border-bottom-right-radius: 0px">
                                <option value="">USD</option>
                            </select>
                            <input type="text" class="form-control1 col-xs-8" placeholder="No INTL Selling" style="border-top-left-radius: 0px;border-bottom-left-radius: 0px" />
                        </div>
                    </div>
                    <div class="col-xs-12 each-prop" style="position: relative">
                        <div class="col-sm-4 col-xs-12 no-padding product-description" style="font-weight: bold;">
                            <div class="col-xs-12">Description</div>
                            
                            <input type="submit" class="btn btn-success hidden-xs" value="UPLOAD" style="margin-left: 15px;position: absolute;bottom: 0;left: 0;"/>
                            <button type="button" class="btn btn-danger hidden-xs delete-product-area"  style="margin-left: 15px;position: absolute;bottom: 0;right : 10px;"><i class="glyphicon glyphicon-remove"></i></button>
                        </div>
                        <textarea class="form-control1 col-sm-8 col-xs-12" placeholder="required*" style="height: 80px"></textarea>
                    </div>
                    <div class="col-xs-12 hidden-sm hidden-lg hidden-md">
                        <input type="submit" class="btn btn-success col-xs-12" value="UPLOAD" style="margin-top:5px"/>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 pos-template no-padding">
                <div class="col-sm-7 col-xs-12 product-image-area ">
                    PRODUCT IMAGE
                </div>
                <div class="col-sm-5 col-xs-12 product-details no-padding">
                    <div class="col-xs-12 product-details-each">
                        <div class="col-sm-4 col-xs-12 no-padding">
                            <div class="col-xs-12 no-padding shop-logo">
                                SHOP LOGO
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12 shop-name">
                            SHOP NAME
                        </div>
                        <div class="col-sm-4 col-xs-12 my">
                            MY
                        </div>
                    </div>
                    <div class="col-xs-12 product-details-each">
                        PRODUCT NAME
                    </div>
                    <div class="col-xs-12 product-details-each" style="height: 200px;padding-top:90px">
                        PRODUCT DESCRIPTION
                    </div>
                    <div class="col-xs-12 product-details-each">
                        SHIPPING
                    </div>
                    <div class="col-xs-12 product-details-each" style="border-bottom: none">
                        <div class="col-xs-5 price-container no-padding pull-left">
                            <div class="col-xs-12 local-price-header">
                                Local Price
                            </div>
                            <div class="col-xs-12 local-price-body">
                                THE PRICE
                            </div>
                        </div>
                        <div class="col-xs-5 price-container no-padding pull-right">
                            <div class="col-xs-12 int-price-header">
                                International Price
                            </div>
                            <div class="col-xs-12 int-price-body">
                                USD PRICE
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="xs-hidden sm-hidden col-md-2">
            
        </div>
    <?php include 'includes/footer.php' ?>
