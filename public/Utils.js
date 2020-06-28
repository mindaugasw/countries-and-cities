class Utils
{
    static ajax(url, method, callback)
    {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                callback(JSON.parse(this.responseText));
        }};
        
        xhttp.open(method, url, true);
        xhttp.send();
    }

    static isEmptyOrWhitespace(str)
    {
        return str === null || str.match(/^\s*$/) !== null;
    }

    static getById(id)
    {
        return document.getElementById(id);
    }

    static addToastMessage(type, message)
    {
        alert(`${type} - ${message}`);
    }
}