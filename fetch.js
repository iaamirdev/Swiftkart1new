document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const modelName = urlParams.get('model');
    fetchPhoneDetails(modelName);
    fetchReviews(modelName);
    fetchPriceDetails(modelName);
});

function fetchPhoneDetails(modelName) {
    fetch('techspecs.json')
        .then(response => {
            if (!response.ok) {
                throw new Error('Unable to Fetch ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            const phoneDetails = data.find(phone => phone.model === modelName);
            if (phoneDetails) {
                displayPhoneDetails(phoneDetails);
            } else {
                alert('Phone not found');
            }
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            alert('Failed to fetch phone details: ' + error.message);
        });
}

function displayPhoneDetails(phone) {
    const detailsContainer = document.getElementById('phone-details');
    detailsContainer.innerHTML = ''; 

    const phoneInfo = [
        { title: 'Brand', value: phone.brand, icon: 'fas fa-mobile-alt' },
        { title: 'Model', value: phone.model, icon: 'fas fa-tag' },
        { title: 'Processor', value: phone.processor, icon: 'fas fa-microchip' },
        { title: 'Rear Camera', value: phone.camera.rear, icon: 'fas fa-camera' },
        { title: 'Front Camera', value: phone.camera.front, icon: 'fas fa-camera' },
        { title: 'Storage Options', value: Array.isArray(phone.storage_capacity) ? phone.storage_capacity.join(', ') : phone.storage, icon: 'fas fa-hdd' },
        { title: 'Display Size', value: phone.display.size, icon: 'fas fa-tv' },
        { title: 'Display Type', value: phone.display.type, icon: 'fas fa-tv' },
        { title: 'Display Resolution', value: phone.display.resolution, icon: 'fas fa-tv' },
        { title: 'Battery Size', value: phone.battery.size, icon: 'fas fa-battery-full' },
        { title: 'Operating System', value: phone.operating_system, icon: 'fas fa-cogs' },
    ];

    phoneInfo.forEach(info => {
        const detailDiv = document.createElement('div');
        detailDiv.classList.add('detail-item');

        const iconDiv = document.createElement('i');
        iconDiv.classList.add(...info.icon.split(' ')); 

        const titleDiv = document.createElement('div');
        titleDiv.classList.add('title');
        titleDiv.innerText = info.title;

        const valueDiv = document.createElement('div');
        valueDiv.classList.add('value');
        valueDiv.innerText = info.value;

        detailDiv.appendChild(iconDiv);
        detailDiv.appendChild(titleDiv);
        detailDiv.appendChild(valueDiv);

        detailsContainer.appendChild(detailDiv);
    });
}

