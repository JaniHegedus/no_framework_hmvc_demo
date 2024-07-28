<?php
/**
 * Generates a modular header based on provided context.
 *
 * @param string $pageName The name of the page to display.
 * @param bool $showCreationForm Whether to show the creation form or not.
 * @param bool $showDeletionForm Whether to show the deletion form or not.
 * @param array $creationFormAttributes Attributes for the creation form.
 * @param array $deletionFormAttributes Attributes for the deletion form.
 */
function renderHeader($pageName, $showCreationForm = false, $showDeletionForm = false, $creationFormAttributes = [], $deletionFormAttributes = []) {
    ?>
    <header class="header">
        <div class="left-section">
            <h1 class="page-name"><?= htmlspecialchars($pageName) ?>:</h1>
        </div>
        <div class="middle-section">
            <?php if ($showCreationForm): ?>
                <form class="form-creation" name="creation-form" method="post" action="<?= htmlspecialchars($creationFormAttributes['formAction'] ?? '#') ?>">
                    <?php if (!empty($creationFormAttributes['inputFields'])): ?>
                        <?php foreach ($creationFormAttributes['inputFields'] as $input): ?>
                            <input
                                    class="<?= htmlspecialchars($input['class']) ?>"
                                    name="<?= htmlspecialchars($input['name']) ?>"
                                    type="<?= htmlspecialchars($input['type']) ?>"
                                    placeholder="<?= htmlspecialchars($input['placeholder']) ?>"
                                <?= isset($input['value']) ? 'value="' . htmlspecialchars($input['value']) . '"' : '' ?>
                            >
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php if (!empty($creationFormAttributes['buttons'])): ?>
                        <?php foreach ($creationFormAttributes['buttons'] as $button): ?>
                            <button
                                    class="<?= htmlspecialchars($button['class']) ?>"
                                    name="<?= htmlspecialchars($button['name']) ?>"
                                    value="<?= htmlspecialchars($button['value']) ?>"
                                    formaction="<?= htmlspecialchars($button['formaction']) ?>"
                            >
                                <img
                                        class="<?= htmlspecialchars($button['iconClass']) ?>"
                                        src="<?= htmlspecialchars($button['iconSrc']) ?>"
                                        alt="<?= htmlspecialchars($button['alt']) ?>"
                                >
                                <div class="tooltip"><?= htmlspecialchars($button['tooltip']) ?></div>
                            </button>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </form>
            <?php endif; ?>

            <?php if ($showDeletionForm): ?>
                <form class="form-deletion" name="deletion-form" method="post" action="<?= htmlspecialchars($deletionFormAttributes['formAction'] ?? '#') ?>" onsubmit="return confirmDeletion(this);">
                    <?php if (!empty($deletionFormAttributes['inputFields'])): ?>
                        <?php foreach ($deletionFormAttributes['inputFields'] as $input): ?>
                            <input
                                    class="<?= htmlspecialchars($input['class']) ?>"
                                    name="<?= htmlspecialchars($input['name']) ?>"
                                    type="<?= htmlspecialchars($input['type']) ?>"
                                    placeholder="<?= htmlspecialchars($input['placeholder']) ?>"
                                <?= isset($input['value']) ? 'value="' . htmlspecialchars($input['value']) . '"' : '' ?>
                            >
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php if (!empty($deletionFormAttributes['buttons'])): ?>
                        <?php foreach ($deletionFormAttributes['buttons'] as $button): ?>
                            <button
                                    class="<?= htmlspecialchars($button['class']) ?>"
                                    name="<?= htmlspecialchars($button['name']) ?>"
                                    value="<?= htmlspecialchars($button['value']) ?>"
                                    formaction="<?= htmlspecialchars($button['formaction']) ?>"
                            >
                                <img
                                        class="<?= htmlspecialchars($button['iconClass']) ?>"
                                        src="<?= htmlspecialchars($button['iconSrc']) ?>"
                                        alt="<?= htmlspecialchars($button['alt']) ?>"
                                >
                                <div class="tooltip"><?= htmlspecialchars($button['tooltip']) ?></div>
                            </button>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </form>
            <?php endif; ?>
        </div>
    </header>
    <?php
}
?>
