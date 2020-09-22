;(function ($) {

	const $body = $("body");
	const $rangeSlider = $(".js-range-slider");
	const $rangeCalendar = $("#range-calendar");
	const $counters = $('.counter');
	const $inputNao = $('.input-nao__field');
	const $chart = $('.chart');
	const $switch = $('.switch.switch-sm');

	$(window).on('load', function () {
		const $preloader = $(".preloader");

		$preloader.removeClass('loading')
	});

	$(window).on('scroll', function() {
		const $sticky = $('.sticky');
		let scroll = $(window).scrollTop();

		if (scroll > 0) {
			$sticky.addClass('fixed');
		} else {
			$sticky.removeClass('fixed');
		}

	});

	if ($counters.length) {
		counter();
	}

	if ($rangeCalendar.length) {
		let ru = 'ru';
		let currentDate = moment();
		let endDate = moment().add('months', 12);

		$rangeCalendar.rangeCalendar({
			lang: ru,
			theme:"default-theme",
			themeContext: this,
			startDate: currentDate,
			endDate: endDate,
			start :"+7",
			startRangeWidth : 1,
			minRangeWidth: 1,
			maxRangeWidth: 1,
			weekends: true,
			autoHideMonths: false,
			visible: true,
			trigger: 'click',

			changeRangeCallback : rangeChanged
		});

		function rangeChanged(target,range){
			return false;
		}
	}

	if ($rangeSlider.length) {
		$rangeSlider.ionRangeSlider({
			min: 0,
			max: 24,
			from: 17,
			step: 1,
			postfix: ".00",
			skin: 'round',
			hide_min_max: true,
			hide_min_to: true
		});
	}

	$inputNao.on('focus blur input', function() {

		if ($(this).val() !== '') {
			$(this).addClass('input-nao__filled');
		} else {
			$(this).removeClass('input-nao__filled');
		}
	});

	if ($chart.length) {
		Highcharts.chart('chart', {
			chart: {
				plotBackgroundColor: null,
				plotBorderWidth: null,
				plotShadow: false,
				type: 'pie',
				margin: [0, 0, 0, 0],
				spacing: [0, 0, 0, 0],
			},
			title: {
				text: ''
			},
			tooltip: {
				padding: 4,
				distance: 24,
				pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
			},
			plotOptions: {
				pie: {
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
						enabled: false
					},
					showInLegend: false,
					animation: {
						duration: 500
					},
					slicedOffset: 4,
				},
				series: {
					states: {
						inactive: {
							opacity: 1
						},
						hover: {
							enabled: true,
							halo: {
								opacity: 0.5,
								size: 4
							}
						},
						select: {
							enabled: true,
							halo: {
								opacity: 0.5,
								size: 4
							}
						}
					}
				}
			},
			credits: {
				enabled: false
			},
			series: [{
				name: 'Brands',
				colorByPoint: true,
				data: [{
					name: 'Chrome',
					y: 61.41,
					sliced: false,
					selected: false
				}, {
					name: 'Internet Explorer',
					y: 11.84
				}, {
					name: 'Firefox',
					y: 10.85
				}, {
					name: 'Edge',
					y: 4.67
				}, {
					name: 'Safari',
					y: 4.18
				}, {
					name: 'Other',
					y: 7.05
				}]
			}],
		});
	}

	if ($switch.length) {
		const switchInput = $switch.find('input[type=checkbox]');
		let isChecked = switchInput.prop('checked');
		const $counters = $("#counters");

		if (isChecked) {
			toggleAnimate($counters, "hide");
		}

		switchInput.on('change', function () {
			isChecked = switchInput.prop('checked');

			if (isChecked) {
				toggleAnimate($counters, "hide");
			} else {
				toggleAnimate($counters, "show");
			}
		});
	}

	// svg polyfill for old browsers
	svg4everybody();

	// PWA init
	conditionPWA();

	function counter() {
		$counters.each(function (index, elem) {
			const circle = $(elem).find('.counter__circle-value');

			setTimeout(function () {
				circle.attr('stroke-dashoffset', 0);
			}, 500);

			$(elem).find('span').each(function () {
				$(this).prop('Counter', 0).animate({
					Counter: $(this).text()
				}, {
					duration: 1500,
					easing: 'swing',
					step: function (now) {
						$(this).text(Math.ceil(now));
					}
				});
			});
		});
	}


	function toggleAnimate(elem, param) {
		elem.animate({
			opacity: param,
			height: param
		}, {
			duration: 500,
			specialEasing: {
				opacity: 'linear',
				height: 'swing'
			}
		})
	}

	function conditionPWA() {
		if (navigator.serviceWorker.controller) {
			console.log('[PWA Builder] active service worker found, no need to register')
		} else {
			navigator.serviceWorker.register('js/sw.js', {
				scope: './'
			}).then(function(reg) {
				console.log('Service worker has been registered for scope:'+ reg.scope);
			});
		}
	}

})(jQuery);
