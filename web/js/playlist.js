$(document).ready(function() {

    $('.track-delete-link').click(function () {
        var trackTitle = $(this).attr('track-title');
        return confirm('Remove "' + trackTitle + '" from playlist');
    })

    $('.fa-play-circle').click(function () {
        var trackIndex = $(this).attr('track-index');
        ToneDen.player.getInstanceByDom("#player").skipTo(trackIndex, true);

        $('.fa-play-circle').show();
        $(this).hide();

    })

});