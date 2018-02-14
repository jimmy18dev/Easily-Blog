var location_api    = 'api/location';
var article_api     = 'api/article';
var currentAmphur;
var currentDistrict;

$(function(){

    $('#findLocation').on('input',function(event) {
        var keyword = $(this).val();
        console.clear();
        console.log('ค้นหา "'+keyword+'"');

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

                html += '<div class="location-items" data-district="'+v.district_id+'" data-amphur="'+v.amphur_id+'" data-province="'+v.province_id+'"><i class="fa fa-map-pin" aria-hidden="true"></i>'+v.district_name+' '+v.amphur_name+' '+v.province_name+'</div>';
                
            });

            $('#locationList').html(html);
        });
    });

    $('#locationList').on('click', '.location-items', function(event) {
        var district_id = $(this).attr('data-district');
        var amphur_id = $(this).attr('data-amphur');
        var province_id = $(this).attr('data-province');

        console.log(district_id+' '+amphur_id+' '+province_id);

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
    });

    // listAmhphur();

    // currentAmphur   = $('#amphur_id').val();
    // currentDistrict = $('#district_id').val();

    // $('#amphur-list').on('click','.amphur-items',function(e) {
    //     var amphur_id = $(this).attr('data-id');
    //     $('#district_id').val('');
    //     $('#amphur_id').val(amphur_id);
    //     saveAddress();
    //     listDistrict(amphur_id);
    // });

    // $('#district-list').on('click','.district-items',function(e) {
    //     var district_id = $(this).attr('data-id');
    //     $('#district_id').val(district_id);
    //     saveAddress();
    //     defaultDistrict(district_id);
    // });

    // $('#btnClearLocation').click(function(){
    //     $('#amphur_id').val('');
    //     $('#district_id').val('');
    //     saveAddress();
    //     location.reload();
    // });
});

function listAmhphur(){
	var html = '';
	var province = 16;
	
	$.ajax({
        url         :location_api,
        cache       :false,
        dataType    :"json",
        type        :"GET",
        data:{
            request     :'list_amphur',
            province_id :province,
        },
        error: function (request, status, error) {
            console.log("Request Error");
        }
	}).done(function(data){
		var html = '';
        $.each(data.dataset,function(k,v){
            html += '<div class="items amphur-items" id="amphur'+v.amphur_id+'" data-lat="'+v.lat+'" data-lng="'+v.lng+'" data-id="'+v.amphur_id+'">'+v.amphur_name+'</div>';
        });

        $('#amphur-list').html(html);
        html = '';

        if(currentAmphur != 0){
        	listDistrict(currentAmphur);
        }

	});
}

function listDistrict(amphur_id){
	var html = '';
	var current_district = $('#district_id').val();

    defaultAmphur(amphur_id);
	
	$.ajax({
        url         :location_api,
        cache       :false,
        dataType    :"json",
        type        :"GET",
        data:{
            request     :'list_district',
            amphur_id   :amphur_id,
        },
        error: function (request, status, error) {
            console.log("Request Error");
        }
	}).done(function(data){
		var html = '';
        
        $.each(data.dataset,function(k,v){
            html += '<div class="items district-items" data-id="'+v.district_id+'" id="district'+v.district_id+'">'+v.district_name+'</div>';
        });

        $('#district-list').html(html);
        html = '';

        if(currentDistrict != 0){
        	defaultDistrict(currentDistrict);
        }
	});
}

function defaultAmphur(amphur_id){
    $('.amphur-items').removeClass('active').addClass('unselect');
    $('#amphur'+amphur_id).removeClass('unselect').addClass('active');
}

function defaultDistrict(district_id){
    $('.district-items').removeClass('active').addClass('unselect');
    $('#district'+district_id).removeClass('unselect').addClass('active');
}

function saveAddress(){

    var article_id = $('#article_id').val();
    var province_id = $('#province_id').val();
    var amphur_id = $('#amphur_id').val();
    var district_id = $('#district_id').val();
    
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
    });
}