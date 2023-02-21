<!--begin::Modal-->
<div id="modal-add-offer" class="modal">
    <!--begin::Modal content-->
    <div class="modal-add-content">
        <!--begin::Close <span> button-->
        <span id="close" class="close">&times;</span>
        <!--end::Close <span> button-->
        <!--begin::Modal body-->
        <div class="modal-offer-body">
            <!--begin::Modal title-->
            <h3 class="text-center">Add offer</h3>      
            <!--end::Modal title--> 
            <!--begin::Form-->
            <form class="form w-75" action="addOffer" method="POST">
                <!--begin::Form group-->
                <div class="form-group w-75">
                    <label for="offer-name">Name</label>
                    <input type="text" class="form-control" name="offer-name" id="offer-name" required>
                </div>
                <!--end::Form group-->
                <!--begin::Form group-->
                <div class="form-group w-75">
                    <label for="customer-name">Customer name</label>
                    <!--begin::Select-->       
                    <select class="form-select" name="customer-name" id="customer-name">
                        <option value=" " selected></option>
                        <?php foreach ($customers as $customer): ?>
                            <option value="<?php echo $customer['name']; ?>">
                                <?php echo $customer['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <!--end::Select-->  
                </div>
                <!--end::Form group-->
                <!--begin::Form group-->
                <div class="form-group w-75">
                    <label for="validity-offer">Validity offer</label>
                    <input type="date" class="form-control" name="validity-offer" id="validity-offer" required>
                </div>
                <!--end::Form group-->
                <!--begin::Form group-->
                <div class="form-group w-75">
                    <label for="note">Note</label>
                    <textarea class="form-control" name="note" id="note" rows="3" required></textarea>
                </div>
                <!--end::Form group-->
                <br>
                <!--begin::Form group-->
                <div class="form-group">
                    <!--begin::Title-->
                    <h5>Products</h5>
                    <!--end::Title-->
                    <!--begin::Item-->
                    <div id="show_item">
                        <!--begin::Sortable list-->
                        <ul class="connected-sortable"> 
                                            
                        </ul>
                        <!--end::Sortable list-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Form group-->
                    <div class="form-group text-center">
                        <!--begin::Button-->
                        <button class="btn btn-sm btn-success add_item_btn">Add</button>
                        <!--end::Button-->
                    </div>
                    <!--end::Form group-->
                    <!--begin::Form group-->
                    <div class="py-5 text-center">
                        <!--begin::Button-->
                        <button type="submit" class="btn btn-primary" name="AddOffer">Add Offer</button>
                        <!--end::Button-->
                    </div>
                    <!--end::Form group-->
                </div>
                <!--end::Form group-->
            </form>                            
            <!--end::Form-->
            <!--begin::Table-->
            <!--<table id="table-total-price" class="table">
                <thead id="main-thead" class="thead-dark">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Count</th>
                        <th scope="col">Price [$]</th>
                        <th scope="col">Discount [%]</th>
                        <th class="text-end" scope="col">Price after discount [$]</th>
                    </tr>
                </thead>

                <tbody class="table-light">
           
                </tbody>
            </table>-->
            <!--end::Table-->
        </div>
        <!--end::Modal body-->
    </div>
    <!--end::Modal content-->
</div>
<!--end::Modal-->