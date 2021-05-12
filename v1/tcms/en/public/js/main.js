function getFilenameFromURL(url) {
    // Ignore the query and fragment.
    var mainUrl = url.split(/#|\?/)[0];
    var components = mainUrl.split(/\/|\\/);
    var filename = components[components.length - 1];
    try {
        return decodeURIComponent(filename);
    } catch (e) {
        if (e instanceof URIError)
            return filename;
        throw e;
    }
}