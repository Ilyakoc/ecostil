<?php

use common\components\helpers\HYii as Y;
use common\components\helpers\HHtml;

?>
<div class="question-item">
    <div class="question-item__question">
        <div class="question__icon">
            <svg width="43" height="40" viewBox="0 0 43 40" fill="" xmlns="http://www.w3.org/2000/svg">
                <path d="M33.5872 39.7083L21.2914 31.0454H0.146484V0.119751H42.0638V31.0454H34.0063V29.6481H40.6199V1.56357H1.5903V29.6481H21.7106L34.3789 38.4974L33.5872 39.7083Z"
                      fill=""/>
                <path d="M15.0547 9.85472C16.0665 7.57176 18.3377 6.08948 20.8354 6.08948C24.3205 6.08948 27.1556 8.92412 27.1556 12.4097C27.1556 14.9899 25.5863 17.3099 23.1923 18.2725C22.3199 18.6221 21.7899 19.4147 21.7899 20.3529L21.7886 21.4554H19.8841V20.3529C19.8759 18.6325 20.8904 17.1452 22.4841 16.5051C24.1541 15.833 25.2457 14.2082 25.2457 12.4097C25.2457 9.96885 23.2767 7.99984 20.8359 7.99984C19.0838 7.99984 17.5109 9.02156 16.8009 10.6238L15.0551 9.85517L15.0547 9.85472ZM21.7872 22.7983L21.7854 24.6013H19.8836V22.7983H21.7872Z"
                      fill=""/>
            </svg>
        </div>
        <div class="question-item__content">
            <div class="question-item__author">
                <?= $data->username; ?>
            </div>
            <?= $data->question; ?>
        </div>
    </div>
    <div class="question-item__answer">
        <div class="question-item__content">
            <?= $data->answer; ?>
        </div>
        <div class="question__icon">
            <svg width="42" height="41" viewBox="0 0 42 41" fill="" xmlns="http://www.w3.org/2000/svg">
                <path d="M20.0137 20.0039L20.0137 9.01817L22.0068 9.01817L22.0068 20.0039L20.0137 20.0039Z" fill=""/>
                <path d="M20.0137 24.0078L20.0137 22.0298L21.999 22.0298L21.999 24.0078L20.0137 24.0078Z" fill=""/>
                <path d="M8.47534 40.5368L20.7711 31.8739H41.916V0.948242H-0.00126266V31.8739H8.05617V30.4766H1.44255V2.39206H40.4722V30.4766H20.3519L7.68357 39.3258L8.47534 40.5368Z" fill=""/>
            </svg>
        </div>
    </div>
</div>

