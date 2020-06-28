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

    /**
     * Get element by id or multiple elements by class name. Accepts CSS-style selectors, #id_name or .class_name
     */
    static getElement(selector)
    {
        let s2 = selector.substr(1);

        if (selector[0] === '#')
            return document.getElementById(s2);
        if (selector[0] === '.')
            return document.getElementsByClassName(s2);
    }

    static addToastMessage(type, message)
    {
        alert(`${type} - ${message}`);
    }
}