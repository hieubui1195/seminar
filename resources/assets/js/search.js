var search = instantsearch({
    // Replace with your own values
    appId: 'F0T0Q3ZTF3',
    apiKey: '42975e4ff8308c86ff97ee63c7e7fee1',
    indexName: 'search_application',
    urlSync: true,
    searchParameters: {
        hitsPerPage: 5
    }
});

// initialize SearchBox
search.addWidget(
    instantsearch.widgets.searchBox({
        container: '#search-box',
        placeholder: 'Search...'
    })
);

// initialize hits widget
search.addWidget(
    instantsearch.widgets.hits({
        container: '#hits',
        templates: {
            empty: 'No results',
            item: function(data) {
                if(data.email) {
                    return '<p><div class="btn btn-danger btn-circle"><i class="fa fa-user"></i></div>' 
                        + '<a href="/user/' + data.id + '">&nbsp;&nbsp;&nbsp;&nbsp;' + data._highlightResult.name.value + '</a></p>'
                        + '<article>' + data._highlightResult.email.value + '</article>'
                } else {
                    return '<p><div class="btn btn-warning btn-circle"><i class="fa fa-comment"></i></div><a href="/seminar/' 
                        + data.id + '">&nbsp;&nbsp;&nbsp;&nbsp;' + data._highlightResult.name.value + '</a></p>'
                        + '<article>' + data._highlightResult.description.value + '</article>'
                }
            }
        }
    })
);

search.addWidget(
    instantsearch.widgets.pagination({
        container: '#pagination'
    })
);

search.start();
