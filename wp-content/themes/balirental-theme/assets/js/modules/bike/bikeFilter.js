import { fetchBikes } from '../../api/bikeApi';
import { BikeState } from "../../states/bike";

document.addEventListener('DOMContentLoaded', () => {
    const bikeFilterFormBtn = document.querySelector('#bike-filter-form-btn');
    const bikeApplyFilterBtn = document.querySelector('#bike-apply-filter-btn');
    const bikeFilterForm = document.querySelector('#bike-filter-form');
    const colorsButton = document.querySelectorAll('[data-type="color-input"]');
    const pricesButton = document.querySelectorAll('[data-type="price-input"]');
    const transmissionButton = document.querySelectorAll('[data-type="transmission-input"]');
    const bikeSearch = document.querySelector('#bike-search');
    const container = document.getElementById('bike-list');
    const loader = document.querySelector('#bike-loader');

    let bikeSearchTimer

    if(colorsButton?.length > 0){
        colorsButton.forEach((color) => {
            const value = color.attributes['data-value'].value
            color.addEventListener('click', () => {
                const isSelected = BikeState.colors.includes(value)
                if(isSelected){
                    BikeState.colors = BikeState.colors.filter((item) => item !== value )
                    color.classList.remove('selected')
                }else{
                    BikeState.colors.push(value)
                    color.classList.add('selected')
                }
            })
        })
    }

    if(pricesButton?.length > 0){
        pricesButton.forEach((price) => {
            const value = price.attributes['data-value'].value
            price.addEventListener('click', () => {
                pricesButton.forEach((btn) => btn.classList.remove('selected'))
                const isSelected = BikeState.price === value
                if(isSelected){
                    BikeState.price = ''
                }else{
                    BikeState.price = value
                    price.classList.add('selected')
                }
            })
        })
    }

    if(transmissionButton?.length > 0){
        transmissionButton.forEach((transmission) => {
            const value = transmission.attributes['data-value'].value
            transmission.addEventListener('click', () => {
                const isSelected = BikeState.transmissions.includes(value)
                if(isSelected){
                    BikeState.transmissions = BikeState.transmissions.filter((item) => item !== value )
                    transmission.classList.remove('selected')
                }else{
                    BikeState.transmissions.push(value)
                    transmission.classList.add('selected')
                }
            })
        })
    }

    if(bikeFilterFormBtn){
        bikeFilterFormBtn.addEventListener('click',() => {
            if(bikeFilterForm?.classList.contains('show')){
                bikeFilterForm.classList.remove('show')
            }else{
                bikeFilterForm.classList.add('show')
            }
        })
    }

    if(bikeApplyFilterBtn){
        bikeApplyFilterBtn.addEventListener('click', async () => {
            BikeState.paged = 1
            BikeState.loading = 1
            bikeApplyFilterBtn.setAttribute('disabled', true)
        
            loader.style.display = 'block';

            container.innerHTML = '';
            const data = await fetchBikes();

            BikeState.loading = 0
            bikeApplyFilterBtn.removeAttribute('disabled')

            if(data.status === 404){
                container.classList.remove('grid--4');
            }else{
                if(!container.classList.contains('grid--4')){
                    container.classList.add('grid--4');
                }
            }
        
            container.insertAdjacentHTML('beforeend', data.html);
            loader.style.display = 'none';
        })
    }
    
    
    if(bikeSearch){
        bikeSearch.addEventListener("input",(e)=>{
            clearTimeout(bikeSearchTimer)
        
            bikeSearchTimer = setTimeout(async () => {
                BikeState.search = e.target.value
                BikeState.paged = 1
                container.innerHTML = '';
                loader.style.display = 'block';

                const data = await fetchBikes();
                if(data.status === 404){
                    container.classList.remove('grid--4');
                }else{
                    if(!container.classList.contains('grid--4')){
                        container.classList.add('grid--4');
                    }
                }
                container.insertAdjacentHTML('beforeend', data.html);
                loader.style.display = 'none';
            },500)
        
        })
    }
})