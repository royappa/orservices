<form action="/search" method="GET" id="filter" class="m-0">
	<div class="filter-bar container-fluid bg-primary-color home_serach_form filter_serach">
		<div class="container">
			<div class="row">
                <div class="col-md-3 col-sm-3">
                    <select id="address_state_province_select" >
                        <!-- Option elements should be dynamically loaded here -->
                    </select>
                </div>
                <div class="col-md-3 col-sm-3">
                    <select id="address_city_province_select" >
                        <!-- Option elements should be dynamically loaded here -->
                    </select>
                </div>
                <!--
                <div class="col-md-3 col-sm-3">
                    <input type="text" autocomplete="off" name="find" placeholder="City" id="address_city" @if(isset($chip_addressCity)) value="{{$chip_addressCity}}" @endif>
                </div>
                
                <div class="col-md-2 col-sm-2 dropdown">
                    <button type="button" class="btn dropdown-toggle" id="exampleSizingDropdown1" data-toggle="dropdown" aria-expanded="false">
                        Region
                    </button>
                    <div class="dropdown-menu bullet" aria-labelledby="exampleSizingDropdown1" role="menu" id="address_region_tree">
                    </div>
                </div>
                -->
                <div class="col-md-3 col-sm-3">
					<label class="d-none">Search for Services</label>
					<div class="form-group text-left form-material m-0" data-plugin="formMaterial">
						<img src="/frontend/assets/images/search.png" alt="" title="" class="form_icon_img">
						<input type="text" autocomplete="off" class="form-control search-form" name="find" placeholder="Search" @if(isset($chip_service)) value="{{$chip_service}}" @endif id="find" @if(!isset($selected_state_tags) || strlen($selected_state_tags) < 1) disabled="disabled" @endif>
					</div>
				</div>
                <div class="col-md-2 col-sm-2">
					<button class="btn btn-raised btn-lg btn_darkblack search_btn" title="Search" style="line-height: 31px;">Search</button>
				</div>
			</div>
			<div class="row">
                <!--
                <div class="col-md-3 col-sm-3">
                    <img src="/frontend/assets/images/search.png" alt="" title="" class="form_icon_img">
                    <input type="text" autocomplete="off" class="form-control search-form" name="find" placeholder="City" id="address_city" @if(isset($chip_addressCity)) value="{{$chip_addressCity}}" @endif>
                    <div id="cityList"></div>
                </div>
                -->
                <!--
				<div class="col-md-5 col-sm-5">
					<label class="d-none">Search for Services</label>
					<div class="form-group text-left form-material m-0" data-plugin="formMaterial">
						<img src="/frontend/assets/images/search.png" alt="" title="" class="form_icon_img">
						<input type="text" autocomplete="off" class="form-control search-form" name="find" placeholder="Search" id="search_address" @if(isset($chip_service)) value="{{$chip_service}}" @endif>
                        <div id="serviceList"></div>
					</div>
				</div>
                -->
                {{--
				<div class="col-md-5 col-sm-5">
					<label class="d-none">Search Location</label>
					<div class="form-group text-left form-material m-0" data-plugin="formMaterial">
						<img src="/frontend/assets/images/location.png" alt="" title="" class="form_icon_img">
						<input type="text" class="form-control pr-50" id="searchAddress" name="search_address" placeholder="Search Location..." value="{{ isset($chip_address) ? $chip_address : '' }}">
						<a href="javascript:void(0)" class="input-search-btn" style="z-index: 100;" onclick="getLocation()" ><img src="/frontend/assets/examples/images/location.png" style="width: 20px;margin: 22px 0;"></a>
						<input type="hidden" name="lat" id="lat">
						<input type="hidden" name="long" id="long">
					</div>
				</div>
                --}}
                <!--
				<div class="col-md-2 col-sm-2">
					<button class="btn btn-raised btn-lg btn_darkblack search_btn" title="Search" style="line-height: 31px;">Search</button>
				</div>
                -->
				{{-- <div class="col-md-2">
					@if($layout->meta_filter_activate == 1)
					<button type="button" class="btn btn-primary btn-block waves-effect waves-classic dropdown-toggle  btn-button" id="meta_status" data-toggle="dropdown" aria-expanded="false" style="line-height: 31px;">@if(isset($meta_status) && $meta_status == 'Off') {{$layout->meta_filter_off_label}} @else {{$layout->meta_filter_on_label}} @endif
					</button>
					<div class="dropdown-menu bullet" aria-labelledby="meta_status" role="menu">
						<a class="dropdown-item dropdown-status" href="javascript:void(0)" role="menuitem" at="On">{{$layout->meta_filter_on_label}}</a>
						<a class="dropdown-item dropdown-status" href="javascript:void(0)" role="menuitem"  at="Off">{{$layout->meta_filter_off_label}}</a>
					</div>
					@endif
				</div> --}}
				<input type="hidden" name="meta_status" id="status" @if(isset($meta_status)) value="{{$meta_status}}" @else value="On" @endif>
				{{-- <div class="input-search">
					<i class="input-search-icon md-search" aria-hidden="true"></i>
					<input type="text" class="form-control search-form" name="find" placeholder="Search for Services" id="search_address" @if(isset($chip_service)) value="{{$chip_service}}" @endif>
				</div> --}}
				<!-- <div class="col-md-4">
					<div class="input-search">
						<i class="input-search-icon md-pin" aria-hidden="true"></i>
						<input id="location2" type="text" class="form-control search-form" name="search_address" placeholder="Search Address" @if(isset($chip_address)) value="{{$chip_address}}" @endif>
						<button type="button" class="input-search-btn" title="Services Near Me"><a href="/services_near_me"><i class="icon md-gps-dot"></i></a></button>
					</div>
				</div> -->
			</div>
		</div>
	</div>

