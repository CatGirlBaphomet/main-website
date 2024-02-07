document.querySelector("#addItemForm").addEventListener("submit", function(event) {
    event.preventDefault();

    var title = document.querySelector("#title").value;
    var subitems = Array.from(document.querySelector("#subitems").getElementsByTagName("input")).map(input => input.value);

    var xmlDoc = document.implementation.createDocument("", "", null);
    var rootElem = xmlDoc.createElement("item");
    xmlDoc.appendChild(rootElem);

    var titleElem = xmlDoc.createElement("title");
    titleElem.appendChild(xmlDoc.createTextNode(title));
    rootElem.appendChild(titleElem);

    var subitemsElem = xmlDoc.createElement("subitems");
    subitems.forEach(function(subitem) {
        var subitemElem = xmlDoc.createElement("subitem");
        subitemElem.appendChild(xmlDoc.createTextNode(subitem));
        subitemsElem.appendChild(subitemElem);
    });
    rootElem.appendChild(subitemsElem);

    var xmlStr = new XMLSerializer().serializeToString(xmlDoc);
    
    fetch('../kake/save_data.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'data=' + encodeURIComponent(xmlStr),
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        window.location.href = '../kake/index.php';
    })
    .catch((error) => {
        console.error('Error:', error);
    });
});