<?php
# Modern Advanced Search Modal
?>
<div class="modal fade" id="adv-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <span class="material-symbols-outlined text-primary align-middle mr-1">tune</span>
                    <?= __('Advanced Search'); ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="index.php" method="GET" id="advSearchForm">
                    <input type="hidden" name="search" value="search">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']??'' ?>">

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-on-surface-variant mb-1"><?= __('Title'); ?></label>
                            <input type="text" name="title" class="form-control w-full" placeholder="<?= __('Enter title keyword'); ?>">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-on-surface-variant mb-1"><?= __('Author'); ?></label>
                            <input type="text" name="author" class="form-control w-full" placeholder="<?= __('Enter author name'); ?>">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-on-surface-variant mb-1"><?= __('Subject'); ?></label>
                            <input type="text" name="subject" class="form-control w-full" placeholder="<?= __('Enter subject'); ?>">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-on-surface-variant mb-1"><?= __('ISBN/ISSN'); ?></label>
                                <input type="text" name="isbn" class="form-control w-full" placeholder="<?= __('Enter ISBN/ISSN'); ?>">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-on-surface-variant mb-1"><?= __('Publisher'); ?></label>
                                <input type="text" name="publisherName" class="form-control w-full" placeholder="<?= __('Enter publisher'); ?>">
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-on-surface-variant mb-1"><?= __('Collection Type'); ?></label>
                                <select name="colltype" class="form-control w-full">
                                    <option value=""><?= __('ALL'); ?></option>
                                    <?php
                                    $ct_q = $dbs->query("SELECT coll_type_id, coll_type_name FROM mst_coll_type");
                                    while ($ct_d = $ct_q->fetch_assoc()) {
                                        echo '<option value="'.$ct_d['coll_type_id'].'">'.$ct_d['coll_type_name'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-on-surface-variant mb-1"><?= __('Location'); ?></label>
                                <select name="location" class="form-control w-full">
                                    <option value=""><?= __('ALL'); ?></option>
                                    <?php
                                    $loc_q = $dbs->query("SELECT location_id, location_name FROM mst_location");
                                    while ($loc_d = $loc_q->fetch_assoc()) {
                                        echo '<option value="'.$loc_d['location_id'].'">'.$loc_d['location_name'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 mt-6 pt-4 border-t border-gray-100">
                        <button type="button" class="px-4 py-2 text-sm font-medium text-on-surface-variant bg-surface-container-high rounded-lg hover:bg-surface-dim transition-colors" data-dismiss="modal"><?= __('Cancel'); ?></button>
                        <button type="submit" class="px-6 py-2 text-sm font-semibold text-white bg-primary rounded-lg hover:bg-primary-container transition-colors"><?= __('Search'); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
