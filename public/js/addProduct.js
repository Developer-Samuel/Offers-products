let counter = 0;
var usedIds = [];

$(document).ready(function() {
    usedIds.push(1);
        $("#show_item").prepend(`
                <li class="row products" id="products-1" data-product-id="1">
                    <div class="col-sm-5">
                    <div class="form-group">
                        <label for="product-name-1">Name</label>
                        <input type="text" class="form-control" name="product-name-1" id="product-name-1" required>
                    </div>
                    </div>
                    <div class="col-sm-2">
                    <div class="form-group">
                        <label for="product-count-1">Count</label>
                        <input type="number" class="form-control" name="product-count-1" id="product-count-1" min="1" value="1">
                    </div>
                    </div>
                    <div class="col-sm-2">
                    <div class="form-group">
                        <label for="product-price-1">Price [$]</label>
                        <input type="number" class="form-control" name="product-price-1" id="product-price-1" min="1" value="1" step="0.01">
                    </div>
                    </div>
                    <div class="col-sm-2">
                    <div class="form-group">
                        <label for="product-discount-1">Discount [%]</label>
                        <input type="number" class="form-control" name="product-discount-1" id="product-discount-1" min="0" max="100" value="0">
                    </div>
                    </div>
                    <div class="col-sm-1">
                    <div class="form-group text-end">&nbsp;</div>
                    <button class="btn btn-sm btn-danger remove_item_btn" data-product-id="1">Remove</button>
                    </div>
                    </div>
                </li>
        `);     
        $('#table-total-price').hide();


    $(".add_item_btn").click(function(e) {
        e.preventDefault();

        if (usedIds.length >= 4) {
            $(".add_item_btn").hide();
        }
        if (usedIds.length >= 5) {
            return;
        }

        var nextId = 1;
        for (var i = 1; i <= 5; i++) {
            if (!usedIds.includes(i)) {
                nextId = i;
                break;
            }
        }
        usedIds.push(nextId);

        $("#show_item").prepend(`
                <li class="row products" id="products-${nextId}" data-product-id="${nextId}">
                    <div class="col-sm-5">
                    <div class="form-group">
                        <label for="product-name-${nextId}">Name</label>
                        <input type="text" class="form-control" name="product-name-${nextId}" id="product-name-${nextId}" required>
                    </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="product-count-${nextId}">Count</label>
                            <input type="number" class="form-control" name="product-count-${nextId}" id="product-count-${nextId}" min="1" value="1">
                        </div>
                    </div>
                    <div class="col-sm-2">
                    <div class="form-group">
                        <label for="product-price-${nextId}">Price [$]</label>
                        <input type="number" class="form-control" name="product-price-${nextId}" id="product-price-${nextId}" min="1" value="1" step="0.01">
                    </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="product-discount-${nextId}">Discount [%]</label>
                            <input type="number" class="form-control" name="product-discount-${nextId}" id="product-discount-${nextId}" min="0" max="100" value="0">
                        </div>
                    </div>
                    <div class="col-sm-1">
                    <div class="form-group text-end">&nbsp;</div>
                    <button class="btn btn-sm btn-danger remove_item_btn" data-product-id="${nextId}">Remove</button>
                    </div>
                    </div>
                </li>
        `);
    });

    $(document).on("click", ".remove_item_btn", function(e) {
        e.preventDefault();
        let product_id = $(this).data("product-id");
        usedIds.splice(usedIds.indexOf(product_id), 1);
        $("[data-product-id='" + product_id + "']").remove();
        
        if (usedIds.length < 5) {
        $(".add_item_btn").show();
        }

        var showTable = false;
        $('input[id^="product-name-"]').each(function() {
            if ($(this).val() != "") {
                showTable = true;
                return false;
            }
        });
        
        if (showTable) {
            $('#table-total-price').show();
        } else {
            $('#table-total-price').hide();
        }
        
    });
});
