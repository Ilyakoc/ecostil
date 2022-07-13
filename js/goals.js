$(document).ready(function(){
	// replace it! window.yaCounter01234567
	function reach(e){if(typeof window.yaCounter01234567!='undefined'){window.yaCounter01234567.reachGoal(e.data.goal);}}
	function bind(exp,goal,evt){if(typeof evt=='undefined'){evt='click';}$(document).on(evt,exp,{goal:goal},reach);}
	function gbind(exp,callback,evt){if(typeof evt=='undefined'){evt='click';}$(document).on(evt,exp,callback);}
	function gclick(e){if(typeof gtag!='undefined'){gtag('event', e.data.goal, {'event_category': 'click'});}}
	function gsubmit(e){if(typeof gtag!='undefined'){gtag('event', e.data.goal, {'event_category': 'submit'});}}
	function gcustom(e){if(typeof gtag!='undefined'){gtag('event', e.data.goal, e.data.params);}}
	function gbind(exp,callback,evt){if(typeof evt=='undefined'){evt='click';}$(document).on(evt,exp,callback);}
	$(document).on('click', '[data-ym-goal]', function(e) { reach({data:{goal:$(e.target).closest('[data-ym-goal]').data('ym-goal')}}); });
	$(document).on('click', '[data-gtag-click]', function(e) { gclick({data:{goal:$(e.target).closest('[data-gtag-click]').data('gtag-click')}}); });
	$(document).on('submit', '[data-gtag-submit]', function(e) { gsubmit({data:{goal:$(e.target).closest('[data-gtag-submit]').data('gtag-submit')}}); });
	$(document).on('cms.feedback.sended', '[data-gtag-feedback]', function(e) { gsubmit({data:{goal:$(e.target).closest('[data-gtag-feedback]').data('gtag-feedback')}}); });
	// bind(jquerySelector, goal, eventName), ex:
	// bind('.btn', 'btn_ok');
	// bind('form', 'form_ok', 'submit');
	// bind('form[id^="feedback-callback-form"]', 'callback_ok', 'cms.feedback.sended');
	// gbind(".btn", function(){ gtag('event', 'btn_ok', {'event_category': 'click'}); });
	// gbind("form", function(){ gtag('event', 'form_ok', {'event_category': 'submit'}); }, 'submit');
});
