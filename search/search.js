var render = function(data) {
	var app = document.getElementById('app');
	// only need booksHTMLString for debug times
	var booksHTMLString = '<ul>'+
		data.map(function(work){
			return '<li>'+
				'<strong>Title: </strong>' + work.title + '<br/>' +
				'<strong>Subtitle: </strong>' + work.subtitle + '<br/>' +
				'<strong>Author: </strong>' + work.author + '<br/>' +
				'<strong>Category: </strong>' + work.category + '<br/>' +
				'<strong>Publisher: </strong>' + work.publisher + '<br/>' +
				'</li>';
		}).join('');
	+ '</ul>';

	app.innerHTML = booksHTMLString;
}
render(portfolio);

var handleSearch = function(event) {
	event.preventDefault();
	
	// Get the search terms from the input field
	var searchTerm = event.target.elements['search'].value;
	
	// Tokenize the search terms and remove empty spaces
	var tokens = searchTerm
		.toLowerCase()
		.split(' ')
		.filter(function(token){
			return token.trim() !== '';
		});
	
	if(tokens.length) {
		//  Create a regular expression of all the search terms
		var searchTermRegex = new RegExp(tokens.join('|'), 'gim');
		var filteredList = portfolio.filter(function(work){

			// Create a string of all object values
			var workString = '';

			for(var key in work) {
				if(work.hasOwnProperty(key) && work[key] !== '') {
					workString += work[key].toString().toLowerCase().trim() + ' ';
				}
			}

			// Return book objects where a match with the search regex if found
			return workString.match(searchTermRegex);
		});

		// Render the search results
		// this is the part i'd replace later on
		render(filteredList);
	}
};

// i think this runs whenever a form is submitted?
document.addEventListener('submit', handleSearch);

// could get something else to call this reset. like if search is nothing? or... i don't know. Maybe searching sends the seach value to a new html page and then you have to go back to the home page or something i don't know
document.addEventListener('reset', function(event){
	event.preventDefault();
	render(portfolio);
})
