<?php
/**
 * Views > Admin > Tab > Setting.
 *
 * @since   1.0.0
 * @version 1.0.0
 * @author  Mafel John Cahucom 
 */

use HATFW\Admin\Inc\Helper;
use HATFW\Admin\Inc\Component;

defined( 'ABSPATH' ) || exit;

/**
 * Header
 */
echo Component::get_header( $args['page_title'] ); ?>

<div class="hd-container">

    <div class="hd-accordion hd-card hd-mb-50">
        <div class="hd-accordion__header">
            <div class="hd-flex hd-flex-jc-sb hd-flex-ai-c">
                <div>
                    <span class="hd-title">Import Settings</span>
                </div>
                <div class="hd-ml-10">
                    <button class="hatfw-js-toggle-accordion-btn hd-btn-circle" data-state="open" aria-label="toggle">
                        <?php echo Helper::get_icon( 'caret-down-filled', 'hd-svg' ); ?>
                    </button>
                </div>
            </div>
        </div>
        <div class="hd-accordion__body" data-state="open">
            <div class="hd-accordion__content">
                <div class="hd-form-field">
                    <p class="hd-text hd-mb-15">Upload the setting file, only <b>.txt</b> file type is allowed.</p>
                    <label class="hd-file-field hd-mb-15" title="Upload file" aria-label="Upload file">
                        <div class="hd-flex hd-flex-ai-c">
                            <div class="hd-file-field__circle">
                                <?php echo Helper::get_icon( 'plus-circle-fill', 'hd-svg' ); ?>
                            </div>
                            <div class="hd-file-field__label">
                                <span class="hd-js-file-field-label hd-fs-13 hd-fw-500">Choose a file</span>
                            </div>
                        </div>
                        <input type="file" id="hqfw-js-file-field-input" class="hd-js-file-field-input hd-file-field__input" accept=".txt">
                    </label>
                    <button id="hqfw-js-import-file-btn" class="hd-btn" data-state="default">
                        <span>Run Importer</span>
                        <div class="hd-loader"></div>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="hd-accordion hd-card hd-mb-50">
        <div class="hd-accordion__header">
            <div class="hd-flex hd-flex-jc-sb hd-flex-ai-c">
                <div>
                    <span class="hd-title">Export Settings</span>
                </div>
                <div class="hd-ml-10">
                    <button class="hatfw-js-toggle-accordion-btn hd-btn-circle" data-state="open" aria-label="toggle">
                        <?php echo Helper::get_icon( 'caret-down-filled', 'hd-svg' ); ?>
                    </button>
                </div>
            </div>
        </div>
        <div class="hd-accordion__body" data-state="open">
            <div class="hd-accordion__content">
                <div class="hd-form-field">
                    <p class="hd-text hd-mb-15">Download the settings file configuration.</p>
                    <button id="hatfw-js-export-file-btn" class="hd-btn" data-state="default">
                        <span>Export Settings</span>
                        <div class="hd-loader"></div>
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
    /**
     * Prompt Loader.
     */
    echo Component::get_prompt_loader();

    /**
     * Prompt Dialog.
     */
    echo Component::get_prompt_dialog();

    /**
     * Footer
     */
    echo Component::get_footer(); 
?>