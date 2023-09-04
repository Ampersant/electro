document.addEventListener("DOMContentLoaded", function() {
    // Обработчик события изменения чекбоксов
    const checkboxes = document.querySelectorAll('.checkbox-filter input[type="checkbox"]');
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener("change", filterProducts);
    });

    // Обработчик события изменения цены
    const priceMin = document.getElementById('price-min');
    const priceMax = document.getElementById('price-max');
    priceMin.addEventListener("input", filterProducts);
    priceMax.addEventListener("input", filterProducts);

    // Функция для отправки AJAX-запроса и обновления продуктов
    function filterProducts() {
        const selectedCategories = Array.from(document.querySelectorAll('.checkbox-filter input[type="checkbox"]:checked')).map(function(checkbox) {
            return checkbox.id.split('-')[1]; // Получаем выбранные категории
        });

        const minPrice = priceMin.value;
        const maxPrice = priceMax.value;

        // Отправляем AJAX-запрос на сервер с выбранными параметрами
        // Здесь нужно заменить 'url' на адрес вашего серверного скрипта, который будет обрабатывать фильтрацию и возвращать результаты
        fetch('http://localhost/electro/services/js-service/filter.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                categories: selectedCategories,
                minPrice: minPrice,
                maxPrice: maxPrice,
            }),
        })
        .then(response => response.json())
        .then(data => {
            // Обновляем отображение отфильтрованных продуктов
            const filteredProductsContainer = document.getElementById('filtered-products');
            filteredProductsContainer.innerHTML = ''; // Очищаем контейнер
            data.forEach(product => {
                // Создаем элементы для отображения продукта и добавляем их в контейнер
                const productElement = document.createElement('div');
                productElement.textContent = product.name; // Здесь нужно заменить на соответствующие свойства продукта
                filteredProductsContainer.appendChild(productElement);
            });
        })
        .catch(error => {
            console.error('Ошибка при выполнении AJAX-запроса:', error);
        });
    }
});