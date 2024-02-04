document.querySelector("#addSubitem").addEventListener("click", function() {
    var subitemsDiv = document.querySelector("#subitems");
    var newSubitemNumber = subitemsDiv.getElementsByTagName("input").length + 1;
    subitemsDiv.innerHTML += '<label for="subitem' + newSubitemNumber + '">Subitem:</label><br><input type="text" id="subitem' + newSubitemNumber + '" name="subitem' + newSubitemNumber + '"><br>';
});

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

    console.log(new XMLSerializer().serializeToString(xmlDoc));
});