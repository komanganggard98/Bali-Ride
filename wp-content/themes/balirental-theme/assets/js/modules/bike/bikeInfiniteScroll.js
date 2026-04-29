import { BikeState } from "../../states/bike";
import { fetchBikes } from '../../api/bikeApi';

document.addEventListener("DOMContentLoaded", () => {

    BikeState.loading = false;
    const sentinel = document.querySelector('#bike-sentinel');
    const loader = document.querySelector('#bike-loader');
    const bikeList = document.querySelector('#bike-list');
    
    async function loadBikes() {
        if (BikeState.loading || !BikeState.hasMore) return;
    
        BikeState.loading = 1;
        BikeState.paged++;
    
        loader.style.display = 'block';
        const data = await fetchBikes()
        bikeList.insertAdjacentHTML('beforeend', data.html);
    
        loader.style.display = 'none';
    
        BikeState.loading = 0;
    }
    
    if(sentinel){
        const observer = new IntersectionObserver(entries => {
            if (entries[0].isIntersecting) {
                loadBikes();
            }
        });
        
        observer.observe(sentinel);
    }
})