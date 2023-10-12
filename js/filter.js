$(document).ready(function() {
    
    $("#price-slider").slider({
        range: true,
        min: 0,
        max: 1000, // Установите максимальное значение по вашему усмотрению
        values: [0, 1000], // Начальные значения
        slide: function(event, ui) {
            // Обновляем значения инпутов при перетаскивании ползунка
            $("#price-min").val(ui.values[0]);
            $("#price-max").val(ui.values[1]);
        },
        change: function(event, ui) {
            // Отправляем AJAX-запрос при завершении перетаскивания
            filterProducts();
        }
    });
    // Обработчик события изменения чекбоксов
    $('.checkbox-filter input[type="checkbox"]').on('change', filterProducts);

    // Обработчик события изменения цены
    $('#price-min, #price-max').on('input', filterProducts);

    // Функция для отправки AJAX-запроса и обновления продуктов
    function filterProducts() {
        const selectedCategories = $('.checkbox-filter input[type="checkbox"]:checked').map(function() {
            return this.id.split('-')[1]; // Получаем выбранные категории
        }).get();

        const minPrice = $('#price-min').val();
        const maxPrice = $('#price-max').val();

        // Отправляем AJAX-запрос на сервер
        $.ajax({
            type: 'GET',
            url: 'http://localhost/electro/services/js-service/filter.php', // Замените на адрес вашего серверного скрипта
            data: {
                categories: selectedCategories,
                minPrice: minPrice,
                maxPrice: maxPrice
            },
            dataType: 'json',
            success: function(data) {
                console.log(data);
                const filteredProductsContainer = $('#filtered-products');
                filteredProductsContainer.empty(); // Очищаем контейнер
            
                // Проходимся по полученным данным и создаем элементы для каждого продукта
                $.each(data, function(index, product) {
    
                    const productElement = `
                        <div class="col-md-4 col-xs-6">
                            <div class="product">
                                <div class="product-img">
                                    <img src="./img/product01.png" alt="">
                                    <div class="product-label">
                                        <span class="sale">${product.id}%</span>
                                        <span class="new">NEW</span>
                                    </div>
                                </div>
                                <div class="product-body">
                                    <p class="product-category">${product.category_name}</p>
                                    <h3 class="product-name"><a href="#">${product.name}</a></h3>
                                    <h4 class="product-price">$${product.price} <del class="product-old-price">$${product.oldPrice}</del></h4>
                                    
                                    <div class="product-btns">
                                        <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                                        <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
                                        <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
                                    </div>
                                </div>
                                <div class="add-to-cart">
                                    <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                                </div>
                            </div>
                        </div>
                    `;
            
                    filteredProductsContainer.append(productElement);
                });
                const Oldnav = $('#oldnav');
                const navPan = data.render();
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error('Ошибка при выполнении AJAX-запроса:', errorThrown);
            }
        });
    }
});
