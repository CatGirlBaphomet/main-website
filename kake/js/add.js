document.getElementById('addSubitem').addEventListener('click', function() {
    var subitems = document.getElementById('subitems');
    var count = subitems.getElementsByTagName('input').length + 1;
    if (count > 10) {
        alert('You can only add up to 10 subitems.');
        return;
    }
    var label = document.createElement('label');
    label.setAttribute('for', 'subitem' + count);
    label.textContent = 'Subitem ' + count + ':';
    subitems.appendChild(label);
    subitems.appendChild(document.createElement('br'));
    var input = document.createElement('input');
    input.type = 'text';
    input.id = 'subitem' + count;
    input.name = 'subitem' + count;
    subitems.appendChild(input);
    subitems.appendChild(document.createElement('br'));
});