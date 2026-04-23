<?php
# Modern Topic Modal - Subject selection grid
?>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <span class="material-symbols-outlined text-primary align-middle mr-1">category</span>
                    <?= __('Select the topic you are interested in'); ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="topic-grid">
                    <?php
                    $topics = [
                        ['0', 'auto_stories', __('General Works')],
                        ['1', 'psychology', __('Philosophy')],
                        ['2', 'mosque', __('Religion')],
                        ['3', 'public', __('Social Sciences')],
                        ['4', 'translate', __('Language')],
                        ['5', 'science', __('Pure Sciences')],
                        ['6', 'engineering', __('Applied Sciences')],
                        ['7', 'palette', __('Art & Recreation')],
                        ['8', 'menu_book', __('Literature')],
                        ['9', 'history_edu', __('Geography & History')],
                    ];
                    foreach ($topics as $topic) {
                        echo '<a href="index.php?callnumber='.$topic[0].'&search=search">
                            <span class="material-symbols-outlined text-primary text-lg">'.$topic[1].'</span>
                            '.$topic[2].'
                        </a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
