async function fetchStockPrices() {
    const apiKey = 'c646703221msh8b53034e9b8cda2p11e293jsnc783643ca0dd'; // Replace with your RapidAPI key
    const symbols = ['TSLA', 'AAPL', 'GOOGL', 'MSFT', 'AMZN', 'HSBC', 'HDB', 'IBN', 'MMYT', 'YTRA']; // Replace with the stock symbols you want to fetch
    const stockInfoContainer = document.getElementById('stock-info');

    for (const symbol of symbols) {
        const url = `https://realstonks.p.rapidapi.com/${symbol}`;
        const options = {
            method: 'GET',
            headers: {
                'X-RapidAPI-Key': apiKey,
                'X-RapidAPI-Host': 'realstonks.p.rapidapi.com'
            }
        };

        try {
            const response = await fetch(url, options);
            if (response.status === 200) {
                const data = await response.json();
                console.log(data);
                const price = data.price; // Update to extract the price from the response
                if (price !== undefined) {
                    const stockPrice = `<p>${symbol}: $${price} </p>`;
                    stockInfoContainer.innerHTML += stockPrice + " ";
                    stockInfoContainer.innerHTML += '<br><gap>'; // Add two line breaks for a larger gap
                } else {
                    console.error(`Price for ${symbol} is undefined.`);
                }
            } else {
                console.error(`Error for ${symbol}: Status ${response.status}`);
            }
        } catch (error) {
            console.error(`Error for ${symbol}: ${error}`);
        }
        
    }
}

// Call the function to fetch the stock prices when the page loads
fetchStockPrices();