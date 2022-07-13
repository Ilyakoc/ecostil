<?php

?>
<a href="<?= $this->createUrl('gallery/album', array('id' => $data->id)) ?>">
    <div class="album__item">

        <figure class="effect-steve">
            <img src="<?= ResizeHelper::resize($data->getAlbumPreview(), 370, 230); ?>"/>
            <figcaption>
                <div class="album__title">
                    <span><?= $data->title ?></span>
                </div>
                <div class="album__count">
                    <span>
                        <?= $data->getImageCount() ?> фото
                        <svg width="25" height="9" viewBox="0 0 25 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M24.6231 4.80643C24.8183 4.61117 24.8183 4.29459 24.6231 4.09933L21.4411 0.917347C21.2458 0.722085 20.9293 0.722085 20.734 0.917347C20.5387 1.11261 20.5387 1.42919 20.734 1.62445L23.5624 4.45288L20.734 7.28131C20.5387 7.47657 20.5387 7.79315 20.734 7.98841C20.9293 8.18368 21.2458 8.18368 21.4411 7.98841L24.6231 4.80643ZM0.269531 4.95288L24.2695 4.95288V3.95288L0.269531 3.95288L0.269531 4.95288Z"
                                  fill="white"/>
                        </svg>
                    </span>
                </div>
            </figcaption>
        </figure>
    </div>
</a>