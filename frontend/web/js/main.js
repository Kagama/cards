/**
 * Created by developer on 02.07.14.
 */
$(document).ready(function () {

    $('.main-page-video-list .video-item a img, .video-block-widget .video-list a img').each(function (i) {
        var imgurl = getScreen($(this).attr('title'));
        $(this).attr('src', imgurl);
    });

    $('.video-gallery .grey-block a img').each(function (i) {
        var imgurl = getScreen($(this).attr('title'));
        $(this).attr('src', imgurl);
    });

});
function getScreen(url, size) {
    if (url === null) {
        return "";
    }

    size = (size === null) ? "big" : size;
    var vid;
    var results;

    results = url.match("[\\?&]v=([^&#]*)");
    vid = ( results === null ) ? url : results[1];

    if (size == "small") {
        return "http://img.youtube.com/vi/" + vid + "/2.jpg";
    } else {
        return "http://img.youtube.com/vi/" + vid + "/0.jpg";
    }
}