<script type="text/javascript">
	function getLocation() {
        if (navigator.geolocation) {

            navigator.geolocation.getCurrentPosition(showPosition);
        } else {

            alert("Geolocation is not supported by this browser.");

        }
	}


	 function showPosition(position) {
	 	$('#lat').val(position.coords.latitude)
	 	$('#long').val(position.coords.longitude)
	 	const geocoder = new google.maps.Geocoder();
	 	const latlng = {
					    lat: parseFloat(position.coords.latitude),
					    lng: parseFloat(position.coords.longitude)
					  };
		geocoder.geocode(
    { location: latlng },
    (results) => {
        if (results[0]) {
          // map.setZoom(11);
          // const marker = new google.maps.Marker({
          //   position: latlng,
          //   map: map
          // });
          // infowindow.setContent(results[0].formatted_address);
          // infowindow.open(map, marker);
          $('#searchAddress').val(results[0].formatted_address)
	 	$("#filter").submit();
        } else {
          window.alert("No results found");
        }
      });
	 // 	var link = document.createElement('a');
		// link.href = '/services_near_me';
		// // document.body.appendChild(link);
		// link.click();
	//   x.innerHTML = "Latitude: " + position.coords.latitude +
	//   "<br>Longitude: " + position.coords.longitude;

	 }
</script>
<script type="text/javascript">

