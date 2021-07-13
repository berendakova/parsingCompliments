## Данный проект представляет из себя набор методов API, используя которые можно получить данные по комплиментам. 


* #### Для того, чтобы иметь готовую базу комплиментов необходимо воспользоваться методом парсинга комментарием
     -  GET /api/parser


_Методы API_
*  #### Создание комплимента
     - POST  /api/compliments/create
     - параметры text, categoryId = null
*  #### Получение рандомного комплимента по категории
     - POST  /api/compliments/category/rand
     - параметры categoryId, count = 1
*  #### Список всех комплиментов
     - GET /api/compliments
*  #### Получение всех комплиментов в категории
     - GET /api/compliments/category/{categoryId}
*  #### Присвоение комплимента к категории
     - GET /api/compliments/{complimentId}/category/{categoryId}
*  #### Удаление комлимента
     - DELETE /api/compliments/{complimentId}    
*  #### Создание категории
     - POST /api/categories/create
     - параметры name
*  #### Удаление категории
     - DELETE /api/categories/{categoryId}
*  #### Получение списка категорий
     -  GET /api/categories
* #### Проверка существования категории по ID
     -  GET /api/categories/exist/{categoryId}
