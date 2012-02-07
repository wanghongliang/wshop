 	var mh = $('#mod_custom-548').height();
	
	var lefth = $('#left').height();

	var homeh = $('#home').height();


	var solute = mh + ( homeh - lefth) -36 ;

	if( homeh > lefth ){
		if($.browser.msie) {
			solute +=11;
		}
		 $('#mod_custom-548 dd').height( solute  );
	}else{
		solute = lefth-44;
		if($.browser.msie) {
			solute +=13;
		}
 		$('#home dd').height( solute );
	}
 