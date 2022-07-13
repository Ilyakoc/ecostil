<?php /** @var Page $page */
if ($page->isShowPageTitle()): ?>
    <h1><?= $page->getMetaH1() ?></h1>
<?php endif ?>
<div class="additional__contacts">
    <? if (D::cms('additional_phones')): ?>
        <div class="additional__item additional-phones">
            <div class="svg-icon">
                <svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M5.06401 0.700317L7.8306 4.34057C8.19462 4.7774 8.12182 5.35984 7.8306 5.72386L5.93767 7.61679C5.06401 8.41765 11.034 14.3877 11.8349 13.5868L13.7278 11.6939C14.0918 11.3298 14.7471 11.3298 15.1111 11.6211L18.7514 14.3877C19.1882 14.7517 19.1882 15.2613 18.897 15.6253L16.8584 17.6639L16.64 17.8823C14.0918 20.3577 7.68499 15.771 5.71925 13.8052C3.75352 11.7667 -0.906006 5.35984 1.64217 2.81166L1.86058 2.66605L3.82632 0.627512C4.19035 0.263487 4.77279 0.336292 5.06401 0.700317Z" />
                </svg>
            </div>
            <div>
                <div class="additional__title">Телефон:</div>
                <?= HtmlHelper::replaceEndLineToParagraph(D::cms('additional_phones')); ?>
            </div>

        </div>
    <? endif; ?>
    <? if (D::cms('additional_emails')): ?>
        <div class="additional__item additional-emails">
            <div class="svg-icon">
                <svg width="20" height="15" viewBox="0 0 20 15" fill="" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.888 0.312012H2.11013C1.72972 0.312012 1.36488 0.46313 1.09589 0.732123C0.8269 1.00112 0.675781 1.36595 0.675781 1.74636V2.33875L9.99905 8.07614L19.3223 2.33875V1.74636C19.3223 1.36595 19.1712 1.00112 18.9022 0.732123C18.6332 0.46313 18.2684 0.312012 17.888 0.312012Z" fill=""/>
                    <path d="M0.675781 4.04114V13.2396C0.675781 13.62 0.8269 13.9849 1.09589 14.2539C1.36488 14.5228 1.72972 14.674 2.11013 14.674H17.888C18.2684 14.674 18.6332 14.5228 18.9022 14.2539C19.1712 13.9849 19.3223 13.62 19.3223 13.2396V4.04114L9.99905 9.77853L0.675781 4.04114Z" fill=""/>
                </svg>
            </div>
            <div>
                <div class="additional__title">Почта:</div>
                <?= HtmlHelper::replaceEndLineToParagraph(D::cms('additional_emails')) ?>
            </div>

        </div>
    <? endif; ?>
    <? if (D::cms('additional_address')): ?>
        <div class="additional__item additional-address">
            <div class="svg-icon">
                <svg width="14" height="20" viewBox="0 0 14 20" fill="" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.00011 19.2492C7.00011 19.2492 0.507812 10.852 0.507812 7.29257C0.507812 3.73684 3.41451 0.85437 7.00011 0.85437C10.5857 0.85437 13.4924 3.73684 13.4924 7.29257C13.4924 10.852 7.00011 19.2492 7.00011 19.2492ZM7.00011 9.13206C8.02497 9.13206 8.85506 8.30888 8.85506 7.29257C8.85506 6.27625 8.02497 5.45308 7.00011 5.45308C5.97526 5.45308 5.14517 6.27625 5.14517 7.29257C5.14517 8.30888 5.97526 9.13206 7.00011 9.13206Z" fill=""/>
                </svg>
            </div>
            <div>
                <div class="additional__title">Адрес:</div>
                <?= HtmlHelper::replaceEndLineToParagraph(D::cms('additional_address')) ?>
            </div>
        </div>
    <? endif; ?>
</div>
<?= $page->text ?>
