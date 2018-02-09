var location_api    = 'api/location';
var article_api     = 'api/article';
var currentAmphur;
var currentDistrict;

$(function(){

    listAmhphur();

    currentAmphur   = $('#amphur_id').val();
    currentDistrict = $('#district_id').val();

    $('#amphur-list').on('click','.amphur-items',function(e) {
        var amphur_id = $(this).attr('data-id');
        $('#district_id').val('');
        $('#amphur_id').val(amphur_id);
        saveAddress();
        listDistrict(amphur_id);
    });

    $('#district-list').on('click','.district-items',function(e) {
        var district_id = $(this).attr('data-id');
        $('#district_id').val(district_id);
        saveAddress();
        defaultDistrict(district_id);
    });

    $('#btnClearLocation').click(function(){
        $('#amphur_id').val('');
        $('#district_id').val('');
        saveAddress();
        location.reload();
    });
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