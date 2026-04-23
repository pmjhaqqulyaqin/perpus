<?php
# Modern Other Pages (info, news, help, detail, etc.)
?>

<div class="result-search">
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
      <?php
      if ($_GET['p'] !== 'show_detail') {
        echo '<div class="bg-white rounded-2xl shadow-sm border border-emerald-900/5 p-6 md:p-8">';
        echo '<h2 class="text-headline-md font-semibold text-on-surface mb-4 pb-3 border-b border-gray-100">' . $page_title . '</h2>';
        if ($_GET['p'] === 'librarian') {
          echo '<div class="grid grid-cols-1 md:grid-cols-2 gap-6">' . $main_content . '</div>';
        } else {
          echo '<div class="prose max-w-none text-on-surface-variant">' . $main_content . '</div>';
        }
        echo '</div>';
      } else {
        echo '<div class="bg-white rounded-2xl shadow-sm border border-emerald-900/5 p-6 md:p-8">' . $main_content . '</div>';
      }
      ?>
    </section>
</div>
