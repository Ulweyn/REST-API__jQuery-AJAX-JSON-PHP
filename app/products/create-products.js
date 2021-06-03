jQuery(function ($) {

    // показать список товаров при первой загрузке
    showProducts();
    // при нажатии кнопки
    $(document).on('click','.read-product-button', function () {
        showProducts();
    });
});

// функция для показа списка товаров
function showProducts() {
    // получить список товаров из API
    $.getJSON("http://REST-API__jQuerry+AJAX+JSON+PHP/api/product/read.php", function (data) {

        // html for Listing products
        var read_products_html = `
            <!-- при нажатии загружается форма создания продукта -->
            <div id='create-product' class='btn btn-primary pull-right m-b-15px create-product-button'>
            <span class='glyphicon glyphicon-plus'></span>
            </div>
            <!-- начало таблицы -->
            <table class='table table-bordered table-hover'>
        
            <!-- создение заголовков таблицы --> 
            <tr>
                <th class='w-15-pct'>Название</th>
                <th class='w-10-pct'>Цена</th>
                <th class='w-15-pct'>Категория</th>
                <th class='w-25-pct text-align-center'>Действие</th>
            </tr>`;

            // здесь будут строки

        //конец таблицы
        read_products_html+=`</table>`
    });
}


