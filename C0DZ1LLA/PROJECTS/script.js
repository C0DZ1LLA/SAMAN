// Function to create button and save URL in local storage
function createButton() {
    var url = document.getElementById('urlInput').value;
    var category = document.getElementById('categorySelect').value;

    // Generate a unique identifier for the URL
    var id = 'url_' + Date.now();

    // Save the URL, its corresponding identifier, and category in local storage
    localStorage.setItem(id, JSON.stringify({ url: url, category: category }));

    // Create a new container for the URL
    var container = createContainerElement(url, id);

    // Append the container to the URL list
    var urlList = document.getElementById('urlList');
    urlList.appendChild(container);

    // Clear the input field after creating the button
    document.getElementById('urlInput').value = '';
}

// Function to load saved URLs from local storage
function loadSavedUrls() {
    var urlList = document.getElementById('urlList');
    var selectedCategory = document.getElementById('categorySelect').value;

    // Clear the URL list before loading saved URLs
    urlList.innerHTML = '';

    // Iterate through local storage and load saved URLs
    for (var i = 0; i < localStorage.length; i++) {
        var key = localStorage.key(i);
        if (key.startsWith('url_')) {
            var data = JSON.parse(localStorage.getItem(key));
            var url = data.url;
            var category = data.category;

            // Check if the URL belongs to the selected category
            if (selectedCategory === 'All' || category === selectedCategory) {
                var container = createContainerElement(url, key);
                urlList.appendChild(container);
            }
        }
    }
}


// Function to view URLs by selected category
function viewUrlsByCategory() {
    var selectedCategory = document.getElementById('viewCategorySelect').value;
    var urlList = document.getElementById('urlList');

    // Clear the URL list before loading saved URLs
    urlList.innerHTML = '';

    // Iterate through local storage and load saved URLs
    for (var i = 0; i < localStorage.length; i++) {
        var key = localStorage.key(i);
        if (key.startsWith('url_')) {
            var data = JSON.parse(localStorage.getItem(key));
            var url = data.url;
            var category = data.category;

            // Check if the URL belongs to the selected category
            if (selectedCategory === 'All' || category === selectedCategory) {
                var container = createContainerElement(url, key);
                urlList.appendChild(container);
            }
        }
    }
}


// Function to create container element for URL
function createContainerElement(url, id) {
    var container = document.createElement('li');
    container.classList.add('url-container');

    // Create a new button element for opening the URL
    var button = document.createElement('button');
    button.textContent = 'Open URL';
    button.classList.add('btn');
    button.addEventListener('click', function() {
        window.open(url, '_blank');
    });

    // Append button to the container
    container.appendChild(button);

    return container;
}

// Event listener for category select change
document.getElementById('categorySelect').addEventListener('change', function() {
    loadSavedUrls();
});

// Load saved URLs when the page loads
loadSavedUrls();