$(document).ready(function(){
	$('.dropdown-status').click(function(){
		var status = $(this).attr('at');
		var status_meta = $(this).html();
		$("#meta_status").html(status_meta);
		$("#status").val(status);
		$("#filter").submit();
	});
    /*
    $('#search_address').keyup(function () {
        let query = $(this).val()
        if(query != ''){
                var _token = "{{ csrf_token() }}";
            $.ajax({
                url: "{{ route('services.fetch') }}",
                method:"post",
                data:{_token,query},
                success:function(data){
                    $('#serviceList').fadeIn();
                    $('#serviceList').html(data)
                },
                error : function(err){
                    console.log(err)
                }
            })
        }else{
            $('#serviceList').fadeOut();
        }
    })
    $(document).on('click', '#serviceList li',function () {
        $('#search_address').val($(this).text())
        $('#serviceList').fadeOut();
    })
    */

	// States tags select
    let state_tree_tags_list = [];
    var selected_state_tags_ids = [];
    var selected_states = '<?php isset($selected_state_tags) ? print_r($selected_state_tags) : print_r('') ; ?>';
    let addressstateProvincesArray =  `<?php isset($addressstateProvincesArray) ? print_r($addressstateProvincesArray) : []; ?>`;
    addressstateProvincesArray = addressstateProvincesArray.replace(/[\r\n]/g, "_n_");
    addressstateProvincesArray = addressstateProvincesArray ? JSON.parse(addressstateProvincesArray) : [];
    if(addressstateProvincesArray.length > 0){
        $.each(addressstateProvincesArray,function name(key,value) {
            var alt_data = {};
            alt_data.text = value.address_state_province;
            alt_data.state = {};
            //
            alt_data.id = value.address_state_province;
            state_tree_tags_list.push(alt_data)
        })
    }

    // Cities tags select
    let city_tree_tags_list = [];
    var selected_cities = '<?php isset($selected_city_tags) ? print_r($selected_city_tags) : print_r('') ; ?>';
    let addressCitiesArray =  `<?php isset($addressCitiesArray) ? print_r($addressCitiesArray) : []; ?>`;
    addressCitiesArray = addressCitiesArray.replace(/[\r\n]/g, "_n_");
    addressCitiesArray = addressCitiesArray ? JSON.parse(addressCitiesArray) : [];
    if(addressCitiesArray.length > 0){
        $.each(addressCitiesArray,function name(key,value) {
            let alt_data = {};
            alt_data.text = "(" + value.state + ")" + value.address_city;
            alt_data.state = value.state;
            //
            alt_data.id = value.address_city;
            city_tree_tags_list.push(alt_data)
        })
    }

    $('#address_state_province_select').select2({
        placeholder: 'Select a state',
        data: state_tree_tags_list,
        allowClear: true // Optional, allows clearing the selection
    }).val($("#state_tags").val()).trigger('change');

    $('#address_state_province_select').on('select2:select', function (e) {
        var selected_state_tag_id = e.params.data.id;
        $("#state_tags").val(selected_state_tag_id);
        $("#region_tags").val("");
        $("#city_tags").val("");
        $("#filter").submit();
    });

    // Optional: Handle clearing the selection
    $('#address_state_province_select').on('select2:unselect', function (e) {
        $("#state_tags").val("");
        $("#region_tags").val("");
        $("#city_tags").val("");
        $("#find").val("");
        $("#filter").submit();
    });

    $('#address_city_province_select').select2({
        placeholder: 'Select a city',
        data: city_tree_tags_list,
        allowClear: true // Optional, allows clearing the selection
    }).val($("#city_tags").val()).trigger('change');

    $('#address_city_province_select').on('select2:select', function (e) {
        var selected_city_tag_id = e.params.data.id;
        var state_of_selected_state = e.params.data.state;
        $("#city_tags").val(selected_city_tag_id);
        $("#state_tags").val(state_of_selected_state);
        $("#filter").submit();
    });

    $('#address_city_province_select').on('select2:unselect', function (e) {
        $("#city_tags").val("");
        $("#filter").submit();
    });

/*
	// Regions tags tree
    let region_tree_tags_list = [];
    var selected_region_tags_ids = [];
    var selected_regions = '<?php isset($selected_region_tags) ? print_r($selected_region_tags) : print_r('') ; ?>'
    if(selected_regions.length > 0) {
        selected_region_tags_ids = selected_regions;
    }
    let addressRegionsArray =  `<?php isset($addressRegionsArray) ? print_r($addressRegionsArray) : []; ?>`;
    addressRegionsArray = addressRegionsArray ? JSON.parse(addressRegionsArray) : [];
    if(addressRegionsArray.length > 0){
        $.each(addressRegionsArray,function name(key,value) {
            var alt_data = {};
            alt_data.text = value.address_region;
            alt_data.state = {};
            alt_data.id = 'regiontag_' + value.id;
            if (selected_region_tags_ids.indexOf(value.id) > -1) {
                alt_data.state.selected = true;
            }
            region_tree_tags_list.push(alt_data);
        })
    }
    $('#address_region_tree').jstree({
        'plugins': ["checkbox", "wholerow", "sort"],
        'core': {
            select_node: 'sidebar_taxonomy_tree',
            data: region_tree_tags_list
        }
    });
    $('#address_region_tree').on("select_node.jstree deselect_node.jstree", function (e, data) {
        var all_selected_ids = $('#address_region_tree').jstree("get_checked");
        var selected_region_tags_ids = []
        all_selected_ids.filter(function(id) {
            if(id.indexOf('regiontag_') > -1){
                selected_region_tags_ids.push(id.split('regiontag_')[1])
            }
        });
        $("#region_tags").val(JSON.stringify(selected_region_tags_ids));
        $("#filter").submit();
    });
    if(strlen(selected_state_tags) + JSON.parse(selected_region_tags_ids).length > 0) {
        $('#searchAddress').prop('disabled', true);
        //$('#map').hide();
    } else {
        $('#searchAddress').prop('disabled', false);
        //$('#map').show();
    }
    */
});
</script>
