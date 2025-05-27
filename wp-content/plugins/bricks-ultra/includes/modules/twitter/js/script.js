function bultrTwitter(){
	const twitterElemets = bricksQuerySelectorAll(document, '.brxe-wpvbu-twitter');
	twitterElemets.forEach((element) => {	
		twttr.widgets.load();
	});	
}