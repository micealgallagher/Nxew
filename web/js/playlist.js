$(document).ready(function() {

    $('.track-delete-link').click(function () {
        var trackTitle = $(this).attr('track-title');
        return confirm('Remove "' + trackTitle + '" from playlist');
    })

});