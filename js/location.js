var location_api    = 'api/location';
var article_api     = 'api/article';

$(function(){
    $locationList = $('#locationList');
    $('#findLocation').keydown(function(e){
        if (e.keyCode == 13) { // Enter
            $selected           = $("#locationList .selected");
            var district_id     = $selected.attr('data-district');
            var amphur_id       = $selected.attr('data-amphur');
            var province_id     = $selected.attr('data-province');

            saveAddress(district_id,amphur_id,province_id);
        }else if (e.keyCode == 38) { // Up
            var selected = $(".selected");
            $("#locationList .location-items").removeClass("selected");
            if (selected.prev().length == 0) {
                selected.siblings().last().addClass("selected");
            } else {
                selected.prev().addClass("selected");
            }
        }else if (e.keyCode == 40) { // Down
            var selected = $(".selected");
            $("#locationList .location-items").removeClass("selected");
            if (selected.next().length == 0) {
                selected.siblings().first().addClass("selected");
            } else {
                selected.next().addClass("selected");
            }
        }
    });

    $('#findLocation').on('input',function(event) {
        var keyword = $(this).val();
        
        if(!keyword || keyword.length <= 1){
            $('#locationList').html('');
            return false;
        }

        $.ajax({
            url         :location_api,
            cache       :false,
            dataType    :"json",
            type        :"GET",
            data:{
                request     :'find',
                keyword  :keyword
            },
            error: function (request, status, error){
                console.log(request.responseText);
            }
        }).done(function(data){
            // console.log(data);
            var html = '';
            $.each(data.dataset,function(k,v){
                // console.table(v);
                console.log(v.district_name+' '+v.amphur_name+' '+v.province_name);

                html += '<li class="location-items" data-district="'+v.district_id+'" data-amphur="'+v.amphur_id+'" data-province="'+v.province_id+'"><i class="fa fa-map-marker" aria-hidden="true"></i>'+(v.district_name?'ต.'+v.district_name+' ':'')+(v.amphur_name?'อ.'+v.amphur_name+' ':'')+(v.province_name?'จ.'+v.province_name:'')+'</li>';
                
            });

            $('#locationList').html(html);
            $('#locationList').children('.location-items').first().addClass('selected');
        });
    });

    $('#locationList').on('click', '.location-items', function(event) {
        var district_id = $(this).attr('data-district');
        var amphur_id = $(this).attr('data-amphur');
        var province_id = $(this).attr('data-province');

        saveAddress(district_id,amphur_id,province_id);
    });

    function saveAddress(district_id,amphur_id,province_id){

        $.ajax({
            url         :article_api,
            cache       :false,
            dataType    :"json",
            type        :"POST",
            data:{
                request     :'edit_address',
                article_id  :article_id,
                province_id :province_id,
                amphur_id   :amphur_id,
                district_id :district_id
            },
            error: function (request, status, error) {
                console.log("Request Error");
            }
        }).done(function(data){
            console.log(data);
            location.reload();
        });
    }
});