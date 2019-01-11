$(function(){
	var rows	=	$('tbody tr');
	var search	=	$('#search');
	var cache	=	[];
	
	rows.each(function() {
		cache.push({
			element: this,
			text: this.innerHTML.trim().toLowerCase()
		});
	});
	
	function filter(){
		var query = this.value.trim().toLowerCase();
		
		num_results = rows.length;
		
		cache.forEach(function(row){
			var index = 0;
			
			if (query) {
				index = row.text.indexOf(query);
				
				if (index === -1) {
					num_results--;
				}
			}
			
			row.element.style.display = index === -1 ? 'none' : '';
			
			$('#search_num').html(num_results+' records found.');
		});
	}
	
	search.on('keyup', filter);
});