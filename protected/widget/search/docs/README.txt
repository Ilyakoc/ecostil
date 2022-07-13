Пример формы автозаполнения

<? $this->widget('widget.search.SearchWidget', [
    'auto'=>true,
    'placeholder'=>'Поиск по каталогу',
    'formOptions'=>['class'=>'search sidebar__search'],
    'inputOptions'=>['class'=>'search__input'],
    'submitOptions'=>['class'=>'search__submit'],
    'submit'=>'<i class="fas fa-search"></i>',
    'autoResultOptions'=>['class'=>'search__autoresult'],
]); ?>

Пример стилей:

.search__autoresult {
    width: 100%;
    position: absolute;
    margin-top: 1px;
    border: 1px solid #9a9a9a;
    padding: 0;
    background: #fff;
    z-index: 999;
    max-height: 250px;
    overflow: hidden;
    overflow-y: auto;
    .box-shadow(3px 9px 8px 0px #697582);

    /* &:before {
        content: '\0420 \0435 \0437 \0443 \043B \044C \0442 \0430 \0442 \044B  \043F \043E \0438 \0441 \043A \0430 ';
        display: block;
        padding: 3px 5px;
        background: #9fabb7;
        color: #fff;
    } */

    ul {
        list-style: none;
        width: 100%;
        margin: 0 !important;
        padding: 0 !important;
        
        li {
            width: 100%;
            border-bottom: 1px solid #697582;
            margin: 0;
            padding: 3px 5px;
            &:last-child {
                border-bottom: 0;
            }
            &:nth-child(even) {
                background: #f1f0f0;
            }
            mark {
                color: #f01420;
            }
            a {
                color: #3a3a3a;
                text-decoration: none;
            }
        }
    }
}