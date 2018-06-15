$(document).ready(function(){
		$(document).on("click",".mv_button",function(){
		//Selected value
		var mv_num = $(this).val();
		            
                //Ajax for calling php function            
		var hide_mv_num = "<button type='button' id='hide_mv_button' value='"
				+mv_num+ "' style='display:none'></button>"; 		
                $.ajax({
                        type : 'POST',
                        url : '/ticket/get_loc_list.php',
                        datatype : "json",
                        data : { mv_num : mv_num },
                        success : function(data) {	
                                var result = JSON.parse(data);
                                var input = "<ul class='ul_loc' style='list-style:none'>";
                        
                                for(var i=0;i<result.length;i++){
					input = input + "<li class='li_loc'><button type='button' class='loc_button' value='"
						+ result[i].loc_num + "'>"
						+ result[i].loc_nm + "</button></li>"; 
                                }
                                input = input + "</ul>";				
                             
                                $("#location").html(input);
				
				$("#date").html("");
				$("#time").html("");
				$("#next").html("");
				$(".hide_mv_num").html(hide_mv_num);                                              
         	               }       
  	              })
            	});
		$(document).on("click",".loc_button",function(){
                //Selected value
                var loc_num = $(this).val();
                var mv_num = $('#hide_mv_button').val();   
		          
                //Ajax for calling php function            
                var hide_loc_num = "<button type='button' id='hide_loc_button' value='"
                                + loc_num + "' style='display:none' ></button>";                 
		
		
                $.ajax({
                        type : 'POST',
                        url : '/ticket/get_date_list.php',
                        datatype : "json",
                        data : { loc_num : loc_num, mv_num : mv_num },
                        success : function(data) {
                                   
                                var result = JSON.parse(data);
                                var input = "<ul class='ul_date' style='list-style:none'>";
                        
                                for(var i=0;i<result.length;i++){
					var day = result[i].sch_day.toString();
					
					var day1 = day.substr(4,2);
					var day2 = day.substr(6,2); 
                                        input = input + "<li class='li_date'><button type='button' class='date_button' value='"
                                                + result[i].sch_day + "'>"
                                                + day1+ "월" + day2 + "일</button></li>"; 
                                }
                                input = input + "</ul>";
                                
                                $("#date").html(input);
				$("#time").html("");
				$("#next").html("");
                                $(".hide_loc_num").html(hide_loc_num);
                                             
                               }       
                      })
                });
		$(document).on("click",".date_button",function(){
                //Selected value
                var date_num = $(this).val();
                var mv_num = $('#hide_mv_button').val();
		var loc_num = $('#hide_loc_button').val();   
                        
		//Ajax for calling php function            
                var hide_date_num = "<button type='button' id='hide_date_button' value='"
                                + date_num + "' style='display:none' ></button>";                 
                
                
                $.ajax({
                        type : 'POST',
                        url : '/ticket/get_time_list.php',
                        datatype : "json",
                        data : { date_num : date_num, loc_num : loc_num, mv_num : mv_num },
                        success : function(data) {
				   
                                var result = JSON.parse(data);
                                var input = "";
				var temp = result[0].tht_num; 
				var flag = 0;                       
                                for(var i=0;i<result.length;i++){
					var scr_stt_time = parseInt(result[i].scr_stt_time);
					var scr_time = scr_stt_time / 10000;
									
                                        if(temp == result[i].tht_num)
					{
						if(flag == 0)
						{
							input = input + "<div class='sub_time'><h2 style='text-align:center'>"
								+ result[i].tht_num + "관</h2>"
								+"<ul class='ul_time'style='display:inline-block; list-style:none'>";
							input = input + "<div class='wrap3'><li class='li_time'><button class='time_button' type='button' value='"
								+ result[i].sch_num + "'>" +
								+ scr_time + "시</button>"+result[i].seatN+"좌석</li></div>";
							
							flag = 1;
						}
						else
						{
							input = input + "<div class='wrap3'><li class='li_time'><button class='time_button' type='button' value='"
                                                                + result[i].sch_num + "'>" +
                                                                + scr_time + "시</button>"+result[i].seatN+"좌석</li></div>";
						}
					}
					else
					{	
						input = input + "</ul></div>";
						input = input + "<div class='sub_time'><h2 style='text-align:center'>"
                                                                + result[i].tht_num + "관</h2>"
                                                                +"<ul class='ul_time' style='display:inline-block; list-style:none'>";
                                                input = input + "<div class='wrap3'><li class='li_time'><button class='time_button' type='button' value='"
                                                        + result[i].sch_num + "'>" +
                                                        + scr_time + "시</button>"+result[i].seatN+"좌석</li></div>";
					}
                                      	temp = result[i].tht_num;
                                }
                          	input = input + "</ul></div>";
                                
                                $("#time").html(input);
				$("#next").html("");
                                $(".hide_date_num").html(hide_date_num);
                                             
                               }       
                      })
                });
		$(document).on("click",".time_button",function(){
                //Selected value
		var sch_num = $(this).val();
                var mv_num = $('#hide_mv_button').val(); 
		var loc_num = $('#hide_loc_button').val();
		var sch_day = $('#hide_date_button').val();  
                   
	        //Ajax for calling php function                           
                $.ajax({
                        type : 'POST',
                        url : '/ticket/make_ticket_button.php',
                        datatype : "json",
                        data : { sch_num : sch_num},
                        success : function(data) {
                                			   
                                var result = JSON.parse(data);
                                var input = "<form name='hide_info' method='get' action='member_check.php'>"
					+ "<input type='text' value='" + sch_num + "' name='sch_num' style='display:none'>"
					+ "<input type='text' value='" + loc_num + "' name='loc_num' style='display:none'>"
					+ "<input type='text' value='" + result[0].tht_num + "' name='tht_num' style='display:none'>"
					+ "<div class='check_button'><input id='check_button' type='submit' value='좌석선택&rarr;'></div></form>";
			                                
                               $("#next").html(input);
                                             
                               }       
                      })
                });
		
	});
	$(function(){
  		var sBtn = $("ul > li");    
  		sBtn.find(".mv_button").click(function(){   
   			sBtn.removeClass("active");     
   			$(this).parent().addClass("active");
			var sBtn_loc = $(".li_loc");  
                	sBtn_loc.removeClass("active");
			var sBtn_date = $(".li_date");  
                        sBtn_date.removeClass("active"); 
			var sBtn_time = $(".li_time");  
                        sBtn_time.removeClass("active");   
  		})
 	});
	$(document).on("click",".loc_button",function(){ 
		var sBtn = $(".li_loc");  
                sBtn.removeClass("active");     
                $(this).parent().addClass("active"); 
		var sBtn_date = $(".li_date");  
                sBtn_date.removeClass("active"); 
                var sBtn_time = $(".li_time");  
                sBtn_time.removeClass("active");
        });
	$(document).on("click",".date_button",function(){ 
                var sBtn = $(".li_date");  
                sBtn.removeClass("active");     
                $(this).parent().addClass("active"); 
		var sBtn_time = $(".li_time");  
                sBtn_time.removeClass("active");
        });
	$(document).on("click",".time_button",function(){ 
                var sBtn = $(".li_time");  
                sBtn.removeClass("active");     
                $(this).parent().addClass("active"); 
        });
