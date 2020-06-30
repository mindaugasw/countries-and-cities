class Utils
{
    /**
     * Make new Ajax request
     */
    static Ajax(url, method, callback)
    {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                callback(JSON.parse(this.responseText));
        }};
        
        xhttp.open(method, url, true);
        xhttp.send();
    }

    /**
     * Submit POST request on given link
     * @param {string} link 
     */
    static PostRequest(link)
    {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = link;
        document.body.appendChild(form);
        form.submit();
    }

    /**
     * Returns true if string is empty or consists only of whitespace characters,
     * @param {string} str String to check
     * @return {bool}
     */
    static IsEmptyOrWhitespace(str)
    {
        return str === null || str.match(/^\s*$/) !== null;
    }

    /**
     * Get element by id or multiple elements by class name. Accepts CSS-style selectors, #id_name or .class_name
     */
    static GetElement(selector)
    {
        let s2 = selector.substr(1);

        if (selector[0] === '#')
            return document.getElementById(s2);
        if (selector[0] === '.')
            return document.getElementsByClassName(s2);
    }

    /**
     * Add toast message to the page
     * @param {string} type Message flavor (color), one of the following: primary, secondary, success,
     *                      danger, warning, info, light, dark.
     * @param {string} message Message text.
     */
    static AddToastMessage(type, message)
    {
        Utils.GetElement("#alerts-wrapper").innerHTML += HtmlPrinter.ToastMessage(type, message);
    }

    /**
     * Show confirm dialog and perform callback function if user confirms
     * @param {string} message Text to show in the dialog
     * @param {*} callback 
     */
    static ConfirmDialog(message, callback)
    {
        var r = confirm(message);
        if (r === true) {
            callback();        
        }
    }

    /**
     * Show item deletion confirm dialog
     * @param {string} link Deletion link. Will be called after user confirmation.
     * @param {string} name Item name. Will be shown in the dialog.
     */
    static AreaDeleteConfirm(link, name)
    {
        Utils.ConfirmDialog(`Are you sure you want to delete ${name}?`, function() {
            Utils.PostRequest(link);
        });
    }
}
