export default {
    getURLFromString: function (string) {
        let urlRegex = /(https?:\/\/[^\s]+)/g;
        return string.match(urlRegex);
    },
    getURLMetadata: async function (url) {
        let response = await fetch(url);
        let html = await response.text();
        let parser = new DOMParser();
        let doc = parser.parseFromString(html, "text/html");
        let title = doc.querySelector('title').innerText;
        let image = doc.querySelector('img');
        return {
            title: title,
            image: image
        };
    },
}