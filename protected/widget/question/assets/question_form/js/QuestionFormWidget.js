/**
 *
 *
 */
window.QuestionFormWidget = (function () {
    /**
     * @var object this.
     */
    var _this = this;

    _this.form = "#question-add-form";
    _this.tryCount = 3;
    _this.options = {};

    _this.submitAddForm = function (form, data, hasError) {
        if (!hasError) {
            if (_this.tryCount-- > 0) {
                $.post($(_this.form).attr('action'), $(_this.form).serialize(), function (data) {
                    if (data.success) {
                        $(_this.form).parent().html(
                            '<div class="response__success">' +
                            _this.options["w_nrf_mgs_success"] +
                            '<p>Наш менеджер ответит Вам в ближайшее время</p></div>'
                        );
                    } else {
                        $(_this.form).find("[data-js='result-errors']").html(_this.options["w_nrf_mgs_error"]).show();
                    }
                }, "json");
            } else {
                $(_this.form).find("[data-js='buttons']").html(_this.options["w_nrf_mgs_error_max_try"]).show();
            }
        }
    };

    /**
     * Инициализация
     */
    _this.init = function (options) {
        _this.options = options;
        $("[data-js='add-question']").fancybox();
    };

    return _this;
})();
