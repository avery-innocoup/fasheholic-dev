<div class="col-xs-12 add-product-area" style="cursor: pointer">
    <div class="col-xs-12 plus-sign">+</div>
    <div class="add-product">ADD PRODUCT</div>
</div>
<div class="col-xs-12 add-display-container" style="display: none">
    <div class="col-sm-3 col-xs-12 plus-container">
        <div class=" round-circle-plus">
            <div class="col-xs-12">
				<input id="fash-product-image" name="file" type="file" accept=".jpg,.png,.jpeg">
				<label for="fash-product-image" id="fash-product-image-label">
                +
				</label>
            </div>
            
        </div>
        <div class="col-xs-12 round-circle-plus-text" id="fash-product-image-filename">
                ADD DISPLAY
		</div>
    </div>
	<div class="col-sm-9 col-xs-12">
        <div class="col-xs-12 each-prop">
            <label class="col-sm-4 col-xs-12">
                Product Name
            </label>
            <input type="text" class="form-control1 col-sm-8 col-xs-12 product-name" placeholder="required*" name="product_name" />
        </div>
        <div class="col-xs-12 each-prop">
            <label class="col-sm-4 col-xs-12">
                Product Category
            </label>
            <select class="form-control1 col-sm-8 col-xs-12 product-cat" name="product_cat">
                <option value="">--- Select ---</option>
                <option value="Women Apparel">Women Apparel</option>
                <option value="Men Apparel">Men Apparel</option>
                <option value="Shoes">Shoes</option>
                <option value="Bags & Wallets">Bags & Wallets</option>
                <option value="Bras & Lingerie">Bras & Lingerie</option>
                <option value="Accessories">Accessories</option>
                <option value="Muslim Wear">Muslim Wear</option>
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
                <input type="text" class="form-control1 col-xs-8 product-myr-price" placeholder="required*" style="border-top-left-radius: 0px;border-bottom-left-radius: 0px" name="product_myr_price" />
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
                <input type="text" class="form-control1 col-xs-8 product-usd-price" placeholder="No INTL Selling" style="border-top-left-radius: 0px;border-bottom-left-radius: 0px" name="product_usd_price" />
            </div>
        </div>
        <div class="col-xs-12 each-prop" style="position: relative">
            <div class="col-sm-4 col-xs-12 no-padding product-description" style="font-weight: bold;">
                <div class="col-xs-12">Description</div>
                
                <input type="submit" class="btn btn-success hidden-xs product-upload-btn" value="UPLOAD" style="margin-left: 15px;position: absolute;bottom: 0;left: 0;"/>
                <button type="button" class="btn btn-danger hidden-xs delete-product-area"  style="margin-left: 15px;position: absolute;bottom: 0;right : 10px;"><i class="glyphicon glyphicon-remove"></i></button>
            </div>
            <textarea class="form-control1 col-sm-8 col-xs-12 product-desc" placeholder="required*" style="height: 80px" name="product_desc"></textarea>
        </div>
        <div class="col-xs-12 hidden-sm hidden-lg hidden-md">
            <input type="submit" class="btn btn-success col-xs-12 product-upload-btn" value="UPLOAD" style="margin-top:5px"/>
        </div>
    </div>
</div>


<script type="text/javascript" src="js/homepage_addprod.js"></script>

