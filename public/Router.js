class Router
{
    /**
     * Creates a clickable link for specified action, e.g. ./module=countries&action=details&id=5
     * Defaults to countries/list if no arguments are specified.
     * 
     * @param {string} module 
     * @param {string} action 
     * @param {number} id 
     * 
     * @return {string} xd
     */
    static Link(module = 'country', action = 'list', id = null)
    {
        let a = `./?module=${module}&action=${action}`;

        if (id !== null)
            a += `&id=${id}`;
        
        return a;
    }
}