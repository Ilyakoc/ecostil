var mobileWidth = 768;

var toCartAnimation = function (obj) {
	var cv = obj.innerWidth();
	var ch = obj.innerHeight();
	var ot = obj.offset().top - $(document).scrollTop();
	var ol = obj.offset().left;

	obj.clone()
		.css({
			'position': 'fixed',
			'z-index': '100',
			'width': cv,
			'height': ch,
			'top': ot,
			'left': ol,
			'opasity': 0.5
		})
		.appendTo('body')
		.addClass('product-scale')
		.removeClass('slick-slide')
		.animate({
			opacity: '0',
			marginTop: -ch,
			marginLeft: -cv,
			top: 0,
			left: '100%',
			opacity: 0,
		},
			500, function () {
				$(this).remove();
			});
}

function fixedFooter() {
	var footer = $('.footer');
	var header = $('.header');
	if (footer.length) {
		var height = $(window).height() - footer.position().top - footer.innerHeight();
		if (height > 0) {
			const ph = header.height();
			height = (height - ph);
			height = (height < 0) ? 62 : height;
			footer.css({
				'margin-top': height + 'px'
			});
		}
	}
}

$(document).ready(function () {
	fixedFooter();

	$('table').wrap('<div class="table-wrap"></div>');
	try {
		const mainImgWrap = document.querySelector('.product-main-img');
		mainImgWrap.addEventListener('mouseover', function () {

			mainImgWrap.style.minWidth = `${getComputedStyle(mainImgWrap).width}`;
			mainImgWrap.style.minHeight = `${getComputedStyle(mainImgWrap).height}`;
			const mainImg = document.querySelector('.image-full img');
			mainImg.classList.add('active');
			document.querySelector('.ico-box').style.display = 'none';
			document.querySelector('.main-img-zoom').style.display = 'none';

			mainImgWrap.addEventListener('mousemove', function (e) {
				const w = parseInt(getComputedStyle(mainImgWrap).width) / 2;
				const h = parseInt(getComputedStyle(mainImgWrap).height) / 2;
				mainImg.style.transform = `translate(calc(-50% - ${e.offsetX - w}px),calc(-50% - ${e.offsetY - h}px))`;
			});


		});
		mainImgWrap.addEventListener('mouseout', () => {
			const mainImg = document.querySelector('.image-full img');
			mainImg.classList.remove('active');
			mainImg.removeAttribute('style');
			document.querySelector('.ico-box').style.display = '';
			document.querySelector('.main-img-zoom').style.display = '';
		});
	} catch (error) {
		console.log('OK');
	}


	$('.nav a').click(function () {
		var ul = $(this).next('ul');
		if (ul.length && $(window).width() < mobileWidth) {
			ul.slideToggle(300);
			return false;
		}

		return true;
	});

	$('.nav-btn').click(function () {
		$('.nav').slideToggle(300);
	});

	$(window).resize(function () {
		fixedFooter();

		if ($(window).width() > mobileWidth && $('.nav').is(':hidden')) {
			$('.nav').removeAttr('style');
		}
	});

	var header = $('.header').length ? $('.header').outerHeight() : 0;
	var navbar = $('.navbar');
	if (header && navbar.length) {
		$(window).scroll(function () {
			if ($(this).scrollTop() > header) {
				navbar.addClass('navbar-fixed');
				$('body').css('padding-top', navbar.innerHeight() + 'px');
			} else {
				navbar.removeClass('navbar-fixed');
				$('body').css('padding-top', 0);
			}
		});
	}

	$(document).on('click', '.js__in-cart', function () {
		toCartAnimation($(this).closest(".product-item").find('img'));
		$(this).addClass('in-cart-active');
	});

	$(document).on('click', '.js__photo-in-cart', function () {
		toCartAnimation($(".js__main-photo"));
		$(this).addClass('in-cart-active');
	});

	// Скрипт оберзки текста
	(function (selector) {
		var maxHeight = 100, // максимальная высота свернутого блока
			togglerClass = "read-more", // класс для ссылки Читать далее
			smallClass = "small", // класс, который добавляется к блоку, когда текст свернут
			labelMore = "Подробнее",
			labelLess = "Свернуть";

		$(selector).each(function () {
			var $this = $(this),
				$toggler = $($.parseHTML('<a href="#" class="' + togglerClass + '">' + labelMore + '</a>'));
			$this.after(["<div>", $toggler, "</div>"]);
			$toggler.on("click", $toggler, function () {
				$this.toggleClass(smallClass);
				$this.css('height', $this.hasClass(smallClass) ? maxHeight : $this.attr("data-height"));
				$toggler.text($this.hasClass(smallClass) ? labelMore : labelLess);
				return false;
			});
			$this.attr("data-height", $this.height());
			if ($this.height() > maxHeight) {
				$this.addClass(smallClass);
				$this.css('height', maxHeight);
			}
			else {
				$toggler.hide();
			}
		});
	})(".is_read_more"); // это селектор элементов для которых навешивать обрезку текста.

	var fancyboxImages = $('a.image-full');
	if (fancyboxImages.length) {
		$(fancyboxImages).fancybox({
			overlayColor: '#333',
			overlayOpacity: 0.8,
			titlePosition: 'over',
			loop: true,
			helpers: {
				overlay: {
					locked: false
				}
			}
		});
	}

	$('body').on('click', '.yiiPager li', function () {
		$('html, body').animate({ scrollTop: $('.content').offset().top }, 500); // анимируем скроолинг к элементу scroll_el
	});

	$(document).on("click", "#totop", function () { $('body,html').animate({ scrollTop: 0 }, 800); });
	$(window).on("scroll", function () { ($(this).scrollTop() != 0) ? $('#totop').fadeIn() : $('#totop').fadeOut(); });

	//+ и - d карточке товара
	document.addEventListener('click', function (e) {
		//меняем количество товара
		if (e.target.closest('.counter_number')) { changeProdNumber(e.target); }

		//закрываем поиск
		if (!e.target.closest('.btn-search') && !e.target.closest('.search')) {
			mobileSearch.classList.remove('active');
		}
	});

	function changeProdNumber(obj) {
		if (obj.closest('.counter_numbe_minus')) {
			if (obj.nextElementSibling.value > 1) {
				(obj.nextElementSibling.value)--;
			}
		}
		if (obj.closest('.counter_number_plus')) {
			(obj.previousElementSibling.value)++;
		}
	}

	//Удаляем каталог из меню
	try {

		if (document.documentElement.clientWidth > 1200) {
			const linkCatalog = document.querySelector('.header-bottom__menu .menu a[href="/catalog"]');
			linkCatalog.parentElement.style.display = 'none';
		}

	} catch (e) {
		console.log(e);
	}

	try {
		const btnSearch = document.querySelector('.header-mobile .btn-search');
		var mobileSearch = document.querySelector('.header-mobile .search');
		btnSearch.addEventListener('click', function () {
			mobileSearch.classList.toggle('active');
		});
	} catch (e) { }
});

$(window).load(function () {
	fixedFooter();
});