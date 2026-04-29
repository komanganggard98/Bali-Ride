import {BikeState} from '../states/bike'

export async function fetchBikes() {

    let url = `${BikeAPI.url}?paged=${BikeState.paged}&posts_per_page=${BikeState.postPerPage}`;

    if(BikeState.search.trim().length > 0){
        url += `&search=${BikeState.search}`;
    }
    
    if (BikeState.colors.length > 0) {
        url += `&colors=${BikeState.colors.join(',')}`;
    }

    if (BikeState.transmissions.length === 1) {
        url += `&transmission=${BikeState.transmissions[0]}`;
    }

    if (BikeState.price.trim().length > 0) {
        url += `&sort_price=${BikeState.price}`;
    }

    const response = await fetch(url);
    const data = await response.json();

    BikeState.hasMore = data.has_more ? 1 : 0

    return data;
}