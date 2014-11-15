$(document).ready(function() {


	$(".slideshow").cycle({
		slides: 'div',
		next: '#s-r',
		prev: '#s-l'
	});

	TweenLite.from( $("header .title"), 2, {
		top: -60,
		ease: Expo.easeInOut
	});

	TweenLite.to( $(".big"), 1, {
		top: '10%',
		opacity: 1,
		ease: Expo.easeInOut
	});
	
	TweenMax.staggerFrom( $("nav li"), 1.5, {
		right: -60,
		opacity: 0,
		ease:Elastic.easeOut
	}, .05);

	/*
	==========================================================================
	Проверка карты
	==========================================================================
	*/
	var card_mas = [12345,23456,34567];

	var input = $("#card_check"),
		status = $("#card_status");

	input.on('input', function() {

		if (in_array( input.val(), card_mas) ) //Функция in_array();
		{
			status.removeClass('inactive')
					.addClass('active')
					.text("Активна");
		}
		else
		{
			status.removeClass('active')
					.addClass('inactive')
					.text("Не активна");
		}
		
	});

	/*
	==========================================================================
	Yandex Maps
	==========================================================================
	*/
	ymaps.ready(initMap);

    var footMap, orgMap;

    function initMap(){    

	    if( $("div").is("#fmap") )
	    {
	    	console.log("Footer map initialised");
	        footMap = new ymaps.Map("fmap", {
	            center: [42.979622, 47.488841],
	            zoom: 16,
	            controls: []
	        });

	        footPlacemark = new ymaps.Placemark([42.979622, 47.488841], { 
	            hintContent: 'ул. Некрасова 43/38', 
	            balloonContent: 'Клуб чистых авто' 
	        });

	        footMap.geoObjects.add(footPlacemark);
	    }

	    if( $("div").is("#map-org") )
	    {
	    	console.log("Org map initialised");
	        orgMap = new ymaps.Map("map-org", {
	            center: [42.979622, 47.488841],
	            zoom: 16,
	            controls: []
	        });

	        orgPlacemark = new ymaps.Placemark([42.979622, 47.488841], { 
	            hintContent: 'ул. Некрасова 43/38', 
	            balloonContent: 'Marussia motors' 
	        });

	        orgMap.geoObjects.add(orgPlacemark);
	    }

    }

	
});

function in_array(value, haystack, strict) {

	var found = false,
		key,
		strict = !!strict;

	for (key in haystack) {
		if ((strict && haystack[key] === value) || (!strict && haystack[key] == value)) {
			found = true;
			break;
		}
	}

	return found;
}
