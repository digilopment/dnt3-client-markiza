class Std {
	
	getData(url, obj) {
		var putData;
		var returnData = [];
		$.ajax({
			url: url,
			async: false,
			dataType: 'json',
			success: function(data) {
			
				if(obj == false){
					putData = data;
				}else if(obj == 'items'){
					putData = data.items;
				}
				$.each(putData, function(i, item) {
					returnData.push(item);
				});
			}
		});
		return returnData;
	}
	
}