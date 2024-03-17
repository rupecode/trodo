export default class Api {
    _url = process.env.REACT_APP_API_URL;

    getResource = async (url) => {
        const res = await fetch(this._url + url, {
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            }
        });

        if (!res.ok) {
            throw new Error('Could not fetch - ' + res.status);
        }

        return await res.json();
    }

    getRates = async ({page = 0, currency = '', dateSort = ''}) => {
        return this.getResource(`/api/currencies?page=${page}&currency=${currency}&dateSort=${dateSort}`);
    }
}
