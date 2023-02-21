<?php if (isset($errors) && count($errors) > 0) { ?>
    <!--begin::Alert-->
    <div id="alert" class="alert">
        <div class="alert-error">
            <!--begin::Close button-->
            <span id="alertCloseBtn" class="alert-closeBtn">X</span>
            <!--end::Close button-->
            <?php foreach ($errors as $err) { ?>
              <!--begin::Modal errors-->
              <div><?php echo $err; ?></div>
              <!--end::Modal errors-->
            <?php } ?>
        </div>
    </div>
    <!--end::Alert-->
<?php } ?>

<?php if (isset($_SESSION['alerts']['success']) && !empty($_SESSION['alerts']['success'])): ?>
    <?php foreach ($_SESSION['alerts']['success'] as $successMessage): ?>
        <!--begin::Alert-->
        <div id="alert" class="alert">
            <div class="alert-success">
                <!--begin::Close button-->
                <span id="alertCloseBtn" class="alert-closeBtn">X</span>
                <!--end::Close button-->
                <!--begin::Modal message-->
                <div><?php echo $successMessage; ?></div>
                <!--end::Modal message-->
            </div>
        </div>
        <!--end::Alert-->
    <?php endforeach; ?>
    <?php unset($_SESSION['alerts']['success']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['alerts']['errors']) && !empty($_SESSION['alerts']['errors'])): ?>
    <?php foreach ($_SESSION['alerts']['errors'] as $errorMessage): ?>
        <!--begin::Alert-->
        <div id="alert" class="alert">
            <div class="alert-error">
                <!--begin::Close button-->
                <span id="alertCloseBtn" class="alert-closeBtn">X</span>
                <!--end::Close button-->
                <!--begin::Modal message-->
                <div><?php echo $errorMessage; ?></div>
                <!--end::Modal message-->
            </div>
        </div>
        <!--end::Alert-->
    <?php endforeach; ?>
    <?php unset($_SESSION['alerts']['errors']); ?>
<?php endif; ?>
