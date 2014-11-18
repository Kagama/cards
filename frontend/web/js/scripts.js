$(document).ready(function() {

	/*
	==========================================================================
	Плагины jQuery
	==========================================================================
	*/
	$(".slideshow").cycle({
		slides: 'div',
		next: '#s-r',
		prev: '#s-l'
	});

	$("select").fancySelect();

	/*
	==========================================================================
	Анимации
	==========================================================================
	*/
	TweenLite.from( $("header .title"), 2, {
		top: -60,
		ease: Expo.easeInOut
	});

	TweenLite.to( $(".big"), 2, {
		top: '10%',
		opacity: 1,
		ease:Quint.easeOut
	});
	
	TweenMax.staggerFrom( $("nav li"), 1.5, {
		opacity: 0,
		ease:Quint.easeOut
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

					TweenLite.from( status, .2, {
						right: 20,
						ease:Expo.ease
					});
		}
		else
		{
			status.removeClass('active')
					.addClass('inactive')
					.text("Не активна");
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

	/*
	==========================================================================
	Yandex Maps
	==========================================================================
	*/
	//ymaps.ready(initMap);

    //Глоальные переменные для карт и иконок
    var footMap, orgMap, allMap,
    	mainMark    =  {
			            	iconImageHref:   '/img/map-icon-main.png', // картинка иконки
			            	iconImageSize:   [ 200,  150], 			  // размер иконки
			            	iconImageOffset: [-100, -105] 			  // позиция иконки
	                   },
	    washMark    =  {
			            	iconImageHref:   '/img/map-icon-wash.png',
			            	iconImageSize:   [ 80,  80],
			            	iconImageOffset: [-40, -70]
				       },
	    tireMark    =  {
			            	iconImageHref:   '/img/map-icon-tire.png',
			            	iconImageSize:   [ 80,  80],
			            	iconImageOffset: [-40, -70]
				       },
	    rusMark     =  {
			            	iconImageHref:   '/img/map-icon-rus.png',
			            	iconImageSize:   [ 80,  80],
			            	iconImageOffset: [-40, -70]
				       },
	    repairMark  =  {
			            	iconImageHref:   '/img/map-icon-repair.png',
			            	iconImageSize:   [ 80,  80],
			            	iconImageOffset: [-40, -70]
				       },
	    unknowMark  =  {
			            	iconImageHref:   '/img/map-icon-unknown.png',
			            	iconImageSize:   [ 80,  80],
			            	iconImageOffset: [-40, -70]
				       };

	ymaps.ready(initMap);

    function initMap(){

	    if( $("div").is("#fmap") )
	    {
	        footMap = new ymaps.Map("fmap", {
	            center: [42.979622, 47.488841],
	            zoom: 16,
	            controls: []
	        });

	        footPlacemark = new ymaps.Placemark( [42.979622, 47.488841], {balloonContent: ''}, mainMark );

	        footMap.geoObjects.add(footPlacemark);

	    	console.log("Footer map initialised");
	    }

	    if( $("div").is("#map-org") )
	    {
	        orgMap = new ymaps.Map("map-org", {
	            center: [42.979622, 47.488841],
	            zoom: 16
	        });

	        orgPlacemark = new ymaps.Placemark( [42.979622, 47.488841], {balloonContent: ''}, unknowMark );
	        orgMap.geoObjects.add(orgPlacemark);

	    	console.log("Org map initialised");
	    }
        //if( $("div").is("#map-wash") )
        //{
        //    orgMap = new ymaps.Map("map-wash", {
        //        center: [42.979622, 47.488841],
        //        zoom: 16
        //    });
        //
        //    orgPlacemark = new ymaps.Placemark( [42.979622, 47.488841], {balloonContent: ''}, washMark );
        //    orgMap.geoObjects.add(orgPlacemark);
        //
        //    console.log("Org map initialised");
        //}
        //if( $("div").is("#org-tire") )
        //{
        //    orgMap = new ymaps.Map("org-tire", {
        //        center: [42.979622, 47.488841],
        //        zoom: 16
        //    });
        //
        //    orgPlacemark = new ymaps.Placemark( [42.979622, 47.488841], {balloonContent: ''}, tireMark );
        //    orgMap.geoObjects.add(orgPlacemark);
        //
        //    console.log("Org map initialised");
        //}
        //if( $("div").is("#map-russ") )
        //{
        //    orgMap = new ymaps.Map("map-russ", {
        //        center: [42.979622, 47.488841],
        //        zoom: 16
        //    });
        //
        //    orgPlacemark = new ymaps.Placemark( [42.979622, 47.488841], {balloonContent: ''}, rusMark );
        //    orgMap.geoObjects.add(orgPlacemark);
        //
        //    console.log("Org map initialised");
        //}
        //if( $("div").is("#map-repair") )
        //{
        //    orgMap = new ymaps.Map("map-repair", {
        //        center: [42.979622, 47.488841],
        //        zoom: 16
        //    });
        //
        //    orgPlacemark = new ymaps.Placemark( [42.979622, 47.488841], {balloonContent: ''}, repairMark );
        //    orgMap.geoObjects.add(orgPlacemark);
        //
        //    console.log("Org map initialised");
        //}
	    if( $("div").is("#map-all") )
	    {
	        allMap = new ymaps.Map("map-all", {
	            center: [42.979622, 47.488841],
	            zoom: 16
	        });

	        allPlacemark = new ymaps.Placemark( [42.979622, 47.488841], {balloonContent: ''}, tireMark );
	        allMap.geoObjects.add(allPlacemark);

	    	console.log("Org map initialised");
	    }

    }

    //getCoord("Махачкала, Шамиля 68");
});


function getCoord(address) {

    var result;
    $.ajax({
        url: "http://geocode-maps.yandex.ru/1.x/?format=json&geocode="+address,
        dataType: "JSON",
        async: false,
        success: function(data, textMessage) {
            // response.GeoObjectCollection.featureMember[0].GeoObject.Point.pos - строка с координатами из запрошенного JSON

            result = data.response.GeoObjectCollection.featureMember[0].GeoObject.Point.pos.split(' ');

            var lat = result[0],
                lon = result[1];

            console.log(textMessage+"\nКоординаты адреса '"+address+"': "+lat+", "+lon);
        },
        error: function(textMessage) {
            console.log(textMessage);
        }
    });
    return result;
}
