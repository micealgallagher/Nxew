SC.initialize({
    client_id: '2a737f2852f3179c6a875807412249ce'
});

var allowClose = true;

function resolveAndSubmitSCUrl(id) {
    // permalink to a track
        allowClose = false;
    var track_url = $('#txtSoundCloudURL').val();
    var divSoundCouldUrl = $("#divSoundCouldUrl");
    var errorIcon = "<i class='fa fa-times-circle fa-1x'></i>";
    if ( track_url.length == 0 ) {
        divSoundCouldUrl.html(errorIcon + " Please provide a Url");
        divSoundCouldUrl.show();

        return false;
    } else {
        SC.get('/resolve', { url: track_url }, function(track, error) {

            if (error || null === error) {

                var errorMessage = null == error ? "" : error.message;

                if ( "404 - Not Found" == errorMessage || "HTTP Error: 0" == errorMessage || "" == errorMessage) {
                    divSoundCouldUrl.html(errorIcon + " Invalid track Url");
                    divSoundCouldUrl.show();
                }

                console.log('Someone said: ' + errorMessage);
                return false;
            } else {
                console.log('Track id: ' + track.id);
                SC.get('/tracks/' + track.id, function(track, error) {

                    if (error) {
                        alert('Error: ' + error.message);
                    } else {
                        console.log('Someone said: ' + track);
                        //window.location = "index.php?r=playlist/add&id=" + id + "&url=" + track.uri;
                        track.nxew_id = id;

                        $.ajax({
                                type:"POST",
                            dataType: "json",
                            url: addToPlaylistUrl,
                            data: JSON.stringify(track),
                            contentType: "application/json; charset=utf-8",
                            success: function(data){
                                alert('Items added');
                            },
                            error: function(e){
                                console.log(e.message);
                            }
                        });

                    }

                });
            }
        });
        return false;
    }
}

$('#divAddSoundCloudDropDown').on('hide.bs.dropdown', function () {
    if ( allowClose ) {
        $('#txtSoundCloudURL').val('');
        $("#divSoundCouldUrl").hide();
    } else {
        allowClose = true;
        return false;
    }
})