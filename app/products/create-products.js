jQuery(function ($) {

    // показать html форму при нажатии кнопки "создать товар"
    $(document).on("click",'.create-product-button', function () {


        $.getJSON("api/category/read.php", function (data) {

            // перебор возвращаемого списка данных и создание списка выбора
            var categories_options_html=`<select name='category_id' class='form-control'>`;
            $.each(data.records, function (key, val) {
                categories_options_html+=`<option value='` + val.id + `'>` + val.name + `</option>`;
            });
            categories_options_html+=`</select>`;

            var create_product_html=`
            <!-- кнопка для показа всех товаров -->
            <div id='read-products' class='btn btn-primary pull-right m-b-15px read-products-button'>
                <span class='glyphicon glyphicon-list'></span>Все товары
            </div>
            
            <!-- html форма "Создание Товара   -->
            <form id='create-product-form' action='#' method='post' border='0'>
                <table class='table table-hover table-responsive table-bordered'>
                    <tr>
                        <td>Название</td>
                        <td><input type='text' name='name' class='form-control' required /></td>
                    </tr>
                    
                    <tr>
                        <td>Цена</td>
                        <td><input type='number' min='1' name='price' class='form-control' required /></td>
                    </tr>
                    
                    <tr>
                        <td>Описание</td>
                        <td><textarea name='description' class='form-control' required ></textarea></td>
                    </tr>
                    
                    <!--   список выбора категории   -->
                    <tr>
                        <td>Категория</td>
                        <td>` + categories_options_html + `</td>
                    </tr>
                    
                    <!--    кнопка отправки формы    -->
                    <tr>
                        <td></td>
                        <td>
                            <button type='submit' class='btn btn-primary'>
                                <span class='glyphicon glyphicon-plus'></span> Создать товар
                            </button>
                        </td>
                    </tr>
                        
                </table>
            </form>`;

            // вставка html в "page-content" нашего приложения
            $("#page-content").html(create_product_html);

            // изменяем тайтл
            changePageTitle("Создание товара");
        });
    });

    // будет работать, если создана форма товара
    $(document).on('submit', '#create-product-form', function () {

    });

})