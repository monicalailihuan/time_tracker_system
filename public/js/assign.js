	$( document ).ready(function() {
		
		var currentDate = new Date(),
			eta = $( "#eta" ).val();

		currentDate.setDate(currentDate.getDate() + 14);
		if(currentDate.getDay()==0){
			currentDate.setDate(currentDate.getDate() + 1);
		}
		if(currentDate.getDay()==6){
			currentDate.setDate(currentDate.getDate() + 2);
		}

		$( "#eta" ).datepicker({ minDate: "+0D" });
		$( "#eta" ).datepicker( "option", "dateFormat", "dd-mm-yy" );
		// $( "#eta" ).datepicker("setDate", new Date(currentDate));

		$("#eta").val(eta);

		$( "#sortable" ).sortable({
			revert: true,
			forcePlaceholderSize: true,
			start: function(e, ui) {
				old_num = ui.item.find('.num').attr('num');
				if(old_num=='na'){
		        	ui.item.find('.hide-item').not('.job_list').addClass('show');
		        }
			},
			stop: function(e, ui) {
		        var total_stage_num = $('#sortable li').length,
					current_num = parseInt(ui.item.index())+1,
					old_num = ui.item.find('.num').attr('num');
					
					if(old_num=='na'){
						for(i = total_stage_num-1; i >= current_num; i--){
							var find_num = i+1;
					        ui.item.parent().find("[num="+ i +"]").html(find_num);
					        ui.item.parent().find("[num="+ i +"]").attr("num", find_num);
							
							ui.item.parent().find('[name="duration_hours['+ i +']"]').attr('name', 'duration_hours['+ find_num +']');
							ui.item.parent().find('[name="duration_minutes['+ i +']"]').attr('name', 'duration_minutes['+ find_num +']');
							ui.item.parent().find('[name="extra_hours['+ i +']"]').attr('name', 'extra_hours['+ find_num +']');
							ui.item.parent().find('[name="extra_minutes['+ i +']"]').attr('name', 'extra_minutes['+ find_num +']');
							ui.item.parent().find('[name="multiplier['+ i +']"]').attr('name', 'multiplier['+ find_num +']');
							ui.item.parent().find('[name="step['+ i +']"]').attr('name', 'step['+ find_num +']');
							ui.item.parent().find('[name="remark['+ i +']"]').attr('name', 'remark['+ find_num +']');
						}
						ui.item.find('.stage-title').append('<span class="fa fa-times pull-right remove"></span>');
					}else{
						old_num = parseInt(old_num);
						if(current_num > old_num){
							for(x = old_num; x <= current_num-1; x++){
								var find_num = x+1;
						        ui.item.parent().find("[num="+ find_num +"]").html(x);
						        ui.item.parent().find("[num="+ find_num +"]").attr("num", x);

						        ui.item.parent().find('[name="duration_hours['+ find_num +']"]').attr('name', 'duration_hours['+ x +']');
								ui.item.parent().find('[name="duration_minutes['+ find_num +']"]').attr('name', 'duration_minutes['+ x +']');
								ui.item.parent().find('[name="extra_hours['+ find_num +']"]').attr('name', 'extra_hours['+ x +']');
								ui.item.parent().find('[name="extra_minutes['+ find_num +']"]').attr('name', 'extra_minutes['+ x +']');
								ui.item.parent().find('[name="multiplier['+ find_num +']"]').attr('name', 'multiplier['+ x +']');
								ui.item.parent().find('[name="step['+ find_num +']"]').attr('name', 'step['+ x +']');
								ui.item.parent().find('[name="remark['+ find_num +']"]').attr('name', 'remark['+ x +']');
							}	
						}
						if(current_num < old_num){
							for(b = old_num; b >= current_num; b--){
								var find_num = b+1;

						        ui.item.parent().find("[num="+ b +"]").html(find_num);
						        ui.item.parent().find("[num="+ b +"]").attr("num", find_num);

						        ui.item.parent().find('[name="duration_hours['+ b +']"]').attr('name', 'duration_hours['+ find_num +']');
								ui.item.parent().find('[name="duration_minutes['+ b +']"]').attr('name', 'duration_minutes['+ find_num +']');
								ui.item.parent().find('[name="extra_hours['+ b +']"]').attr('name', 'extra_hours['+ find_num +']');
								ui.item.parent().find('[name="extra_minutes['+ b +']"]').attr('name', 'extra_minutes['+ find_num +']');
								ui.item.parent().find('[name="multiplier['+ b +']"]').attr('name', 'multiplier['+ find_num +']');
								ui.item.parent().find('[name="step['+ b +']"]').attr('name', 'step['+ find_num +']');
								ui.item.parent().find('[name="remark['+ b +']"]').attr('name', 'remark['+ find_num +']');

							}

						}
					}

					ui.item.find('.duration_hours').attr('name', 'duration_hours['+ current_num +']');
					ui.item.find('.duration_minutes').attr('name', 'duration_minutes['+ current_num +']');
					ui.item.find('.extra_hours').attr('name', 'extra_hours['+ current_num +']');
					ui.item.find('.extra_minutes').attr('name', 'extra_minutes['+ current_num +']');
					ui.item.find('.multiplier').attr('name', 'multiplier['+ current_num +']');
					ui.item.find('.step').attr('name', 'step['+ current_num +']');
					ui.item.find('.remark').attr('name', 'remark['+ current_num +']');

					ui.item.find('.num').html(current_num);
				    ui.item.find('.num').attr("num", current_num);

		    },
			over: function(e, ui){ 
		        ui.helper.width(ui.sender.width()); 
		        ui.item.width(ui.sender.width());

		        ui.helper.height('90px'); 
		        ui.item.height('90px');

		    }
		});

		$(document).on("click",".remove",function(){
	        var total_stage_num = $('#sortable li').length,
				current_num = parseInt($(this).parent().find('.num').attr('num'));

				$(this).parents('li').remove();

			for(i = current_num; i <= total_stage_num; i++){
				var find_num = i-1;

				$('[name="duration_hours['+ i +']"]').attr('name', 'duration_hours['+ find_num +']');
				$('[name="duration_minutes['+ i +']"]').attr('name', 'duration_minutes['+ find_num +']');
				$('[name="extra_hours['+ i +']"]').attr('name', 'extra_hours['+ find_num +']');
				$('[name="extra_minutes['+ i +']"]').attr('name', 'extra_minutes['+ find_num +']');
				$('[name="multiplier['+ i +']"]').attr('name', 'multiplier['+ find_num +']');
				$('[name="step['+ i +']"]').attr('name', 'step['+ find_num +']');
				$('[name="remark['+ i +']"]').attr('name', 'remark['+ find_num +']');

		        $("[num="+ i +"]").html(find_num);
		        $("[num="+ i +"]").attr("num", find_num);
			}
		});

		$( ".draggable" ).draggable({
			connectToSortable: "#sortable",
			helper: "clone",
			revert: "invalid"
		});
		$( "ul, li" ).disableSelection();


		$(document).on("click",".section_key",function(){
			if($(this).attr('check') == 'show'){
				$(this).parent().next('.job_list').removeClass('show');
				$(this).attr('check', 'hide');
				$(this).addClass('fa-plus');    
                $(this).removeClass('fa-times');
		        $(this).parents('.draggable').css( { marginBottom : "0" } );

            }else{
                $(this).parent().next('.job_list').addClass('show');
                $(this).attr('check', 'show');
                $(this).addClass('fa-times');
                $(this).removeClass('fa-plus'); 
		        $(this).parents('.draggable').css( { marginBottom : "80px" } );
			}
		});

	});