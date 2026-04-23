<?php
# Modern Search Results Page
?>

<div class="result-search">
    <section id="section1 container-fluid">
        <header class="c-header" style="display:none;">
            <div class="mask"></div>
          <?php include '_navbar.php'; ?>
        </header>
        <!-- Search form in a styled wrapper -->
        <div class="bg-gradient-to-b from-primary-fixed/20 to-transparent pt-6 pb-8">
            <?php include '_search-form.php'; ?>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 mt-6 pb-24 md:pb-12">
        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Sidebar Filters -->
            <div class="lg:w-64 flex-shrink-0">
                <div class="bg-white rounded-2xl shadow-sm border border-emerald-900/5 p-4 sticky top-20">
                    <h4 class="text-sm font-bold text-on-surface mb-3 flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg text-primary">filter_list</span>
                        <?= __('Filter by') ?>
                    </h4>
                    <div class="filter-content text-sm">
                        <?= $engine->getFilter($opac, true) ?>
                    </div>
                </div>
            </div>
            <!-- Results -->
            <div class="flex-1 min-w-0">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-4 pb-3 border-b border-gray-100">
                    <div class="text-sm text-on-surface-variant">
                        <?php
                        $keywords_info = '<span class="font-semibold text-primary" title="' . htmlentities($keywords) . '">' . ((strlen($keywords) > 30) ? substr($keywords, 0, 30) . '...' : $keywords) . '</span>';
                        $search_result_info = __('Found <strong>{biblio_list->num_rows}</strong> from your keywords') . ': ' . $keywords_info;
                        echo str_replace('{biblio_list->num_rows}', '<span class="text-primary font-bold">' . $engine->getNumRows() . '</span>', $search_result_info);
                        ?>
                    </div>
                    <div class="flex items-center gap-2">
                        <label class="text-xs font-medium text-on-surface-variant whitespace-nowrap" for="search-order"><?= __('Sort by') ?></label>
                        <select class="text-sm border border-gray-200 rounded-lg px-3 py-1.5 bg-white focus:ring-2 focus:ring-primary focus:outline-none" id="search-order"><?= $sort_select ?></select>
                        <form class="m-0" method="POST" action="<?= $_SERVER['PHP_SELF'] . '?' . http_build_query(array_filter($_GET, fn($key) => $key !== 'csrf_token', ARRAY_FILTER_USE_KEY)) ?>">
                            <?php if(($_SESSION['LIST_VIEW'] ?? 'list') === 'list'): ?>
                                <input type="hidden" name="csrf_token" value="<?= $opac->getCsrf() ?>"/>
                                <input type="hidden" name="view" value="grid" />
                                <button type="submit" class="p-2 rounded-lg border border-gray-200 hover:bg-primary/5 transition-colors" title="Grid view">
                                    <span class="material-symbols-outlined text-lg">grid_view</span>
                                </button>
                            <?php else: ?>
                                <input type="hidden" name="view" value="list" />
                                <button type="submit" class="p-2 rounded-lg border border-gray-200 hover:bg-primary/5 transition-colors" title="List view">
                                    <span class="material-symbols-outlined text-lg">view_list</span>
                                </button>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
                <div class="wrapper">
                    <?php
                    if (ENVIRONMENT == 'development' && !empty($engine->getError())) echo '<div class="bg-error/10 text-error rounded-xl p-4 mb-4 text-sm">' . $engine->getError() . '</div>';
                    if (trim(strip_tags($main_content)) === '') {
                        echo '<div class="flex flex-col items-center justify-center py-16">
                                <span class="material-symbols-outlined text-6xl text-on-surface-variant/30 mb-4">search_off</span>
                                <p class="text-lg font-semibold text-on-surface mb-1">'.__('No Result').'</p>
                                <p class="text-sm text-on-surface-variant">'.__('Please try again with different keywords').'</p>
                              </div>';
                    } else {
                        echo $main_content;
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
</div>

<?php if(($_SESSION['LIST_VIEW'] ?? 'list') === 'grid'): ?>
<script>
    $(document).ready(function () {
        let imagesLoaded = 0;
        let totalImages = $(".grid-item .img-thumbnail").length;
        $(".grid-item .img-thumbnail").each(function (idx, img) {
            $("<img>").on("load", imageLoaded).attr("src", $(img).attr("src"));
        });
        function imageLoaded() {
            imagesLoaded++;
            if (imagesLoaded == totalImages) allImagesLoaded();
        }
        function allImagesLoaded() {
            $('.biblioResult').addClass('row').masonry({ itemSelector: '.grid-item', columnWidth: '.grid-item' });
            $('.dropdown-toggle').dropdown();
        }
    });
</script>
<?php endif; ?>