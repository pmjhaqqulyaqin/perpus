<?php
# Modern Member Page
?>

<div class="member-area">
    <section id="section1 container-fluid">
        <header class="c-header" style="display:none;">
            <div class="mask"></div>
          <?php include '_navbar.php'; ?>
        </header>
        <div class="bg-gradient-to-b from-primary-fixed/20 to-transparent pt-6 pb-8">
            <?php include '_search-form.php'; ?>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 mt-6 pb-24 md:pb-12">
        <div class="bg-white rounded-2xl shadow-sm border border-emerald-900/5 p-6 md:p-8">
            <?php
            if (!$is_login) {
                // Show header info if any
                if (!empty($header_info)) echo $header_info;
            }
            echo $main_content;
            ?>
        </div>
    </section>
</div>
