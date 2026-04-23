<?php
/**
 * Modern Detail Template
 */
$setBookmarked = trim(isset($_SESSION['bookmark'][$biblio_id]) ? 'bg-emerald-50 text-emerald-700 rounded-lg px-3 py-1.5' : 'text-on-surface-variant px-3 py-1.5');
?>

<div class="max-w-5xl mx-auto">
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Cover Image -->
        <div class="w-full md:w-64 flex-shrink-0">
            <div class="bg-surface-container p-8 rounded-2xl shadow-sm">
                <div class="shadow-lg rounded-xl overflow-hidden">
                  <?= $image; ?>
                </div>
            </div>
            <div class="flex items-center justify-center gap-3 mt-4">
                <a href="#" data-id="<?= $biblio_id ?>" data-detail="true" class="bookMarkBook inline-flex items-center gap-1.5 text-sm font-medium no-underline transition-colors <?= $setBookmarked ?>">
                    <span class="material-symbols-outlined text-lg">bookmark</span>
                    <?= in_array($biblio_id, $_SESSION['bookmark']??[]) ? __('Bookmarked') : __('Bookmark') ?>
                </a>
                <a href="javascript:void(0)" data-toggle="modal" data-id="<?= $biblio_id ?>" data-title="<?= $title ?>" data-target="#mediaSocialModal" class="inline-flex items-center gap-1.5 text-sm font-medium text-on-surface-variant no-underline hover:text-primary transition-colors px-3 py-1.5">
                    <span class="material-symbols-outlined text-lg">share</span>
                    <?= __('Share') ?>
                </a>
            </div>
        </div>

        <!-- Detail Content -->
        <div class="flex-1 min-w-0">
            <div class="flex items-center gap-2 mb-2">
                <span class="material-symbols-outlined text-primary text-lg">bookmark</span>
                <span class="text-sm font-medium text-primary"><?= $gmd_name; ?></span>
            </div>

            <h2 class="text-xl md:text-2xl font-bold text-on-surface mb-2 leading-tight"><?= $title; ?></h2>
            <p class="text-sm text-on-surface-variant mb-4"><?= str_replace("<br />", '; ', $authors); ?></p>

            <hr class="border-gray-100 my-4">

            <div class="text-sm text-on-surface-variant leading-relaxed mb-6">
              <?= $notes ? $notes : '<em class="text-outline">'.__('Description Not Available').'</em>'; ?>
            </div>

            <!-- Availability -->
            <div class="mb-6">
                <h5 class="text-sm font-bold text-on-surface mb-3 flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg text-primary">inventory_2</span>
                    <?= __('Availability'); ?>
                </h5>
                <?= ($availability) ? '<div class="overflow-x-auto rounded-xl border border-gray-100">'.$availability.'</div>' : '<p class="text-sm text-outline">' . __('No copy data') . '</p>'; ?>
            </div>

            <!-- Detail Information -->
            <div class="mb-6">
                <h5 class="text-sm font-bold text-on-surface mb-3 flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg text-primary">info</span>
                    <?= __('Detail Information'); ?>
                </h5>
                <div class="bg-surface-container-low rounded-xl p-4 space-y-3 text-sm">
                    <div class="flex gap-3"><span class="font-medium text-on-surface-variant w-40 flex-shrink-0"><?= __('Series Title'); ?></span><span class="text-on-surface"><?= ($series_title) ? $series_title : '-'; ?></span></div>
                    <div class="flex gap-3"><span class="font-medium text-on-surface-variant w-40 flex-shrink-0"><?= __('Call Number'); ?></span><span class="text-on-surface"><?= ($call_number) ? $call_number : '-'; ?></span></div>
                    <div class="flex gap-3"><span class="font-medium text-on-surface-variant w-40 flex-shrink-0"><?= __('Publisher'); ?></span><span class="text-on-surface"><?= $publish_place ?> : <?= $publisher_name ?>., <?= $publish_year ?></span></div>
                    <div class="flex gap-3"><span class="font-medium text-on-surface-variant w-40 flex-shrink-0"><?= __('Collation'); ?></span><span class="text-on-surface"><?= ($collation) ? $collation : '-'; ?></span></div>
                    <div class="flex gap-3"><span class="font-medium text-on-surface-variant w-40 flex-shrink-0"><?= __('Language'); ?></span><span class="text-on-surface"><?= $language_name ?></span></div>
                    <div class="flex gap-3"><span class="font-medium text-on-surface-variant w-40 flex-shrink-0"><?= __('ISBN/ISSN'); ?></span><span class="text-on-surface"><?= ($isbn_issn) ? $isbn_issn : '-'; ?></span></div>
                    <div class="flex gap-3"><span class="font-medium text-on-surface-variant w-40 flex-shrink-0"><?= __('Classification'); ?></span><span class="text-on-surface"><?= ($classification) ? $classification : '-'; ?></span></div>
                    <div class="flex gap-3"><span class="font-medium text-on-surface-variant w-40 flex-shrink-0"><?= __('Content Type'); ?></span><span class="text-on-surface"><?= ($content_type) ? $content_type : '-'; ?></span></div>
                    <div class="flex gap-3"><span class="font-medium text-on-surface-variant w-40 flex-shrink-0"><?= __('Media Type'); ?></span><span class="text-on-surface"><?= ($media_type) ? $media_type : '-'; ?></span></div>
                    <div class="flex gap-3"><span class="font-medium text-on-surface-variant w-40 flex-shrink-0"><?= __('Carrier Type'); ?></span><span class="text-on-surface"><?= ($carrier_type) ? $carrier_type : '-'; ?></span></div>
                    <div class="flex gap-3"><span class="font-medium text-on-surface-variant w-40 flex-shrink-0"><?= __('Edition'); ?></span><span class="text-on-surface"><?= ($edition) ? $edition : '-'; ?></span></div>
                    <div class="flex gap-3"><span class="font-medium text-on-surface-variant w-40 flex-shrink-0"><?= __('Subject(s)'); ?></span><span class="text-on-surface"><?= ($subjects) ? $subjects : '-'; ?></span></div>
                    <div class="flex gap-3"><span class="font-medium text-on-surface-variant w-40 flex-shrink-0"><?= __('Specific Detail Info'); ?></span><span class="text-on-surface"><?= ($spec_detail_info) ? $spec_detail_info : '-'; ?></span></div>
                    <div class="flex gap-3"><span class="font-medium text-on-surface-variant w-40 flex-shrink-0"><?= __('Statement of Responsibility'); ?></span><span class="text-on-surface"><?= ($sor) ? $sor : '-'; ?></span></div>
                </div>
            </div>

          <?php if (count($biblio_custom) > 0): ?>
            <div class="mb-6">
                <h5 class="text-sm font-bold text-on-surface mb-3"><?= __('Other Information'); ?></h5>
                <div class="bg-surface-container-low rounded-xl p-4 space-y-3 text-sm">
                    <?php foreach ($biblio_custom as $item): ?>
                    <div class="flex gap-3"><span class="font-medium text-on-surface-variant w-40 flex-shrink-0"><?= $item['label']; ?></span><span class="text-on-surface"><?= ($item['value']) ? $item['value'] : '-'; ?></span></div>
                    <?php endforeach; ?>
                </div>
            </div>
          <?php endif; ?>

            <div class="mb-6">
                <h5 class="text-sm font-bold text-on-surface mb-3"><?= __('Other version/related'); ?></h5>
                <?= ($related) ? $related : '<p class="text-sm text-outline">' . __('No other version available') . '</p>'; ?>
            </div>

            <div class="mb-6" id="attachment">
                <h5 class="text-sm font-bold text-on-surface mb-3 flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg text-primary">attach_file</span>
                    <?= __('File Attachment'); ?>
                </h5>
                <?= !$file_att ? '<em class="text-sm text-outline">'.__('No Data').'</em>' : $file_att ; ?>
            </div>

            <div class="mb-6" id="comment">
                <h5 class="text-sm font-bold text-on-surface mb-3 flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg text-primary">forum</span>
                    <?= __('Comments'); ?>
                </h5>
                <?php echo showComment($biblio_id); ?>
                <?php if(!isset($_SESSION['mid']) && $sysconf['comment']['enable']) : ?>
                    <hr class="my-3 border-gray-100">
                    <a href="index.php?p=member" class="inline-flex items-center gap-2 px-4 py-2 bg-primary/10 text-primary rounded-lg text-sm font-medium no-underline hover:bg-primary/20 transition-colors">
                        <span class="material-symbols-outlined text-lg">login</span>
                        <?= __('You must be logged in to post a comment'); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
