$( document ).ready(function() {

    /**
     * Reaction to buying a cow
     */
    $('#buyACow').on('click', function() {
        $('#divBuyACow>#buyACow').replaceWith( "<h1 style='color: green;'>Thank You</h1>" );
        events(['BUY_COW']);
    });

    /**
     * Exe file upload response
     */
    $('#download').on('click', function(){
        let today = new Date();            
        let day = today.toLocaleDateString();
        let time = today.toLocaleTimeString();
        let link = document.createElement('a');
        link.setAttribute('href', '/file/document/report.xlsx');
        link.setAttribute('download', `${day.replaceAll('.', '_')}_${time}/report.xlsx`);
        link.click();
        events(['DOWNLOAD_EXE']);
        return false;
    });

    function events(triger) {
        $.ajax({
            type: 'POST',
            cache: false,
            dataType: 'json',
            url: '/',
            data: { action: "click", events: triger },
            success: function (data) {
                console.log(data.message);
            }
        });
    }
});
